<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'trabajador_id',
        'precio_id',
        'precio',
    ];


    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function precioOrigen()
    {
        return $this->belongsTo(Precio::class);
    }
}