<?php

namespace App\Mail;

use App\Models\Articulo;
use App\Models\Cliente;
use App\Models\Impuesto;
use App\Models\Precio;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketCobrado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cliente $cliente, Ticket $ticket)
    {
        $this->cliente = $cliente;
        $this->ticket = $ticket;
        $this->subject = "Factura #" . $ticket->id . " @ " . $ticket->centro->nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $cliente = $this->cliente;
        $ticket = $this->ticket;

        $lineas = [];
        $impuestos = [];
        $total = 0;

        foreach (Impuesto::all() as $impuesto) {
            $impuestos[] = [
                'nombre' => $impuesto->nombre,
                'porcentaje' => $impuesto->porcentaje,
                'baseImponible' => 0,
                'total' => 0
            ];
        }

        $centro = $ticket->centro;

        foreach ($ticket->lineas as $linea) {
            if ($linea->estado == 'a') {
                $lineas[] = [
                    'linea_id' => $linea->id,
                    'descripcion' => Precio::find($linea->precio_id)->articulo->nombre_corto,
                    'precio' => $linea->precio,
                    'baseImponible' => $linea->precio / (1 + Precio::find($linea->precio_id)->impuesto->porcentaje / 100),
                    'impuesto' => Precio::find($linea->precio_id)->impuesto,
                ];
                $total += $linea->precio;
                foreach ($impuestos as $key => $impuesto) {
                    if ($key + 1 == Precio::find($linea->precio_id)->impuesto->id) {
                        $impuestos[$key]['baseImponible'] += $linea->precio / (1 + Precio::find($linea->precio_id)->impuesto->porcentaje / 100);
                        $impuestos[$key]['total'] += $linea->precio;
                    }
                }
            }
        }

        return $this->view('mail.ticketCobrado', compact(['cliente', 'ticket', 'lineas', 'impuestos', 'total', 'centro']));
    }
}
