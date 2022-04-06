<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function createAccount(Request $request)
    {
        $userAtr = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255', 'email', 'unique:users,email'],
                'password' => ['required', 'string', 'max:255', 'min:6', 'confirmed']
            ]
        );

        $user = User::create([
            'name' => $userAtr['name'],
            'email' => $userAtr['email'],
            'password' => bcrypt($userAtr['password']),
        ]);

        return response()->json(['token' => $user->createToken('tokens')->plainTextToken], 200);
    }

    public function loginAccount(Request $request)
    {
        $userAtr = $request->validate(
            [
                'email' => ['required', 'string', 'max:255', 'email'],
                'password' => ['required', 'string', 'max:255', 'min:6']
            ]
        );

        if (!Auth::attempt($userAtr)) {
            return response()->json(['error' => 'Credenciales inváidos.'], 401);
        }

        return response()->json(['token' => auth()->user()->createToken('API Token')->plainTextToken], 200);
    }

    public function signout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}