<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Models\User;

class ProfileController extends Controller
{
    
    public function editProfile(Request $request) {
        
        try {
            /** @var User $user */
            $user = User::find($request['id']);
            $msg = (['message' => 'Request Success']);
            //return response(compat('msg', 'user'));
            return response()->json(['user'=> $user, 'message' => "Request Success"]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while requesting data!'
            ],500);
        }
       
    }
    public function update(ProfileRequest $request) {
        $data = $request->validated();

        $filename = null;
        if($request->has('image')) {
            $image = $request['image'];
            $filename = time().".".$request->file->extension();
            $image->move('public/', $filename);
        }
        try {
            $id = $request['id'];
            /** @var User $user */
            $user = User::where('id',$id)->update(['name' => $request['name'], 'email' => $request['email'],
                                'telephone' => $request['telephone'], 'image' => $filename, 'is_volunteer' => $request['is_volunteer'],
                            'support_type' => $request['support_type'], 'updated_at' => now()]);
            
            return response()->json(['user' => $user, 'message' => 'User updated successfully']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while updating user!'
            ],500);
        }
       
    }
}
