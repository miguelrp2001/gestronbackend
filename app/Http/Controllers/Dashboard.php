<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('userActive');
        $this->middleware('userVerified');
    }

    public function dashboard($centro)
    {
        $centroBuscado = Centro::find($centro);
        if (!$centroBuscado || !(new CentroController)->deTusCentros($centroBuscado->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $ticketsCobrados = $centroBuscado->tickets()->where('estado', 'c')->whereDate('created_at', Carbon::today())->get()->count();
        $ticketsPendientes = $centroBuscado->tickets()->where('estado', 'n')->whereDate('created_at', Carbon::today())->get()->count();
        $ticketsAnulados = $centroBuscado->tickets()->where('estado', 'a')->whereDate('created_at', Carbon::today())->get()->count();

        $trabajadores = $centroBuscado->trabajadors()->where('activo', 1)->get();

        $lineasPorTrabajador = [];

        foreach ($trabajadores as $trabajador) {
            $lineasPorTrabajador[] = ["nombre" => $trabajador->nombre, "anulaciones" => $trabajador->lineas()->where('estado', 'a')->whereDate('created_at', Carbon::today())->get()->count(), "marcadas" => $trabajador->lineas()->where('estado', 'c')->whereDate('created_at', Carbon::today())->get()->count()];
        }

        return response()->json(['status' => "ok", "data" => ["stats" => ['ticketsCobrados' => $ticketsCobrados, 'ticketsPendientes' => $ticketsPendientes, 'ticketsAnulados' => $ticketsAnulados, 'lineasPorTrabajador' => $lineasPorTrabajador]]], 200);
    }
}
