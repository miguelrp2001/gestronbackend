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

    public function tarifas()
    {
        return $this->hasMany(Tarifa::class);
    }
}