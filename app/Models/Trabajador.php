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


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'activo' => 'boolean'
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