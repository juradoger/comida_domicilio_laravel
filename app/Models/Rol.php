<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    
    protected $table = 'roles';
    
    protected $fillable = [
        'nombre',
        'fecha_creacion'
    ];
    
    /**
     * Las reglas de validación para el modelo.
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:50|unique:roles',
        'fecha_creacion' => 'nullable|date'
    ];
    
    /**
     * Obtiene los usuarios que tienen este rol.
     */
    public function usuarios()
    {
        return $this->hasMany(User::class, 'id_rol');
    }
}
