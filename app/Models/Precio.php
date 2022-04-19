<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    use HasFactory;

    public function tarifa()
    {
        return $this->belongsTo(Tarifa::class);
    }

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }

    public function impuesto()
    {
        return $this->belongsTo(Impuesto::class);
    }
}