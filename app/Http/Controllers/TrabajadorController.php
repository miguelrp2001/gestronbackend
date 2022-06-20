<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\Trabajador;
use App\Rules\tuCentro;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('userActive');
        $this->middleware('userVerified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($centro)
    {
        $centroBuscado = Centro::find($centro);
        if (!$centroBuscado || !(new CentroController)->deTusCentros($centroBuscado->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }
        $perfiles = Trabajador::where('centro_id', $centroBuscado->id)->get();

        return response()->json(['status' => 'ok', 'data' => ['perfiles' => $perfiles]], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requValidated = $request->validate([
            'nombre' => 'required|string|max:15',
            'clave' => ['required', 'integer', 'min:0', 'max:9999999999999999'],
            'centro_id' => ['required', 'integer', 'exists:centros,id', new tuCentro],
        ]);

        $nuevoPerfil = new Trabajador([
            'nombre' => $requValidated['nombre'],
            'centro_id' => $requValidated['centro_id'],
        ]);

        if ($requValidated['clave']) {
            $nuevoPerfil->clave = password_hash($requValidated['clave'], PASSWORD_DEFAULT);
        }

        $nuevoPerfil->save();

        return response()->json(['status' => 'ok', 'data' => ['perfil' => $nuevoPerfil]], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function show($trabajador)
    {
        $perfilBD = Trabajador::find($trabajador);
        if (!$perfilBD && !(new CentroController)->deTusCentros($perfilBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }
        return response()->json(['status' => "ok", "data" => ['perfil' => $perfilBD]], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $trabajador)
    {
        $perfilBD = Trabajador::find($trabajador);

        if (!$perfilBD && !(new CentroController)->deTusCentros($perfilBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $validatedReq = $request->validate([
            'nombre' => 'required|string|max:15',
            'clave' => ['required', 'integer', 'min:0', 'max:9999999999999999'],
        ]);

        $perfilBD->nombre = $validatedReq['nombre'];

        if ($validatedReq['clave']) {
            $perfilBD->clave = password_hash($validatedReq['clave'], PASSWORD_DEFAULT);
        }

        $perfilBD->save();

        return response()->json(['status' => "ok", "data" => ['perfil' => $perfilBD]], 200);
    }

    public function chgStatus($trabajador, Request $request)
    {
        $perfilBD = Trabajador::find($trabajador);

        if (!$perfilBD && !(new CentroController)->deTusCentros($perfilBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $validatedReq = $request->validate([
            'estado' => 'required|boolean',
        ]);

        $perfilBD->activo = $validatedReq['estado'];

        $perfilBD->save();

        return response()->json(['status' => "ok", "data" => ['mensaje' => $perfilBD->activo]], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function destroy($trabajador)
    {
        $perfilBD = Trabajador::find($trabajador);

        if (!$perfilBD && !(new CentroController)->deTusCentros($perfilBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $perfilBD->destroy();
        return response()->json(['status' => "ok", "data" => ['mensaje' =>  "Perfil eliminado"]], 200);
    }
}