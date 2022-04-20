<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    use HasFactory;


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function familias()
    {
        return $this->hasMany(Familia::class);
    }

    public function articulos()
    {
        return $this->hasManyThrough(Articulo::class, Familia::class);
    }

    public function tarifas()
    {
        return $this->hasMany(Tarifa::class);
    }

    public function trabajadors()
    {
        return $this->hasMany(Trabajador::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // public function clientes()
    // {
    //     return $this->hasMany(Cliente::class);
    // }
}