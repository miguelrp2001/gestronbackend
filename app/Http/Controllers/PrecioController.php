<?php

namespace App\Http\Controllers;

use App\Models\Precio;
use Illuminate\Http\Request;

class PrecioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('userActive');
        $this->middleware('userVerified');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Precio  $precio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $precio)
    {
        $precioBD = Precio::find($precio);

        if (!$precioBD || !(new CentroController)->deTusCentros($precioBD->articulo->familia->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $validatedReq = $request->validate([
            'precio' => 'required|numeric|gte:0',
            'impuesto_id' => 'required|exists:impuestos,id',
        ]);

        $precioBD->precio = $validatedReq['precio'];
        $precioBD->impuesto_id = $validatedReq['impuesto_id'];
        $precioBD->save();

        return response()->json(['status' => 'ok', 'data' => ['precio' => $precioBD]], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Precio  $precio
     * @return \Illuminate\Http\Response
     */
    public function destroy($precio)
    {
        $precioBD = Precio::find($precio);

        if (!$precioBD || !(new CentroController)->deTusCentros($precioBD->tarifa->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $precioBD->delete();
        return response()->json(['status' => "ok", "data" => ['mensaje' =>  "Eliminado"]], 200);
    }
}