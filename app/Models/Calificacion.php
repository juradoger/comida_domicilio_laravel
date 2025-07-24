<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'calificaciones';

    protected $fillable = [
        'id_pedido',
        'id_usuario',
        'id_empleado',
        'calificacion',
        'comentario',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function empleado()
    {
        return $this->belongsTo(User::class, 'id_empleado');
    }
}
