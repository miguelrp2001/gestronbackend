<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    protected $fillable = [
        'nombre',
        'centro_id',
        'direccion',
        'nif',
        'nombre_fiscal',
        'telefono',
        'correo'
    ];

    protected $casts = [
        'ticketCorreo' => 'boolean',
    ];
}