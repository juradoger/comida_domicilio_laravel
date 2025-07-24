<?php

namespace App\Http\Controllers;

use App\Models\Reparto;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Http\Request;

class RepartoController extends Controller
{
    /**
     * Muestra una lista de todos los repartos.
     */
    public function index()
    {
        $repartos = Reparto::with(['pedido', 'repartidor'])->get();
        return view('empleado.repartos.index', compact('repartos'));
    }

    /**
     * Muestra el formulario para crear un nuevo reparto.
     */
    public function create()
    {
        $pedidos = Pedido::where('estado', 'pendiente')->get();
        $repartidores = User::where('id_rol', 1)->get(); // Asumiendo que id_rol 1 es para empleados/repartidores
        return view('empleado.repartos.create', compact('pedidos', 'repartidores'));
    }

    /**
     * Almacena un nuevo reparto en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pedido' => 'required|exists:pedidos,id',
            'id_repartidor' => 'required|exists:users,id',
            'hora_salida' => 'nullable|date',
        ]);

        $reparto = Reparto::create($request->all());

        // Actualizar el estado del pedido a 'en_camino'
        $pedido = Pedido::find($request->id_pedido);
        $pedido->estado = 'en_camino';
        $pedido->save();

        return redirect()->route('repartos.index')
            ->with('success', 'Reparto asignado exitosamente.');
    }

    /**
     * Muestra un reparto específico.
     */
    public function show(Reparto $reparto)
    {
        return view('empleado.repartos.show', compact('reparto'));
    }

    /**
     * Muestra el formulario para editar un reparto específico.
     */
    public function edit(Reparto $reparto)
    {
        $pedidos = Pedido::all();
        $repartidores = User::where('id_rol', 1)->get();
        return view('empleado.repartos.edit', compact('reparto', 'pedidos', 'repartidores'));
    }

    /**
     * Actualiza un reparto específico en la base de datos.
     */
    public function update(Request $request, Reparto $reparto)
    {
        $request->validate([
            'id_pedido' => 'required|exists:pedidos,id',
            'id_repartidor' => 'required|exists:users,id',
            'hora_salida' => 'nullable|date',
            'hora_entrega' => 'nullable|date',
        ]);

        $reparto->update($request->all());

        // Si se ha establecido hora_entrega, actualizar el estado del pedido a 'entregado'
        if ($request->filled('hora_entrega')) {
            $pedido = Pedido::find($reparto->id_pedido);
            $pedido->estado = 'entregado';
            $pedido->save();
        }

        return redirect()->route('repartos.index')
            ->with('success', 'Reparto actualizado exitosamente.');
    }

    /**
     * Marca un reparto como entregado.
     */
    public function marcarEntregado(Reparto $reparto)
    {
        $reparto->hora_entrega = now();
        $reparto->save();

        // Actualizar el estado del pedido
        $pedido = Pedido::find($reparto->id_pedido);
        $pedido->estado = 'entregado';
        $pedido->save();

        return redirect()->route('repartos.index')
            ->with('success', 'Pedido marcado como entregado exitosamente.');
    }

    /**
     * Elimina un reparto específico de la base de datos.
     */
    public function destroy(Reparto $reparto)
    {
        $reparto->delete();

        return redirect()->route('repartos.index')
            ->with('success', 'Reparto eliminado exitosamente.');
    }
}