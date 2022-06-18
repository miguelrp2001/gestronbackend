<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CentroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('userActive');
        $this->middleware('admin');
        $this->middleware('userVerified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centros = Centro::all();

        return response()->json(['status' => "ok", "data" => ['centros' => $centros]], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCentroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $centroAtrib = $request->validate([
            "nombre" => ['required', 'max:60', 'string'],
            "nombre_legal" => ['required', 'max:60', 'string', 'unique:centros,nombre_legal'],
            "nif" => ['required', 'max:9', 'string', 'unique:centros,nif'],
            "telefono" => ['required', 'max:9', 'string'],
            "direccion" => ['required', 'max:160', 'string'],
        ]);

        $centro = Centro::create([
            "nombre" => $centroAtrib['nombre'],
            "nombre_legal" => $centroAtrib['nombre_legal'],
            "nif" => $centroAtrib['nif'],
            "telefono" => $centroAtrib['telefono'],
            "direccion" => $centroAtrib['direccion'],
        ]);

        return response()->json(['status' => "ok", "data" => ['centro' => $centro]], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function show(Centro $centro)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCentroRequest  $request
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $centro)
    {
        $centroBD = Centro::find($centro);

        if (!$centroBD) {
            return response()->json(['status' => "error", "data" => ['message' => "Centro no encontrado"]], 404);
        }

        $centroAtrib = $request->validate([
            "nombre" => ['required', 'max:60', 'string'],
            "nombre_legal" => ['required', 'max:60', 'string', 'unique:centros,nombre_legal'],
            "nif" => ['required', 'max:9', 'string', 'unique:centros,nif'],
            "telefono" => ['required', 'max:9', 'string'],
            "direccion" => ['required', 'max:160', 'string'],
        ]);

        $centroBD->update([
            "nombre" => $centroAtrib['nombre'],
            "nombre_legal" => $centroAtrib['nombre_legal'],
            "nif" => $centroAtrib['nif'],
            "telefono" => $centroAtrib['telefono'],
            "direccion" => $centroAtrib['direccion'],
        ]);

        return response()->json(['status' => "ok", "data" => ['centro' => $centroBD]], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Centro $centro)
    {
        //
    }

    /**
     * Devolver los administradores del centro.
     *
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function admins($centro)
    {
        $centroBuscado = Centro::find($centro);
        if (!$centroBuscado) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $usersSend = [];

        foreach ($centroBuscado->administradors as $user) {
            $nuser = ["id" => $user->id, "name" => $user->name, "email" => $user->email, "telefono" => $user->telefono];
            $usersSend[] = $nuser;
        }

        return response()->json(['status' => "ok", "data" => ['users' =>  $usersSend]]);
    }

    /**
     * Añadir administradores del centro.
     *
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function addAdmins($centro, Request $request)
    {
        $centroBuscado = Centro::find($centro);
        if (!$centroBuscado) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        if ($request->usuarios && sizeof($request->usuarios) > 0) {
            foreach ($request->usuarios as $usuario) {
                $usuarioEncontrado = User::findOrFail($usuario);
                $centroBuscado->administradors()->attach($usuarioEncontrado->id);
            }
        }

        $usersSend = [];

        foreach ($centroBuscado->administradors as $user) {
            $nuser = ["id" => $user->id, "name" => $user->name, "email" => $user->email, "telefono" => $user->telefono];
            $usersSend[] = $nuser;
        }

        return response()->json(['status' => "ok", "data" => ['users' =>  $usersSend]]);
    }

    /**
     * Eliminar administradores del centro.
     *
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function delAdmins($centro, $user)
    {
        $centroBuscado = Centro::find($centro);
        $userBuscado = User::find($user);

        if (!$centroBuscado || !$userBuscado) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $centroBuscado->administradors()->detach($userBuscado->id);


        $usersSend = [];

        foreach ($centroBuscado->administradors as $user) {
            $nuser = ["id" => $user->id, "name" => $user->name, "email" => $user->email, "telefono" => $user->telefono];
            $usersSend[] = $nuser;
        }

        return response()->json(['status' => "ok", "data" => ['users' =>  $usersSend]]);
    }

    /**
     * Obtener usuarios no presentes en un centro.
     *
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function getNotAdmins($centro)
    {
        $centroBuscado = Centro::find($centro);
        if (!$centroBuscado) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $ids = [];
        foreach ($centroBuscado->administradors as $admin) {
            $ids[] += $admin->id;
        }

        $notAdmins = User::all()->where('activo', true)->whereNotIn('id', $ids);

        $usersSend = [];

        foreach ($notAdmins as $user) {
            $nuser = ["id" => $user->id, "name" => $user->name, "email" => $user->email, "telefono" => $user->telefono];
            $usersSend[] = $nuser;
        }

        return response()->json(['status' => "ok", "data" => ['users' =>  $usersSend]]);
    }

    /**
     * Verifica si un centro es tuyo.
     *
     * @param  \App\Models\Centro  $centro
     * @return boolean
     */
    public function deTusCentros($centro)
    {
        $centroBd = Centro::find($centro);

        if (!$centroBd) {
            return false;
        }


        foreach (Auth::user()->centros as $centro) {
            if ($centroBd->id == $centro->id) {
                return true;
            }
        }

        return false;
    }
}