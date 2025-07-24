<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'surname', // BEGIN: added_surname
        'phone',   // BEGIN: added_phone
        'email',
        'apellido',
        'password',
        'telefono',
        'id_rol'
    ];
    
    /**
     * Las reglas de validación para el modelo.
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'telefono' => 'required|string|max:20',
        'password' => 'required|string|min:8|confirmed',
        'id_rol' => 'required|exists:roles,id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function empleado()
    {
        return $this->hasOne(Empleado::class, 'id_usuario');
    }
    
    /**
     * Obtiene el rol del usuario.
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }
    
    /**
     * Obtiene los pedidos realizados por el usuario.
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_usuario');
    }
    
    /**
     * Obtiene las notificaciones del usuario.
     */
    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, 'id_usuario');
    }
    
    /**
     * Obtiene las calificaciones realizadas por el usuario.
     */
    public function calificacionesRealizadas()
    {
        return $this->hasMany(Calificacion::class, 'id_usuario');
    }
    
    /**
     * Obtiene las calificaciones recibidas por el usuario (como empleado).
     */
    public function calificacionesRecibidas()
    {
        return $this->hasMany(Calificacion::class, 'id_empleado');
    }
    
    /**
     * Obtiene los repartos asignados al usuario (como repartidor).
     */
    public function repartos()
    {
        return $this->hasMany(Reparto::class, 'id_repartidor');
    }
    
    /**
     * Verifica si el usuario tiene un rol específico.
     */
    public function hasRole($rolNombre)
    {
        return $this->rol->nombre === $rolNombre;
    }

    /**
     * Obtiene las notificaciones no leídas del usuario.
     */
    public function notificacionesNoLeidas()
    {
        return $this->notificaciones()->where('leido', false);
    }
}
