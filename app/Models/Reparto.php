<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pedido',
        'id_repartidor',
        'hora_salida',
        'hora_entrega',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    public function repartidor()
    {
        return $this->belongsTo(User::class, 'id_repartidor');
    }
}
