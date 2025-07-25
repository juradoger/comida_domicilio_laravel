<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_ingreso',
        'estado',
        'dni',
        'licencia_conducir',
        'calificacion_promedio',
        'id_usuario',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    /**
     * Relación con pedidos activos del empleado
     */
    public function pedidosActivos()
    {
        return $this->hasMany(Pedido::class, 'id_empleado')
            ->whereIn('estado', ['pendiente', 'en_camino']);
    }

    /**
     * Relación con todos los pedidos del empleado
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_empleado');
    }
}
