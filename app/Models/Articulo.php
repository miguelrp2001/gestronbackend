<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'familia_id' => 'integer'
    ];


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