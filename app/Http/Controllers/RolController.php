<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Muestra una lista de todos los roles.
     */
    public function index()
    {
        $roles = Rol::withCount('usuarios')->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Muestra el formulario para crear un nuevo rol.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Almacena un nuevo rol en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:roles,nombre',
        ]);

        Rol::create([
            'nombre' => $request->nombre,
            'fecha_creacion' => now(),
        ]);

        return redirect()->route('roles.index')
            ->with('success', 'Rol creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un rol específico.
     */
    public function edit(Rol $rol)
    {
        return view('admin.roles.edit', compact('rol'));
    }

    /**
     * Actualiza un rol específico en la base de datos.
     */
    public function update(Request $request, Rol $rol)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:roles,nombre,' . $rol->id,
        ]);

        $rol->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('roles.index')
            ->with('success', 'Rol actualizado exitosamente.');
    }

    /**
     * Elimina un rol específico de la base de datos.
     */
    public function destroy(Rol $rol)
    {
        // Verificar si hay usuarios asociados a este rol
        if ($rol->usuarios()->count() > 0) {
            return redirect()->route('roles.index')
                ->with('error', 'No se puede eliminar el rol porque tiene usuarios asociados.');
        }

        $rol->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Rol eliminado exitosamente.');
    }
}