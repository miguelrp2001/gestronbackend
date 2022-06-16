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
}