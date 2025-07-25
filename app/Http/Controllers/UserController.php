<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Muestra una lista de todos los usuarios.
     */
    public function index()
    {
        $usuarios = User::with('rol')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        $roles = Rol::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telefono' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'id_rol' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
            'id_rol' => $request->id_rol,
            'estado' => 'activo',
        ]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un usuario específico.
     */
    public function edit(User $usuario)
    {
        $roles = Rol::all();
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Actualiza un usuario específico en la base de datos.
     */
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'telefono' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'id_rol' => 'required|exists:roles,id',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $usuario->name = $request->name;
        $usuario->apellido = $request->apellido;
        $usuario->email = $request->email;
        $usuario->telefono = $request->telefono;
        $usuario->id_rol = $request->id_rol;
        $usuario->estado = $request->estado;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Elimina un usuario específico de la base de datos.
     */
    public function destroy(User $usuario)
    {
        // Verificar si el usuario tiene pedidos asociados
        if ($usuario->pedidos()->count() > 0) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No se puede eliminar el usuario porque tiene pedidos asociados.');
        }

        // Verificar si el usuario es un empleado
        if ($usuario->empleado) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No se puede eliminar el usuario porque está asociado a un empleado.');
        }

        // Cambiar el estado a inactivo en lugar de eliminar
        $usuario->estado = 'inactivo';
        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario desactivado exitosamente.');
    }
}