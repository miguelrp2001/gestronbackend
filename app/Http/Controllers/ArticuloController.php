<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Centro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CentroController;
use App\Rules\inCentro;
use App\Rules\inCentroNuevo;

class ArticuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('userActive');
        $this->middleware('userAdminCenter');
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

        $articulos = $centroBuscado->articulos;

        return response()->json(['status' => 'ok', 'data' => ['articulos' => $articulos]], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $articuloBD = new Articulo();

        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:25', 'min:1'],
            'nombre_corto' => ['required', 'string', 'max:15', 'min:1'],
            'color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'familia' => ['required', 'integer', new inCentroNuevo],
            'codbarras' => ['nullable', 'string', 'max:50', 'min:1'],
        ]);

        $articuloBD->nombre = $validated['nombre'];
        $articuloBD->nombre_corto = $validated['nombre_corto'];
        $articuloBD->color = $validated['color'];
        $articuloBD->familia_id = $validated['familia'];
        $articuloBD->codbarras = $validated['codbarras'];
        $articuloBD->save();
        return response()->json(['status' => "ok", "data" => ['articulo' => $articuloBD]], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show($articulo)
    {
        $articuloBD = Articulo::find($articulo);

        if (!$articuloBD || !$this->articuloDeTuCentro($articuloBD->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        return response()->json(['status' => "ok", "data" => ['mensaje' => $articuloBD]], 200);
    }



    /**
     * Cambiar o alternar estado de un artículo.
     *
     * @param  \App\Models\Articulo  $articulo
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function chgStatusArticulo($articulo, Request $request)
    {
        $articuloBD = Articulo::find($articulo);

        if (!$articuloBD || !$this->articuloDeTuCentro($articuloBD->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        if ($request->estado && is_bool($request->estado)) {
            $articuloBD->estado = ($request->estado ? 'a' : 'i');
        } else {
            $articuloBD->estado = ($articuloBD->estado == 'i' ? 'a' : 'i');
        }

        $articuloBD->save();

        return response()->json(['status' => "ok", "data" => ['mensaje' => ($articuloBD->estado == 'a' ? true : false)]], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $articulo)
    {
        $articuloBD = Articulo::find($articulo);

        if (!$articuloBD || !$this->articuloDeTuCentro($articuloBD->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:25', 'min:1'],
            'nombre_corto' => ['required', 'string', 'max:15', 'min:1'],
            'color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'familia' => ['required', 'integer', new inCentro],
            'codBarras' => ['nullable', 'string', 'max:50', 'min:1'],
        ]);


        $articuloBD->nombre = $validated['nombre'];
        $articuloBD->nombre_corto = $validated['nombre_corto'];
        $articuloBD->color = $validated['color'];
        $articuloBD->familia_id = $validated['familia'];
        $articuloBD->codbarras = $validated['codBarras'];

        $articuloBD->save();
        return response()->json(['status' => "ok", "data" => ['articulo' => $articuloBD]], 200);
    }


    /**
     * Update the familia of the articulo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function updateFamily(Request $request, $articulo)
    {
        $articuloBD = Articulo::find($articulo);

        if (!$articuloBD || !$this->articuloDeTuCentro($articuloBD->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }



        $validated = $request->validate([
            'familia' => ['required', 'integer', new inCentroNuevo]
        ]);

        $articuloBD->familia_id = $validated['familia'];
        $articuloBD->save();
        return response()->json(['status' => "ok", "data" => ['user' => $articuloBD]], 200);
    }


    /**
     * Verifica si un artículo es de tu centro.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return boolean
     */
    protected function articuloDeTuCentro($articulo)
    {
        $artBd = Articulo::find($articulo);

        if (!$artBd || !(new CentroController)->deTusCentros($artBd->familia->centro->id)) {
            return false;
        }

        return true;
    }
}