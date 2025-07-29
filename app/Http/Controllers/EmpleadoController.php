<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
    public function index()
    {


        $empleados = Empleado::with('usuario')->get();
        return view('empleados.empleados.empleados.empleados.index', compact('empleados'));
    }

    public function crear()
    {
        $usuarios = User::all(); // Si necesitas mostrar usuarios disponibles en un <select>
        return view('empleados.empleados.crear', compact('usuarios'));
    }
    public function guardar(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'fecha_ingreso' => 'required|date',
            'estado' => 'required|string',
            'cargo' => 'nullable|string',
        ]);

        $usuario = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
            'id_rol' => 1,
        ]);

        Empleado::create([
            'fecha_ingreso' => $request->fecha_ingreso,
            'estado' => $request->estado,
            'cargo' => $request->cargo,
            'id_usuario' => $usuario->id,
        ]);

        return redirect()->route('empleados.empleados.empleados.empleados.index')->with('success', 'Empleado creado exitosamente.');
    }

    public function editar($id)
    {
        $empleado = Empleado::findOrFail($id);
        $usuarios = User::all();
        return view('empleados.empleados.editar', compact('empleado', 'usuarios'));
    }

    public function actualizar(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);

        $request->validate([
            'fecha_ingreso' => 'required|date',
            'estado' => 'required|string',
            'cargo' => 'nullable|string',
            // Validar los campos del usuario también
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        // Actualizar datos del empleado
        $empleado->update($request->only('fecha_ingreso', 'estado', 'cargo'));

        // Actualizar datos del usuario asociado
        $usuario = \App\Models\User::find($empleado->id_usuario);
        if ($usuario) {
            $usuario->name = $request->name;
            $usuario->apellido = $request->apellido;
            $usuario->email = $request->email;
            $usuario->telefono = $request->telefono;
            $usuario->save();
        }

        return redirect()->route('empleados.empleados.empleados.empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }


    public function eliminar($id)
    {
        $empleado = Empleado::findOrFail($id);
        $usuario = User::find($empleado->id_usuario);
        $empleado->delete();
        if ($usuario) {
            $usuario->delete();
        }
        return redirect()->route('empleados.empleados.empleados.empleados.index')->with('success', 'Empleado y usuario eliminados correctamente.');
    }

    /**
     * Muestra el dashboard del empleado.
     */
    public function dashboard()
    {
        // Aquí puedes agregar estadísticas específicas para empleados
        // Por ejemplo: repartos asignados, pedidos pendientes, etc.

        return view('empleado.dashboard');
    }

    public function listarClientes()
    {
        $clientes = \App\Models\User::where('id_rol', 3)->get();
        return view('empleado.clientes', compact('clientes'));
    }

    public function listarEmpleados()
    {
        $empleados = \App\Models\Empleado::with('usuario')->get();
        return view('empleado.repartidores', compact('empleados'));
    }
}
