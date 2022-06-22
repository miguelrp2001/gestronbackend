<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'forma_pago_id',
        'cantidad',
        'estado',
        'trabajador_id'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function metodoPago()
    {
        return $this->belongsTo(FormaPago::class);
    }
}
