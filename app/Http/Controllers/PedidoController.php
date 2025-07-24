<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use App\Models\Empleado;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with(['usuario', 'empleado'])->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $usuarios = User::where('id_rol', 2)->get(); // Clientes
        $empleados = Empleado::with('usuario')->get(); // Empleados con datos del usuario
        return view('pedidos.crear', compact('usuarios', 'empleados'));
    }
  
    

    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:users,id',
            'id_empleado' => 'required|exists:empleados,id',
            'total' => 'required|numeric|min:0',
            'fecha_entrega' => 'required|date',
            'direccion' => 'required|string|max:255',
            'estado' => 'required|string'
        ]);
    
        Pedido::create([
            'id_usuario' => $request->id_usuario,
            'id_empleado' => $request->id_empleado,
            'total' => $request->total,
            'fecha_entrega' => $request->fecha_entrega,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
        ]);
    
        return redirect()->route('pedidos.index')->with('success', 'Pedido creado exitosamente.');
    }
    

    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        $usuarios = User::all();
        $empleados = Empleado::all();
        return view('pedidos.editar', compact('pedido', 'usuarios', 'empleados'));
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);

        $request->validate([
            'id_usuario' => 'required|exists:users,id',
            'id_empleado' => 'required|exists:empleados,id',
            'total' => 'required|numeric|min:0',
            'fecha_entrega' => 'required|date',
            'direccion' => 'required|string|max:255',
            'estado' => 'required|string'
        ]);

        $pedido->update($request->all());

        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado exitosamente.');
    }

    public function destroy($id)
    {
        Pedido::findOrFail($id)->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado exitosamente.');
    }
}
