<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class   AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = User::create([
           'name' => $request->get('name'),
           'email' => $request->get('email'),
           'password' => Hash::make($request->get('password')),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function login(LoginUserRequest $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        if (!$user || !Hash::check($request->get('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function user(Request $request)
    {
        return response()->json(auth('sanctum')->user());
    }

    public function logout(Request $request)
    {
        request()->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
