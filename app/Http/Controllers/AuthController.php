<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;


class AuthController extends Controller
{
    public function signup(SignupRequest $request) {
        $data = $request->validated();

        /** @var User $user */
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $token = $user->createToken('main')->plainTextToken;

        return response(compact('user', 'token'));
    }

    public function login(LoginRequest $request) {
        $credentials = $request->validated();
        if(!Auth::attempt($credentials)) {
            return response([
                'message' => 'Provided email address or password is incorrect'
            ], 422);
        }

        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;
        return response(compact('user', 'token'));
    }

    public function logout(Request $request) {
        /** @var User $user */
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response('', 204);
    }
}
