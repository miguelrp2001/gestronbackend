<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    use HasFactory;

    public function articulos()
    {
        return $this->hasManyThrough(Articulo::class, Precio::class);
    }

    public function precios()
    {
        return $this->hasMany(Precio::class);
    }
}