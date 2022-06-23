<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
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
        if (!$centroBuscado) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $clientes = $centroBuscado->clientes;

        return response()->json(['status' => 'ok', 'data' => ['clientes' => $clientes]], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requValidated = $request->validate([
            'nombre' => 'required|string|max:25',
            'centro_id' => ['required', 'integer', 'exists:centros,id'],
            'direccion' => 'required|string|max:150',
            'nif' => 'required|string|max:9|unique:clientes,nif',
            'nombre_fiscal' => 'required|string|max:25',
            'telefono' => 'required|string|max:15',
            'correo' => 'required|string|max:120',
        ]);

        if (!(new CentroController)->deTusCentros($requValidated['centro_id'])) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $nuevoCliente = new Cliente([
            'nombre' => $requValidated['nombre'],
            'centro_id' => $requValidated['centro_id'],
            'direccion' => $requValidated['direccion'],
            'nif' => $requValidated['nif'],
            'nombre_fiscal' => $requValidated['nombre_fiscal'],
            'telefono' => $requValidated['telefono'],
            'correo' => $requValidated['correo'],
        ]);

        $nuevoCliente->save();

        return response()->json(['status' => 'ok', 'data' => ['cliente' => $nuevoCliente]], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($cliente)
    {
        $clienteBD = Cliente::find($cliente);
        if (!$clienteBD || !(new CentroController)->deTusCentros($clienteBD->centro_id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $tickets = [];

        foreach ($clienteBD->tickets as $ticket) {
            $total = 0;
            foreach ($ticket->lineas as $linea) {
                if ($linea->estado == 'a') {
                    $total += $linea->precio;
                }
		}
                $tickets[] = [
                    'id' => $ticket->id,
                    'fecha' => $ticket->updated_at->format('d/m/Y - H:i:s'),
                    'total' => $total,
                    'estado' => $ticket->estado,
                ];
        }

        return response()->json(['status' => 'ok', 'data' => ['cliente' => $clienteBD, 'tickets' => $tickets]], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cliente)
    {
        $clienteBD = Cliente::find($cliente);

        if (!$clienteBD || (!(new CentroController)->deTusCentros($clienteBD->centro_id))) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $requValidated = $request->validate([
            'nombre' => 'required|string|max:25',
            'direccion' => 'required|string|max:150',
            'nif' => 'required|string|max:9',
            'nombre_fiscal' => 'required|string|max:25',
            'telefono' => 'required|string|max:15',
            'correo' => 'required|string|max:120',
        ]);

        $clienteBD->nombre = $requValidated['nombre'];
        $clienteBD->direccion = $requValidated['direccion'];
        $clienteBD->nif = $requValidated['nif'];
        $clienteBD->nombre_fiscal = $requValidated['nombre_fiscal'];
        $clienteBD->telefono = $requValidated['telefono'];
        $clienteBD->correo = $requValidated['correo'];

        $clienteBD->save();

        return response()->json(['status' => 'ok', 'data' => ['cliente' => $clienteBD]], 200);
    }


    public function updateStatusCorreo($trabajador, Request $request)
    {
        $clienteBD = Cliente::find($trabajador);

        if (!$clienteBD && !(new CentroController)->deTusCentros($clienteBD->centro->id)) {
            return response()->json(['status' => "error", "data" => ['mensaje' =>  "No encontrado"]], 404);
        }

        $validatedReq = $request->validate([
            'estado' => 'required|boolean',
        ]);

        $clienteBD->ticketCorreo = $validatedReq['estado'];

        $clienteBD->save();

        return response()->json(['status' => "ok", "data" => ['mensaje' => $clienteBD->ticketCorreo]], 200);
    }
}
