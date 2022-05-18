<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hamcrest\Type\IsBoolean;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('userActive');
        $this->middleware('auth:sanctum');
    }

    public function getUsers()
    {
        $users = User::all();

        $usersSend = [];

        foreach ($users as $user) {
            $nuser = ["id" => $user->id, "name" => $user->name, "email" => $user->email, "admin" => $user->admin, "telefono" => $user->telefono, "activo" => $user->activo, "created_at" => $user->created_at, "updated_at" => $user->updated_at, "ipRegistro" => $user->ipRegistro, "ipUltLogin" => $user->ipUltLogin];
            $usersSend[] = $nuser;
        }

        return response()->json(['status' => "ok", "data" => ['users' =>  $usersSend]]);
    }

    public function getUser($user)
    {
        $userBD = User::find($user);

        if (!$userBD) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $nuser = ["id" => $userBD->id, "name" => $userBD->name, "email" => $userBD->email, "admin" => $userBD->admin, "telefono" => $userBD->telefono, "activo" => $userBD->activo, "created_at" => $userBD->created_at, "updated_at" => $userBD->updated_at, "ipRegistro" => $userBD->ipRegistro, "ipUltLogin" => $userBD->ipUltLogin];

        return response()->json(['status' => "ok", "data" => ["user" => $nuser]], 200);
    }

    public function alternateUser($user, Request $request)
    {
        $userBD = User::find($user);

        if (!$userBD) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        if ($request->estado && is_bool($request->estado)) {
            $userBD->activo = $request->estado;
        } else {
            $userBD->activo = !$userBD->activo;
        }


        $userBD->save();

        if (!$userBD->activo) {
            $userBD->tokens()->delete();
        }

        return response()->json(['status' => "ok", "data" => ['mensaje' => $userBD->activo]], 200);
    }

    public function editUser($user, Request $request)
    {
        $userBD = User::find($user);

        if (!$userBD) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', Rule::unique('users', 'email')->ignore($userBD->id)],
            'telefono' => ['required', 'integer'],
        ]);

        $userBD->name = $validated['name'];
        $userBD->email = $validated['email'];
        $userBD->telefono = $validated['telefono'];
        $userBD->save();

        return response()->json(['status' => "ok", "data" => ['user' => $userBD]], 200);
    }

    public function logAllOut($user)
    {
        $userBD = User::find($user);

        if (!$userBD) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }
        $userBD->tokens()->delete();
        return response()->json(['status' => "ok", "data" => ['mensaje' => "Cerradas todas las sesiones."]], 200);
    }
}
