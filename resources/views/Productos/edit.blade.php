@extends('layouts.plantilla')

@section('content')
    <h1>Editar Producto</h1>
    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ $producto->nombre }}" required><br>
        <label>Descripción:</label>
        <textarea name="descripcion" required>{{ $producto->descripcion }}</textarea><br>
        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" required><br>
        <label>Categoría:</label>
        <select name="id_categoria" required>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ $categoria->id == $producto->id_categoria ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
            @endforeach
        </select><br>
        <label>Imagen:</label>
        @if($producto->imagen)
            <img src="{{ asset('storage/' . $producto->imagen) }}" width="60"><br>
        @endif
        <input type="file" name="imagen"><br>
        <button type="submit">Actualizar</button>
    </form>
@endsection 