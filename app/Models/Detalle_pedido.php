<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_pedido extends Model
{   
    use HasFactory;
    protected $fillable = [
        'id_pedido',
        'id_producto',
        'cantidad',
        'precio_unitario'
    ];
}
