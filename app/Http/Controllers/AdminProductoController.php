<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductoController extends Controller
{
    /**
     * Muestra la lista de productos para administración.
     */
    public function index()
    {
        $productos = Producto::with('categoria')->paginate(10);
        return view('dashboard.productos.index', compact('productos'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('dashboard.productos.create', compact('categorias'));
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'id_categoria' => 'required|exists:categorias,id',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Procesar la imagen
        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::slug($request->nombre) . '-' . time() . '.' . $imagen->getClientOriginalExtension();
            $imagenPath = $imagen->storeAs('productos', $nombreImagen, 'public');
        }

        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'id_categoria' => $request->id_categoria,
            'estado' => 'disponible',
            'imagen' => $imagenPath,
        ]);

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto creado exitosamente');
    }

    /**
     * Muestra el formulario para editar un producto existente.
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('dashboard.productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Actualiza un producto existente en la base de datos.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'id_categoria' => 'required|exists:categorias,id',
            'estado' => 'required|in:disponible,agotado',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Procesar la imagen si se proporciona una nueva
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            
            $imagen = $request->file('imagen');
            $nombreImagen = Str::slug($request->nombre) . '-' . time() . '.' . $imagen->getClientOriginalExtension();
            $imagenPath = $imagen->storeAs('productos', $nombreImagen, 'public');
            
            $producto->imagen = $imagenPath;
        }

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->id_categoria = $request->id_categoria;
        $producto->estado = $request->estado;
        $producto->save();

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Elimina un producto de la base de datos.
     */
    public function destroy(Producto $producto)
    {
        // Eliminar la imagen asociada si existe
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }
        
        $producto->delete();

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto eliminado exitosamente');
    }
}