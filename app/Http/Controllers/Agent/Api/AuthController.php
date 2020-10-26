<?php

namespace App\Http\Controllers\Agent\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credintial = $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        if(!auth('agent')->attempt($credintial)){
            return response([
                'success' => false,
                'status' => 401,
                'message' => 'Wrong User Password'
            ], 401);
        }

        $accessToken = auth('agent')->user()->createToken('authToken')->accessToken;

        return response([
            'success' => true,
            'status' => 200,
            'user' => auth('agent')->user(),
            'access_token' => $accessToken
        ], 200);
    }
}
