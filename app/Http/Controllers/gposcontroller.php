<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\Familia;
use App\Models\Tarifa;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class gposcontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('posToken');
        $this->middleware('posUser')->only('addTicket');
    }

    public function index()
    {
        $pos = Centro::find(Session::get('pos')->centro_id);
        return response()->json(['status' => 'ok', 'data' => ['centro' => $pos]], 200);
    }

    public function loadData()
    {
        $pos = Centro::find(Session::get('pos')->centro_id);

        $articulos = $pos->articulos();
        $familias = $pos->familias();
        $centro = $pos;

        return response()->json(['status' => 'ok', 'data' => ['articulos' => $articulos, 'familias' => $familias, 'centro' => $centro]], 200);
    }

    public function articulos()
    {
        $pos = Centro::find(Session::get('pos')->centro_id);

        $tarifaSeleccionada = Tarifa::find($pos->tarifaSeleccionada);

        $precios = $tarifaSeleccionada->precios;


        $preciosFinales = [];

        foreach ($precios as $precio) {
            if ($precio->articulo->estado == 'a') {
                $preciosFinales[] = [
                    'id' => $precio->id,
                    'precio' => $precio->precio,
                    'impuesto' => $precio->impuesto,
                    'articulo' => $precio->articulo,
                ];
            }
        }


        return response()->json(['status' => 'ok', 'data' => ['precios' => $preciosFinales]], 200);
    }

    public function familias()
    {
        $pos = Centro::find(Session::get('pos')->centro_id);

        $familias = $pos->familias;
        $familiasFinal = [];

        foreach ($familias as $familia) {
            if (count($familia->articulos) > 0) {
                $familiasFinal[] = $familia;
            }
        }

        return response()->json(['status' => 'ok', 'data' => ['familias' => $familiasFinal]], 200);
    }


    public function clientes()
    {
        $pos = Centro::find(Session::get('pos')->centro_id);

        $clientes = $pos->clientes;

        return response()->json(['status' => 'ok', 'data' => ['clientes' => $clientes]], 200);
    }

    public function perfiles()
    {
        $pos = Centro::find(Session::get('pos')->centro_id);

        $perfiles = Trabajador::where('centro_id', $pos->id)->where('activo', true)->get();

        return response()->json(['status' => 'ok', 'data' => ['perfiles' => $perfiles]], 200);
    }

    public function authTrabajador(Request $request)
    {

        $trabajador = Trabajador::find($request['id']);

        if (!$trabajador || !$trabajador->activo || $trabajador->centro_id != Session::get('pos')->centro_id) {
            return response()->json(['status' => 'error', 'message' => 'Trabajador no encontrado'], 404);
        }

        if (password_verify($request['clave'], $trabajador->clave)) {
            return response()->json(['status' => 'ok', 'data' => ['trabajador' => $trabajador]], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Contraseña incorrecta'], 403);
        }
    }

    public function tickets()
    {
        $pos = Centro::find(Session::get('pos')->centro_id);

        $tickets = $pos->tickets;

        return response()->json(['status' => 'ok', 'data' => ['tickets' => $tickets]], 200);
    }

    public function addTicket(Request $request)
    {
        $pos = Centro::find(Session::get('pos')->centro_id);
        $trabajador = Trabajador::find(Session::get('trabajador')->id);

        $validatedRequest = $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'items' => 'required|array',
        ]);


        $ticket = $pos->tickets()->create([
            'centro_id' => $pos->id,
            'trabajador_id' => $trabajador->id,
        ]);

        return response()->json(['status' => 'ok', 'data' => ['ticket' => $ticket]], 200);
    }
}