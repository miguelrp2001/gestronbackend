<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Centro;
use App\Models\Impuesto;
use App\Models\Tarifa;
use App\Rules\tuCentro;
use Illuminate\Http\Request;

class TarifaController extends Controller
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

        $tarifas = $centroBuscado->tarifas;

        return response()->json(['status' => 'ok', 'data' => ['tarifas' => $tarifas, 'centro' => $centroBuscado]], 200);
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

        $nuevaTarifa = new Tarifa();
        $nuevaTarifa->nombre = $validatedRequest['nombre'];
        $nuevaTarifa->centro_id = $validatedRequest['centro_id'];

        $nuevaTarifa->save();

        return response()->json(['status' => 'ok', 'data' => ['tarifa' => $nuevaTarifa]], 200);
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

        $precios = [];

        foreach ($tarifaBD->precios as $precio) {
            $precios[] = [
                'id' => $precio->id,
                'articulo' => $precio->articulo,
                'precio' => $precio->precio,
                'impuesto' => $precio->impuesto,
            ];
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
        $validatedRequest = $request->validate([
            'nombre' => ['required', 'string', 'max:30'],
        ]);

        $tarifaBD = Tarifa::find($tarifa);

        if (!$tarifaBD || !(new CentroController)->deTusCentros($tarifaBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $tarifaBD->nombre = $validatedRequest['nombre'];

        $tarifaBD->save();

        return response()->json(['status' => 'ok', 'data' => ['tarifa' => $tarifaBD]], 200);
    }

    public function getNotArticulos($tarifa)
    {
        $tarifaBD = Tarifa::find($tarifa);

        if (!$tarifaBD || !(new CentroController)->deTusCentros($tarifaBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $articulos = [];
        $pluckIDs = $tarifaBD->precios->pluck('articulo_id')->toArray();
        foreach ($tarifaBD->centro->articulos as $articulo) {
            if (!in_array($articulo->id, $pluckIDs)) {
                $articulos[] = $articulo;
            }
        }

        return response()->json(['status' => "ok", "data" => ['articulos' => $articulos]], 200);
    }

    public function getArticulos($tarifa)
    {
        $tarifaBD = Tarifa::find($tarifa);

        if (!$tarifaBD || !(new CentroController)->deTusCentros($tarifaBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $articulos = [];

        foreach ($tarifaBD->precios as $precio) {
            $articulos[] = $precio->articulo;
        }

        return response()->json(['status' => "ok", "data" => ['articulos' => $articulos]], 200);
    }

    public function addArticulo($tarifa, Request $request)
    {
        $tarifaBD = Tarifa::find($tarifa);

        if (!$tarifaBD || !(new CentroController)->deTusCentros($tarifaBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        if ($request->has('articulos') && sizeof($request->articulos) > 0) {

            foreach ($request->articulos as $articulo) {
                $articuloBD = Articulo::find($articulo);
                if ($articuloBD && (new CentroController)->deTusCentros($articuloBD->familia->centro->id) && !$this->inTarifa($tarifaBD, $articuloBD)) {
                    $tarifaBD->precios()->create([
                        'articulo_id' => $articuloBD->id,
                        'precio' => 0,
                        'impuesto_id' => 1,
                    ]);
                }
            }
        }

        return response()->json(['status' => "ok", "data" => ['mensaje' => "Añadidos satisfactoriamente"]], 200);
    }

    public function tarifaPorDefecto($tarifa)
    {

        $tarifaBD = Tarifa::find($tarifa);
        $centroBD = Centro::find($tarifaBD->centro_id);


        if (!$tarifaBD || !$centroBD || !(new CentroController)->deTusCentros($centroBD->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $centroBD->tarifaSeleccionada = $tarifaBD->id;
        $centroBD->save();

        return response()->json(['status' => "ok", "data" => ['mensaje' => "Tarifa por defecto cambiada"]], 200);
    }

    private function inTarifa(Tarifa $tarifa, Articulo $articulo,)
    {
        foreach ($tarifa->precios as $precio) {
            if ($precio->articulo_id == $articulo->id) {
                return true;
            }
        }
        return false;
    }
}