<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\POS;
use App\Rules\tuCentro;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class POSController extends Controller
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

        $puntosVenta = $centroBuscado->pos;

        return response()->json(['status' => 'ok', 'data' => ['puntosVenta' => $puntosVenta]], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'centro_id' => ['required', 'integer', new tuCentro],
            'nombre' => ['required', 'string', 'max:30'],
        ]);

        $nuevoPuntoVenta = new POS();
        $nuevoPuntoVenta->nombre = $validatedRequest['nombre'];
        $nuevoPuntoVenta->centro_id = $validatedRequest['centro_id'];
        $nuevoPuntoVenta->creadoPor = auth()->user()->id;
        $nuevoPuntoVenta->token = Str::upper(Str::random(60));

        $nuevoPuntoVenta->save();

        return response()->json(['status' => 'ok', 'data' => ['puntoVenta' => $nuevoPuntoVenta]], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\POS  $pos
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $pos)
    {
        $validatedRequest = $request->validate([
            'nombre' => ['required', 'string', 'max:30'],
        ]);

        $posBD = POS::find($pos);

        if (!$posBD || !(new CentroController)->deTusCentros($posBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $posBD->nombre = $validatedRequest['nombre'];

        $posBD->save();

        return response()->json(['status' => 'ok', 'data' => ['puntoVenta' => $posBD]], 200);
    }

    public function chgStatus($pos, Request $request)
    {
        $posBD = POS::find($pos);

        if (!$posBD || !(new CentroController)->deTusCentros($posBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $validatedReq = $request->validate([
            'estado' => ['required', 'boolean'],
        ]);

        $posBD->activo = $validatedReq['estado'];

        $posBD->save();

        return response()->json(['status' => 'ok', 'data' => ['mensaje' => $posBD->activo]], 200);
    }

    public function regenerarToken($pos)
    {
        $posBD = POS::find($pos);

        if (!$posBD || !(new CentroController)->deTusCentros($posBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $posBD->token = Str::upper(Str::random(60));

        $posBD->save();

        return response()->json(['status' => 'ok', 'data' => ['puntoVenta' => $posBD]], 200);
    }
}