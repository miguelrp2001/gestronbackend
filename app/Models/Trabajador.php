<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'clave', 'centro_id'
    ];

    protected $hidden = [
        'clave'
    ];

    public function lineas()
    {
        return $this->hasMany(Linea::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }
}