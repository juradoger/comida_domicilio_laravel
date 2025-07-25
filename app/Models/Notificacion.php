<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';

    protected $fillable = [
        'id_usuario',
        'mensaje',
        'tipo',
        'datos_adicionales',
        'leido',
        'fecha_envio',
    ];

    protected $casts = [
        'datos_adicionales' => 'array',
        'leido' => 'boolean',
        'fecha_envio' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
