<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    public function familia()
    {
        return $this->belongsTo(Familia::class);
    }

    public function precios()
    {
        return $this->hasMany(Precio::class);
    }

    public function tarifas()
    {
        return $this->hasManyThrough(Tarifa::class, Precio::class);
    }

    public function lineas()
    {
        return $this->belongsToMany(Linea::class);
    }
}