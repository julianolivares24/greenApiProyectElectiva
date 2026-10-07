<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    protected $fillable = [
        'cliente_id',
        'product_id',
        'valor_producto',
        'cuota_inicial',
        'saldo',
        'numero_cuotas',
        'valor_cuota',
        'fecha_inicio',
        'estado',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function producto()
    {
        return $this->belongsTo(Product::class);
    }
}