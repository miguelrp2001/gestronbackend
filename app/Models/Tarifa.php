<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    use HasFactory;

    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }

    public function precios()
    {
        return $this->hasMany(Precio::class);
    }

    public function articulos()
    {
        return $this->hasManyThrough(Articulo::class, Precio::class);
    }
}