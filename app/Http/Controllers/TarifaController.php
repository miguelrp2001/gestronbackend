<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\Tarifa;
use Illuminate\Http\Request;

class TarifaController extends Controller
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

        $tarifas = $centroBuscado->tarifas;

        return response()->json(['status' => 'ok', 'data' => ['familias' => $tarifas]], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function show($tarifa)
    {
        $tarifaBD = Tarifa::find($tarifa);

        if (!$tarifaBD || !(new CentroController)->deTusCentros($tarifaBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }
        return response()->json(['status' => "ok", "data" => ['tarifa' => $tarifaBD, 'precios' => $tarifaBD->precios]], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tarifa)
    {
        //
    }
}