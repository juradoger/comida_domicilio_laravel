@extends('Layouts.cliente')

@section('title', 'Menú de Productos')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Menú de Productos</h1>
        <div class="flex items-center gap-4">
            <div class="relative">
                <form action="{{ route('cliente.menu') }}" method="GET" class="flex">
                    <input type="text" name="buscar" placeholder="Buscar productos..." class="px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent" value="{{ request('buscar') }}">
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-r-md hover:bg-orange-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
            <a href="{{ route('cliente.carrito') }}" class="relative flex items-center bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Carrito
                @if(session('carrito') && count(session('carrito')) > 0)
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ count(session('carrito')) }}</span>
                @endif
            </a>
        </div>
    </div>

    <!-- Filtro por categorías -->
    @if(isset($categorias) && count($categorias) > 0)
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-700 mb-3">Categorías</h2>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('cliente.menu') }}" class="px-4 py-2 rounded-full {{ !request('categoria') ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition">
                Todas
            </a>
            @foreach($categorias as $categoria)
                <a href="{{ route('cliente.menu', ['categoria' => $categoria->id]) }}" class="px-4 py-2 rounded-full {{ request('categoria') == $categoria->id ? 'bg-orange-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition">
                    {{ $categoria->nombre }}
                </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Listado de productos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($productos as $producto)
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition">
                <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : 'https://via.placeholder.com/300x200?text=Sin+Imagen' }}" alt="{{ $producto->nombre }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-bold text-gray-800">{{ $producto->nombre }}</h3>
                    @if(isset($producto->categoria))
                    <p class="text-gray-600 text-sm mb-2">{{ $producto->categoria->nombre }}</p>
                    @endif
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $producto->descripcion }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-orange-600 font-bold">${{ number_format($producto->precio, 2) }}</span>
                        <form method="POST" action="{{ route('cliente.pedir', $producto->id) }}">
                            @csrf
                            <div class="flex items-center gap-2">
                                <input type="number" name="cantidad" value="1" min="1" class="border rounded px-2 py-1 w-16">
                                <button type="submit" class="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600 transition flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Pedir
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-700 mt-4">No se encontraron productos</h3>
                <p class="text-gray-500 mt-2">Intenta con otra búsqueda o categoría</p>
            </div>
        @endforelse
    </div>

    <!-- Paginación -->
    @if(method_exists($productos, 'links'))
    <div class="mt-8">
        {{ $productos->links() }}
    </div>
    @endif
</div>
@endsection