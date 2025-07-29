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
            <!-- Logo -->
            <div class="mb-6">
                <x-logo size="xl" class="filter brightness-0 invert" />
            </div>

            <!-- Título dinámico con typewriter -->
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 text-white drop-shadow-lg">
                <span id="typewriter-title">
                    @auth
                        ¡Bienvenido, {{ Auth::user()->name }}!
                    @else
                        FASTBITE
                    @endauth
                </span>
            </h1>

            <!-- Subtítulo con typewriter -->
            <p class="text-2xl md:text-3xl text-white/90 font-medium mb-4">
                <span id="typewriter-subtitle">Disfruta de los mejores platos desde la comodidad de tu hogar</span>
            </p>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        console.log('Script de typewriter cargado');
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM cargado, iniciando typewriter');
            // Esperar un poco más para asegurar que todo esté renderizado
            setTimeout(function() {
                console.log('Aplicando efecto typewriter...');

                // Efecto typewriter para el título
                function typeWriter(element, text, speed = 100) {
                    console.log('Iniciando typewriter para:', text);
                    let i = 0;
                    element.innerHTML = '';

                    function type() {
                        if (i < text.length) {
                            element.innerHTML += text.charAt(i);
                            i++;
                            setTimeout(type, speed);
                        } else {
                            console.log('Typewriter completado para:', text);
                        }
                    }
                    type();
                }

                // Efecto typewriter para el subtítulo
                function typeWriterSubtitle(element, text, speed = 50) {
                    console.log('Iniciando typewriter para subtítulo:', text);
                    let i = 0;
                    element.innerHTML = '';

                    function type() {
                        if (i < text.length) {
                            element.innerHTML += text.charAt(i);
                            i++;
                            setTimeout(type, speed);
                        } else {
                            console.log('Typewriter completado para subtítulo:', text);
                        }
                    }
                    type();
                }

                // Aplicar efecto typewriter
                const titleElement = document.getElementById('typewriter-title');
                const subtitleElement = document.getElementById('typewriter-subtitle');

                console.log('Elementos encontrados:', {
                    title: titleElement,
                    subtitle: subtitleElement
                });

                if (titleElement) {
                    const titleText = titleElement.textContent.trim();
                    console.log('Aplicando typewriter al título:', titleText);
                    typeWriter(titleElement, titleText, 100);
                } else {
                    console.error('No se encontró el elemento typewriter-title');
                }

                if (subtitleElement) {
                    const subtitleText = subtitleElement.textContent.trim();
                    console.log('Aplicando typewriter al subtítulo:', subtitleText);
                    // Esperar un poco antes de empezar el subtítulo
                    setTimeout(() => {
                        typeWriterSubtitle(subtitleElement, subtitleText, 50);
                    }, 1500);
                } else {
                    console.error('No se encontró el elemento typewriter-subtitle');
                }
            }, 200); // Aumentado el delay para asegurar renderizado completo
        });
    </script>
@endpush
