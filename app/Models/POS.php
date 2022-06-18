<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POS extends Model
{
    use HasFactory;

    protected $fillable = [
        'centro_id',
        'nombre',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }

    public function creadoPor()
    {
        return $this->belongsTo(User::class, 'creadoPor', 'id');
    }
}