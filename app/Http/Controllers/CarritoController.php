<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    /**
     * Muestra el contenido del carrito de compras.
     */
    public function index()
    {
        $carrito = Session::get('carrito', []);

        // Convert session cart to items collection for compatibility with the view
        $items = collect();
        $subtotal = 0;

        foreach ($carrito as $item) {
            $producto = Producto::find($item['id']);
            if ($producto) {
                $cartItem = (object) [
                    'id' => $item['id'],
                    'cantidad' => $item['cantidad'],
                    'producto' => $producto,
                ];
                $items->push($cartItem);
                $subtotal += $producto->precio * $item['cantidad'];
            }
        }

        $costoEnvio = 10.00; // Fixed shipping cost
        $descuento = 0; // No discount system yet
        $total = $subtotal + $costoEnvio - $descuento;

        // Get user addresses (we'll need to create this functionality)
        $direcciones = collect(); // Empty for now, will implement later

        return view('cliente.carrito.index', compact('items', 'subtotal', 'costoEnvio', 'descuento', 'total', 'direcciones'));
    }

    /**
     * Agrega un producto al carrito.
     */
    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);
        $carrito = Session::get('carrito', []);

        // Si el producto ya está en el carrito, actualizar la cantidad
        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad'] += $request->cantidad;
        } else {
            // Agregar nuevo producto al carrito
            $carrito[$producto->id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'imagen' => $producto->imagen,
                'cantidad' => $request->cantidad,
            ];
        }

        Session::put('carrito', $carrito);

        return response()->json([
            'success' => true,
            'message' => 'Producto agregado al carrito',
            'carrito_count' => count($carrito)
        ]);
    }

    /**
     * Actualiza la cantidad de un producto en el carrito.
     */
    public function actualizar(Request $request, $id)
    {
        $carrito = Session::get('carrito', []);

        if (isset($carrito[$id])) {
            if ($request->has('action')) {
                // Handle increase/decrease actions from the view
                if ($request->action == 'increase') {
                    $carrito[$id]['cantidad'] += 1;
                } elseif ($request->action == 'decrease' && $carrito[$id]['cantidad'] > 1) {
                    $carrito[$id]['cantidad'] -= 1;
                }
            } elseif ($request->has('cantidad')) {
                // Handle direct quantity update
                $carrito[$id]['cantidad'] = max(1, (int)$request->cantidad);
            }

            Session::put('carrito', $carrito);

            return redirect()->route('cliente.carrito')
                ->with('success', 'Cantidad actualizada correctamente');
        }

        return redirect()->route('cliente.carrito')
            ->with('error', 'Producto no encontrado en el carrito');
    }

    /**
     * Elimina un producto del carrito.
     */
    public function eliminar($id)
    {
        $carrito = Session::get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            Session::put('carrito', $carrito);

            return redirect()->route('cliente.carrito')
                ->with('success', 'Producto eliminado del carrito');
        }

        return redirect()->route('cliente.carrito')
            ->with('error', 'Producto no encontrado en el carrito');
    }

    /**
     * Vacía completamente el carrito.
     */
    public function vaciar()
    {
        Session::forget('carrito');

        return redirect()->route('cliente.carrito')
            ->with('success', 'Carrito vaciado correctamente');
    }

    /**
     * Obtiene el conteo de productos en el carrito (para AJAX).
     */
    public function conteo()
    {
        $carrito = Session::get('carrito', []);
        return response()->json(['count' => count($carrito)]);
    }

    /**
     * Aplica un cupón de descuento (placeholder).
     */
    public function aplicarCupon(Request $request)
    {
        $codigo = $request->input('codigo');

        // Placeholder for coupon system
        return redirect()->route('cliente.carrito')
            ->with('cupon_error', 'Sistema de cupones no implementado aún');
    }

    /**
     * Procesa el checkout del carrito.
     */
    public function checkout(Request $request)
    {
        $carrito = Session::get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('cliente.menu')
                ->with('error', 'Tu carrito está vacío');
        }

        // Store form data in session for the order creation
        session([
            'pedido_data' => [
                'metodo_pago' => $request->metodo_pago,
                'instrucciones' => $request->instrucciones,
            ]
        ]);

        // Redirect to the order creation page
        return redirect()->route('cliente.pedidos.create');
    }
}
