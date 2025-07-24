<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Pedido;
use Illuminate\Http\Request;

class DireccionController extends Controller
{
    /**
     * Muestra una lista de todas las direcciones.
     */
    public function index()
    {
        $direcciones = Direccion::with('pedido')->get();
        return view('direcciones.index', compact('direcciones'));
    }

    /**
     * Muestra el formulario para crear una nueva dirección.
     */
    public function create()
    {
        $pedidos = Pedido::all();
        return view('direcciones.create', compact('pedidos'));
    }

    /**
     * Almacena una nueva dirección en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pedido' => 'required|exists:pedidos,id',
            'direccion' => 'required|string',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
        ]);

        Direccion::create($request->all());

        return redirect()->route('direcciones.index')
            ->with('success', 'Dirección creada exitosamente.');
    }

    /**
     * Muestra una dirección específica.
     */
    public function show(Direccion $direccion)
    {
        return view('direcciones.show', compact('direccion'));
    }

    /**
     * Muestra el formulario para editar una dirección específica.
     */
    public function edit(Direccion $direccion)
    {
        $pedidos = Pedido::all();
        return view('direcciones.edit', compact('direccion', 'pedidos'));
    }

    /**
     * Actualiza una dirección específica en la base de datos.
     */
    public function update(Request $request, Direccion $direccion)
    {
        $request->validate([
            'id_pedido' => 'required|exists:pedidos,id',
            'direccion' => 'required|string',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
        ]);

        $direccion->update($request->all());

        return redirect()->route('direcciones.index')
            ->with('success', 'Dirección actualizada exitosamente.');
    }

    /**
     * Elimina una dirección específica de la base de datos.
     */
    public function destroy(Direccion $direccion)
    {
        $direccion->delete();

        return redirect()->route('direcciones.index')
            ->with('success', 'Dirección eliminada exitosamente.');
    }
}