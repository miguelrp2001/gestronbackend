<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'centro_id',
        'trabajador_id'
    ];

    public function lineas()
    {
        return $this->hasMany(Linea::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function creador()
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }

    public function cobros()
    {
        return $this->hasMany(Cobro::class);
    }
}
