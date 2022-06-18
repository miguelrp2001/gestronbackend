<?php

namespace App\Http\Controllers;

use App\Mail\codigoConfirmacion;
use App\Mail\loginNuevaIp;
use App\Mail\usuarioNuevo;
use App\Models\Centro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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
        $this->middleware('auth:sanctum', ['except' => ['login', 'register', 'notValidToken']]);
        $this->middleware('userActive', ['except' => ['login', 'register', 'notValidToken']]);
        $this->middleware('userVerified', ['except' => ['login', 'register', 'notValidToken', 'resendVerificationCode', 'verify']]);
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

        if ($authUser->ipUltLogin != $request->ip()) {
            Mail::to($authUser->email)->send(new loginNuevaIp($authUser));
        }

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


    public function register(Request $request)
    {
        $userAtr = $request->validate(
            [
                'nombre' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255', 'email', 'unique:users,email'],
                'nif' => ['required', 'max:9', 'string', 'unique:centros,nif'],
                'password' => ['required', 'string', 'max:255', 'min:6', 'confirmed'],
                'nombre_legal' => ['required', 'max:60', 'string', 'unique:centros,nombre_legal'],
                'nombre_empresa' => ['required', 'max:60', 'string'],
                'telefono' =>  ['required', 'max:9', 'string'],
            ]
        );

        $user = User::create([
            'name' => $userAtr['nombre'],
            'email' => $userAtr['email'],
            'password' => bcrypt($userAtr['password']),
            'telefono' => $userAtr['telefono'],
        ]);

        $centro = Centro::create([
            'nombre' => $userAtr['nombre_empresa'],
            'nombre_legal' => $userAtr['nombre_legal'],
            'nif' => $userAtr['nif'],
            'telefono' => $userAtr['telefono'],
            'direccion' => ". . .",
        ]);

        $this->sendEmailVerificationNotification($user);

        $admins = User::where('admin', true)->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new usuarioNuevo($centro, $user, $admin));
        }


        $user->ipUltLogin = $request->ip();
        $user->ipRegistro = $request->ip();
        $user->save();

        return response()->json(['status' => 'ok', 'data' => ['token' => $user->createToken('SanctumToken')->plainTextToken, 'user' => $user]], 200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json(['status' => 'ok', 'data' => ['mensaje' => 'logout']], 200);
    }

    public function resendVerificationCode()
    {
        $user = User::find(Auth::id());
        $this->sendEmailVerificationNotification($user);

        return response()->json(['status' => 'ok', 'data' => ['mensaje' => 'codigo enviado']], 200);
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(['status' => 'ok', 'data' => ['user' => Auth::user(), 'centros' => Auth::user()->centros]], 200);
    }


    private function sendEmailVerificationNotification(User $user)
    {
        if (!$user->hasVerifiedEmail()) {
            return Mail::to($user)->send(new codigoConfirmacion($user));
        } else {
            return false;
        }
    }

    public function verify(Request $request)
    {
        $verRequest = $request->validate(
            [
                'vercode' => ['required', 'numeric', 'max:999999']
            ]
        );

        if (Auth::user()->codigoConfirmacion == $verRequest['vercode']) {
            $ussuario = User::find(Auth::user()->id);

            $ussuario->email_verified_at = now();
            $ussuario->save();

            return response()->json(['status' => 'ok', 'data' => ['mensaje' => 'codigo correcto']], 200);
        } else {
            return response()->json(['status' => 'error', 'data' => ['mensaje' => 'codigo incorrecto']], 400);
        }
    }
}