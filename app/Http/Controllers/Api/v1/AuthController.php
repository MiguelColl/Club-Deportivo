<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt(($credentials))) {
            return response()->json([
                'message' => 'Usuario y/o contraseña incorrectos'
            ], 401);
        }

        $accessToken = Auth::user()->createToken(env('SECRET'))->accessToken;

        return response()->json([
            'user' => Auth::user(),
            'access_token' => $accessToken
        ]);
    }
}
