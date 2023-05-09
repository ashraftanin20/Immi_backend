<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function getUsers() {
        /** @var User $user */
        $users = DB::table('users')
                        ->where('is_volunteer', '1')
                        ->select('users.id', 'users.name', 'users.support_type')->get();
        return response()->json(['data' => $users, 'message' => 'Success']);
    }

    public function getUser(Request $request) {
        /** @var User $user */
        $user = DB::table('users')
                        ->select('users.name', 'users.support_type', 'users.image', 'users.email')
                        ->where('users.id', '=', $request['id'])->get()->first();
        return response()->json(['data' => $user, 'message' => 'Success']);
    }

}
