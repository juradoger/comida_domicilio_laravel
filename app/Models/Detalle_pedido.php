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

    /**
     * Relación con el pedido
     */
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    /**
     * Relación con el producto
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
