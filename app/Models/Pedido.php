<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_usuario',
        'id_empleado',
        'total',
        'subtotal',
        'costo_envio',
        'fecha_entrega',
        'estado',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'fecha_entrega' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Las reglas de validación para el modelo.
     *
     * @var array
     */
    public static $rules = [
        'id_usuario' => 'required|exists:users,id',
        'id_empleado' => 'nullable|exists:empleados,id',
        'total' => 'required|numeric|min:0',
        'subtotal' => 'required|numeric|min:0',
        'costo_envio' => 'required|numeric|min:0',
        'fecha_entrega' => 'required|date',
        'estado' => 'required|in:pendiente,aceptado,en_camino,entregado,cancelado',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    /**
     * Alias para empleado - obtiene el repartidor del pedido.
     */
    public function repartidor()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public function direcciones()
    {
        return $this->hasMany(Direccion::class, 'id_pedido');
    }

    /**
     * Obtiene la dirección principal del pedido.
     */
    public function direccion()
    {
        return $this->hasOne(Direccion::class, 'id_pedido');
    }

    /**
     * Obtiene los detalles del pedido.
     */
    public function detalles()
    {
        return $this->hasMany(Detalle_pedido::class, 'id_pedido');
    }

    /**
     * Obtiene el reparto asociado al pedido.
     */
    public function reparto()
    {
        return $this->hasOne(Reparto::class, 'id_pedido');
    }

    /**
     * Obtiene la calificación asociada al pedido.
     */
    public function calificacion()
    {
        return $this->hasOne(Calificacion::class, 'id_pedido');
    }

    /**
     * Obtiene los pagos asociados al pedido.
     */
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_pedido');
    }
}
