<?php

namespace App\Http\Middleware;

use App\Models\POS;
use Closure;
use Session;
use Illuminate\Http\Request;

class posToken
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
        $token = $request->header('token');

        $pos = POS::where('token', $token)->first();

        if (!$pos || !$pos->activo) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No autorizado"]], 401);
        }
        Session::flash('pos', $pos);
        return $next($request);
    }
}
