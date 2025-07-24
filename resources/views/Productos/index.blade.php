@extends('layouts.plantilla')

@section('content')
    <h1>Lista de Productos</h1>
    <a href="{{ route('productos.create') }}">Crear Producto</a>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->precio }}</td>
                    <td>{{ $producto->categoria->nombre ?? '' }}</td>
                    <td>
                        @if($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}" width="60">
                        @else
                            Sin imagen
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('productos.edit', $producto->id) }}">Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
