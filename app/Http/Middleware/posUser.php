<?php

namespace App\Http\Middleware;

use App\Models\POS;
use App\Models\Trabajador;
use Closure;
use Session;
use Illuminate\Http\Request;

class posUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $trabajadorID = $request->header('trabajador');

        $trabajador = Trabajador::find($trabajadorID);

        if (!$trabajador) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No autorizado"]], 401);
        }

        Session::flash('trabajador', $trabajador);

        return $next($request);
    }
}