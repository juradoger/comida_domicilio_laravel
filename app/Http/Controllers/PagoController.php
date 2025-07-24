<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    /**
     * Muestra una lista de todos los pagos.
     */
    public function index()
    {
        // Si es administrador, muestra todos los pagos
        if (Auth::user()->id_rol == 1) {
            $pagos = Pago::with('pedido')->get();
            return view('admin.pagos.index', compact('pagos'));
        }
        
        // Si es cliente, muestra solo sus pagos
        $pagos = Pago::whereHas('pedido', function($query) {
            $query->where('id_usuario', Auth::id());
        })->with('pedido')->get();
        
        return view('cliente.pagos.index', compact('pagos'));
    }

    /**
     * Muestra el formulario para crear un nuevo pago.
     */
    public function create(Request $request)
    {
        $pedido_id = $request->query('pedido_id');
        
        if ($pedido_id) {
            $pedido = Pedido::findOrFail($pedido_id);
            
            // Verificar si el pedido pertenece al usuario actual o es admin
            if (Auth::id() != $pedido->id_usuario && Auth::user()->id_rol != 1) {
                return redirect()->route('cliente.pedidos.index')
                    ->with('error', 'No tienes permiso para realizar el pago de este pedido.');
            }
            
            // Verificar si el pedido ya tiene un pago
            $pagoExistente = Pago::where('id_pedido', $pedido_id)->where('estado_pago', 'pagado')->first();
            if ($pagoExistente) {
                return redirect()->route('cliente.pedidos.index')
                    ->with('error', 'Este pedido ya ha sido pagado.');
            }
        } else {
            // Si no se proporciona un pedido_id, mostrar lista de pedidos pendientes
            if (Auth::user()->id_rol == 1) {
                $pedidos = Pedido::whereDoesntHave('pagos', function($query) {
                    $query->where('estado_pago', 'pagado');
                })->get();
            } else {
                $pedidos = Pedido::where('id_usuario', Auth::id())
                    ->whereDoesntHave('pagos', function($query) {
                        $query->where('estado_pago', 'pagado');
                    })->get();
            }
            
            return view('pagos.seleccionar_pedido', compact('pedidos'));
        }
        
        return view('cliente.pagos.create', compact('pedido'));
    }

    /**
     * Almacena un nuevo pago en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pedido' => 'required|exists:pedidos,id',
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia,qr',
            'monto' => 'required|numeric|min:0',
        ]);

        $pedido = Pedido::findOrFail($request->id_pedido);
        
        // Verificar si el pedido pertenece al usuario actual o es admin
        if (Auth::id() != $pedido->id_usuario && Auth::user()->id_rol != 1) {
            return redirect()->route('cliente.pedidos.index')
                ->with('error', 'No tienes permiso para realizar el pago de este pedido.');
        }
        
        // Verificar si el monto coincide con el total del pedido
        if ($request->monto != $pedido->total) {
            return redirect()->back()
                ->with('error', 'El monto del pago debe ser igual al total del pedido.')
                ->withInput();
        }

        // Crear el pago
        $pago = Pago::create([
            'id_pedido' => $request->id_pedido,
            'metodo_pago' => $request->metodo_pago,
            'monto' => $request->monto,
            'estado_pago' => 'pagado', // Asumimos que el pago es exitoso inmediatamente
        ]);

        return redirect()->route('cliente.pedidos.show', $pedido->id)
            ->with('success', 'Pago realizado exitosamente.');
    }

    /**
     * Muestra un pago específico.
     */
    public function show(Pago $pago)
    {
        // Verificar si el pago pertenece al usuario actual o es admin
        $pedido = $pago->pedido;
        if (Auth::id() != $pedido->id_usuario && Auth::user()->id_rol != 1) {
            return redirect()->route('cliente.pedidos.index')
                ->with('error', 'No tienes permiso para ver este pago.');
        }
        
        return view('pagos.show', compact('pago'));
    }

    /**
     * Muestra el formulario para editar un pago específico (solo admin).
     */
    public function edit(Pago $pago)
    {
        // Solo los administradores pueden editar pagos
        if (Auth::user()->id_rol != 1) {
            return redirect()->route('cliente.pedidos.index')
                ->with('error', 'No tienes permiso para editar pagos.');
        }
        
        return view('admin.pagos.edit', compact('pago'));
    }

    /**
     * Actualiza un pago específico en la base de datos (solo admin).
     */
    public function update(Request $request, Pago $pago)
    {
        // Solo los administradores pueden actualizar pagos
        if (Auth::user()->id_rol != 1) {
            return redirect()->route('cliente.pedidos.index')
                ->with('error', 'No tienes permiso para actualizar pagos.');
        }
        
        $request->validate([
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia,qr',
            'monto' => 'required|numeric|min:0',
            'estado_pago' => 'required|in:pendiente,pagado,fallido',
        ]);

        $pago->update($request->all());

        return redirect()->route('admin.pagos.index')
            ->with('success', 'Pago actualizado exitosamente.');
    }

    /**
     * Elimina un pago específico de la base de datos (solo admin).
     */
    public function destroy(Pago $pago)
    {
        // Solo los administradores pueden eliminar pagos
        if (Auth::user()->id_rol != 1) {
            return redirect()->route('cliente.pedidos.index')
                ->with('error', 'No tienes permiso para eliminar pagos.');
        }
        
        $pago->delete();

        return redirect()->route('admin.pagos.index')
            ->with('success', 'Pago eliminado exitosamente.');
    }
}