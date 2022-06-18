<?php

namespace App\Http\Controllers;

use App\Models\Impuesto;

class ImpuestoController extends Controller
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
    public function index()
    {
        $impuestos = Impuesto::all();
        return response()->json(['status' => 'ok', 'data' => ['impuestos' => $impuestos]], 200);
    }
}