<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'documento',
        'telefono',
        'email',
        'direccion',
    ];

    public function creditos()
    {
        return $this->hasMany(Credito::class);
    }
}