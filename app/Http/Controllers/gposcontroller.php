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

        // dd($pos);

        $tarifaSeleccionada = Tarifa::find($pos->tarifaSeleccionada);

        $precios = $tarifaSeleccionada->precios;


        $preciosFinales = [];

        foreach ($precios as $precio) {
            $preciosFinales[] = [
                'id' => $precio->id,
                'precio' => $precio->precio,
                'impuesto' => $precio->impuesto,
                'articulo' => $precio->articulo,
            ];
        }


        return response()->json(['status' => 'ok', 'data' => ['precios' => $preciosFinales]], 200);
    }

    public function familias()
    {
        $pos = Centro::find(Session::get('pos')->centro_id);

        $familias = $pos->familias;

        return response()->json(['status' => 'ok', 'data' => ['familias' => $familias]], 200);
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
}