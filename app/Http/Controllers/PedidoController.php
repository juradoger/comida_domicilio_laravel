<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use App\Models\Empleado;
use App\Models\Notificacion;
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
        $usuarios = User::where('id_rol', 3)->get(); // Clientes
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
        $pedido = Pedido::with(['usuario', 'empleado.usuario'])->findOrFail($id);
        $estadoAnterior = $pedido->estado;
        $empleadoAnterior = $pedido->id_empleado;

        $request->validate([
            'id_usuario' => 'required|exists:users,id',
            'id_empleado' => 'required|exists:empleados,id',
            'total' => 'required|numeric|min:0',
            'fecha_entrega' => 'required|date',
            'direccion' => 'required|string|max:255',
            'estado' => 'required|string'
        ]);

        $pedido->update($request->all());

        // Crear notificación si se asigna un empleado por primera vez o se cambia
        if ($empleadoAnterior != $request->id_empleado) {
            $empleado = Empleado::with('usuario')->find($request->id_empleado);

            if ($empleado && $empleado->usuario) {
                // Notificación para el empleado
                Notificacion::create([
                    'id_usuario' => $empleado->usuario->id,
                    'mensaje' => '🚴‍♂️ ¡Te hemos asignado un nuevo pedido! Pedido #' . $pedido->id . ' por un total de $' . number_format($pedido->total, 2) . '. Revisa los detalles y prepárate para la entrega.',
                    'leido' => false,
                    'fecha_envio' => now(),
                ]);
            }
        }

        // Crear notificación si cambia el estado a "en_camino"
        if ($estadoAnterior != 'en_camino' && $request->estado == 'en_camino') {
            $empleado = Empleado::with('usuario')->find($request->id_empleado);
            $nombreRepartidor = $empleado && $empleado->usuario ? $empleado->usuario->name : 'nuestro repartidor';

            // Notificación para el cliente
            Notificacion::create([
                'id_usuario' => $pedido->id_usuario,
                'mensaje' => '🛵 ¡Tu pedido está en camino! ' . $nombreRepartidor . ' está llevando tu pedido #' . $pedido->id . '. Estará contigo muy pronto. ¡Prepara tu apetito!',
                'leido' => false,
                'fecha_envio' => now(),
            ]);
        }

        // Crear notificación si cambia el estado a "entregado"
        if ($estadoAnterior != 'entregado' && $request->estado == 'entregado') {
            // Notificación para el cliente
            Notificacion::create([
                'id_usuario' => $pedido->id_usuario,
                'mensaje' => '✅ ¡Tu pedido #' . $pedido->id . ' ha sido entregado exitosamente! Esperamos que disfrutes tu comida. ¡Gracias por confiar en nosotros!',
                'leido' => false,
                'fecha_envio' => now(),
            ]);
        }

        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado exitosamente.');
    }

    public function destroy($id)
    {
        Pedido::findOrFail($id)->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado exitosamente.');
    }
}
