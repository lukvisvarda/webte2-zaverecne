<?php

namespace App\Http\Controllers;
use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Enum;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = Auth::user();
        return response()->json(compact('token', 'user'));
    }

    public function me()
    {
        $user = Auth::user();
        return response()->json($user);
    }

  public function register(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|unique:users|max:255',
      'password' => 'required|string|min:8|max:255|confirmed',
      'role' => ['required', new Enum(RolesEnum::class)],
      'aisId' => 'required|string|max:255',
    ]);

    $user = User::create([
      'name' => $validatedData['name'],
      'email' => $validatedData['email'],
      'password' => Hash::make($validatedData['password']),
      'role' => $validatedData['role'],
      'aisId' => $validatedData['aisId'],
    ]);

    $token = JWTAuth::fromUser($user);

    return response()->json(compact('token', 'user'));
  }

}
