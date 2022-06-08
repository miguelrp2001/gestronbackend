<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\Familia;
use App\Rules\tuCentro;
use Illuminate\Http\Request;

class FamiliaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('userActive');
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

        $familias = $centroBuscado->familias;

        return response()->json(['status' => 'ok', 'data' => ['familias' => $familias]], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $familiaBD = new Familia();
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:15', 'min:1'],
            'centro' => ['required', 'integer', new tuCentro]
        ]);
        $familiaBD->nombre = $validated['nombre'];
        $familiaBD->centro_id = $validated['centro'];
        $familiaBD->save();
        return response()->json(['status' => "ok", "data" => ['familia' => $familiaBD]], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function show($familia)
    {
        $familiaBD = Familia::find($familia);

        if (!$familiaBD || !(new CentroController)->deTusCentros($familiaBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }
        return response()->json(['status' => "ok", "data" => ['familia' => $familiaBD]], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $familia)
    {
        $familiaBD = Familia::find($familia);

        if (!$familiaBD || !(new CentroController)->deTusCentros($familiaBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:15', 'min:1'],
            'centro' => ['required', 'integer', new tuCentro]
        ]);
        $familiaBD->nombre = $validated['nombre'];
        $familiaBD->centro_id = $validated['centro'];
        $familiaBD->save();
        return response()->json(['status' => "ok", "data" => ['familia' => $familiaBD]], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function destroy($familia)
    {
        $familiaBD = Familia::find($familia);

        if (!$familiaBD || !(new CentroController)->deTusCentros($familiaBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        if (count($familiaBD->articulos) > 0) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "La familia tiene artículos"]], 422);
        }

        Familia::destroy($familiaBD->id);
        return response()->json(['status' => "ok", "data" => ['mensaje' =>  "Familia eliminada"]], 404);
    }
}
