<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Services\StockNotificationService;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    protected $stockNotificationService;

    public function __construct(StockNotificationService $stockNotificationService)
    {
        $this->stockNotificationService = $stockNotificationService;
    }

    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'id_categoria' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $datos = $request->all();

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('imagenes', 'public');
        }

        $producto = Producto::create($datos);

        // Verificar stock después de crear el producto
        $this->stockNotificationService->verificarStockProducto($producto);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'id_categoria' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $datos = $request->all();

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('imagenes', 'public');
        }

        $producto->update($datos);

        // Verificar stock después de actualizar el producto
        $this->stockNotificationService->verificarStockProducto($producto);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado.');
    }
}
