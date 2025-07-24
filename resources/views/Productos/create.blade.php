@extends('layouts.plantilla')

@section('content')
    <h1>Crear Producto</h1>
    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br>
        <label>Descripción:</label>
        <textarea name="descripcion" required></textarea><br>
        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" required><br>
        <label>Categoría:</label>
        <select name="id_categoria" required>
            <option value="">Seleccione una categoría</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select><br>
        <label>Imagen:</label>
        <input type="file" name="imagen"><br>
        <button type="submit">Guardar</button>
    </form>
@endsection 