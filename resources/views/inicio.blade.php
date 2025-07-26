@extends('Layouts.guest')

@section('title', 'Dashboard - Cliente')
@section('header')
    <div class="relative min-h-[80vh] md:min-h-[90vh] w-full flex items-center justify-center overflow-hidden mb-10"
        style="
background: linear-gradient(135deg, rgba(234,88,12,0.7) 0%, rgba(251,146,60,0.5) 100%),
            url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;
margin: 0; padding: 0; border-radius: 0; box-shadow: none;
">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10 flex flex-col items-center text-center w-full px-4 md:px-0">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 text-white drop-shadow-lg">¡Bienvenido,

                <p class="text-2xl md:text-3xl text-white/90 font-medium mb-4">Disfruta de los mejores platos desde la
                    comodidad
                    de tu hogar</p>
        </div>
    </div>
@endsection
