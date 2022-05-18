<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'register', 'notValidToken', 'sendmail']]);
        $this->middleware('userActive', ['except' => ['login', 'register', 'notValidToken', 'sendmail']]);
    }


    public function login(Request $request)
    {
        $userAtr = $request->validate(
            [
                'email' => ['required', 'string', 'max:255', 'email'],
                'password' => ['required', 'string', 'max:255', 'min:6']
            ]
        );

        if (!Auth::attempt($userAtr) || !Auth::user()->activo) {
            return response()->json(['status' => 'error', 'data' => ['mensaje' => 'no me sirve']], 401);
        }


        $authUser = Auth::user();


        $authUser->ipUltLogin = $request->ip();
        $authUser->save();

        return response()->json(['status' => 'ok', 'data' => ['token' => $authUser->createToken('SanctumToken')->plainTextToken, 'user' => $authUser]], 200);
    }

    /**
     * Return error.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function notValidToken()
    {
        return response()->json(['status' => 'error', 'data' => ['mensaje' => 'Pues no']], 401);
    }


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
            'confirmation_code' => str_random(60),
        ]);

        return response()->json(['token' => $user->createToken('tokens')->plainTextToken], 200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json(['status' => 'ok', 'data' => ['mensaje' => 'logout']]);
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        // dd(['status' => 'ok', 'data' => ['user' => Auth::user()]]);
        return response()->json(['status' => 'ok', 'data' => ['user' => Auth::user(), 'centros' => Auth::user()->centros]]);
    }

    public function sendmail(Request $request)
    {
        $usr = $request->userr;
        $user = User::findOrFail($usr);
        // $user->sendEmailVerificationNotification();
        Password::sendResetLink(
            ["email" => $user->email]
        );
        return response()->json(['status' => 'ok', 'data' => ['mensaje' => "Correo enviado."]]);
    }
}