<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    public function lineas()
    {
        return $this->hasMany(Linea::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}