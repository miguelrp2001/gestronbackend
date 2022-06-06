<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'centro_id'
    ];

    public function articulos()
    {
        return $this->hasMany(Articulo::class);
    }


    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }
}