@extends('Layouts.plantilla')
@section('title', 'Login')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, rgba(193, 39, 45, 0.1) 0%, rgba(42, 157, 143, 0.1) 100%),
                    url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat fixed;
        min-height: 100vh;
        font-family: var(--font-sans);
    }

    .glass-container {
        background: rgba(250, 245, 239, 0.25);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(250, 245, 239, 0.3);
        box-shadow: 
            0 25px 45px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(255, 255, 255, 0.05),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        transform: perspective(1000px) rotateX(5deg) rotateY(-2deg);
        animation: floatBounce 6s ease-in-out infinite;
    }

    @keyframes floatBounce {
        0%, 100% { 
            transform: perspective(1000px) rotateX(5deg) rotateY(-2deg) translateY(0px);
        }
        25% { 
            transform: perspective(1000px) rotateX(3deg) rotateY(-1deg) translateY(-8px);
        }
        50% { 
            transform: perspective(1000px) rotateX(7deg) rotateY(-3deg) translateY(-5px);
        }
        75% { 
            transform: perspective(1000px) rotateX(4deg) rotateY(-1.5deg) translateY(-12px);
        }
    }

    .glass-container:hover {
        transform: perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(-10px) scale(1.02);
        animation-play-state: paused;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .logo-container {
        position: relative;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        transform: scale(1.3);
        margin-bottom: 1rem;
    }

    .logo-container:hover {
        transform: scale(1.5) translateY(-8px) rotate(5deg);
        filter: drop-shadow(0 20px 40px rgba(193, 39, 45, 0.4));
    }

    .logo-glow {
        position: absolute;
        inset: -15px;
        background: radial-gradient(circle, rgba(244, 162, 97, 0.4) 0%, rgba(193, 39, 45, 0.2) 50%, transparent 70%);
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .logo-container:hover .logo-glow {
        opacity: 1;
        animation: pulse-glow 2s infinite;
    }

    @keyframes pulse-glow {
        0%, 100% { transform: scale(1); opacity: 0.4; }
        50% { transform: scale(1.2); opacity: 0.8; }
    }

    .input-group {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .input-field {
        width: 100%;
        padding: 1rem 1rem 1rem 3.5rem;
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid transparent;
        border-radius: 1rem;
        font-family: var(--font-sans);
        font-size: 1rem;
        color: var(--color-texto);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
    }

    .input-field:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.95);
        border-color: var(--color-enfasis);
        box-shadow: 
            0 0 0 4px rgba(42, 157, 143, 0.1),
            0 8px 25px rgba(42, 157, 143, 0.15);
        transform: translateY(-2px);
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--color-enfasis);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 10;
    }

    .input-field:focus + .input-icon {
        color: var(--color-primario);
        transform: translateY(-50%) scale(1.1) rotate(-5deg);
    }

    .login-button {
        width: 100%;
        padding: 1rem 2rem;
        background: linear-gradient(135deg, #ff6b35 0%, #f7931e 50%, #ffcc02 100%);
        color: white;
        font-family: var(--font-sans);
        font-weight: 700;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        border: none;
        border-radius: 1rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 
            0 8px 25px rgba(255, 107, 53, 0.4),
            0 0 0 2px rgba(255, 204, 2, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }

    .login-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s;
    }

    .login-button:hover::before {
        left: 100%;
    }

    .login-button:hover {
        background: linear-gradient(135deg, #e55a2b 0%, #d67c1a 50%, #e6b800 100%);
        transform: translateY(-4px) scale(1.03);
        box-shadow: 
            0 15px 40px rgba(255, 107, 53, 0.6),
            0 0 0 3px rgba(255, 204, 2, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.4),
            0 0 20px rgba(255, 204, 2, 0.3);
    }

    .login-button:active {
        transform: translateY(-2px) scale(0.98);
    }

    .main-title {
        font-family: var(--font-serif);
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--color-primario);
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        min-height: 3rem;
        font-style: italic;
    }

    .subtitle {
        font-family: var(--font-cursive);
        color: var(--color-enfasis);
        font-size: 1.1rem;
        margin-bottom: 2rem;
        min-height: 2rem;
        font-style: italic;
    }

    /* Efecto de escritura a máquina */
    .typewriter {
        overflow: hidden;
        border-right: 3px solid var(--color-primario);
        white-space: nowrap;
        animation: blink-cursor 1s infinite;
    }

    .typewriter.typing {
        border-right: 3px solid var(--color-primario);
        animation: blink-cursor 1s infinite;
    }

    .typewriter.finished {
        border-right: none;
        animation: none;
    }

    @keyframes blink-cursor {
        0%, 50% { border-color: var(--color-primario); }
        51%, 100% { border-color: transparent; }
    }

    .link-elegant {
        font-family: var(--font-sans);
        color: var(--color-enfasis);
        text-decoration: none;
        font-weight: 500;
        position: relative;
        transition: all 0.3s ease;
        font-style: italic;
    }

    .link-elegant::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 50%;
        background: linear-gradient(90deg, var(--color-enfasis), var(--color-primario));
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .link-elegant:hover {
        color: var(--color-primario);
        transform: translateY(-1px);
    }

    .link-elegant:hover::after {
        width: 100%;
    }

    .fade-in {
        animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .error-message {
        background: rgba(220, 53, 69, 0.1);
        border: 1px solid rgba(220, 53, 69, 0.3);
        color: #dc3545;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        font-family: var(--font-sans);
        font-size: 0.9rem;
    }

    .success-message {
        background: rgba(40, 167, 69, 0.1);
        border: 1px solid rgba(40, 167, 69, 0.3);
        color: #28a745;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        font-family: var(--font-sans);
        font-size: 0.9rem;
    }

    @media (max-width: 640px) {
        .glass-container {
            margin: 1rem;
            padding: 2rem 1.5rem;
            transform: perspective(800px) rotateX(3deg) rotateY(-1deg);
        }
        .main-title {
            font-size: 2rem;
        }
        .logo-container {
            transform: scale(1.2);
        }
    }
</style>

<div class="min-h-screen flex items-center justify-center p-4">
    <div class="glass-container max-w-md w-full p-8 rounded-3xl fade-in">
        <!-- Logo con efectos mejorado -->
        <div class="text-center mb-8">
            <div class="logo-container inline-block">
                <div class="logo-glow"></div>
                <x-logo size="xl" class="mx-auto" />
            </div>
        </div>

        <!-- Títulos con efecto typewriter -->
        <div class="text-center mb-8">
            <h1 id="main-title" class="main-title typewriter"></h1>
            <p id="subtitle" class="subtitle typewriter"></p>
        </div>

        <!-- Mensajes de estado -->
    @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
    @endif

    @if($errors->any())
            <div class="error-message">
            @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
            @endforeach
            </div>
    @endif

        <!-- Formulario -->
        <form method="POST" action="{{ route('login.submit') }}" class="space-y-6">
        @csrf
            
            <!-- Campo Email -->
            <div class="input-group">
                <input 
                    type="email" 
                    name="email" 
                    placeholder="Correo electrónico" 
                    required 
                    class="input-field"
                    value="{{ old('email') }}"
                    autofocus
                >
                <div class="input-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
            </div>

            <!-- Campo Contraseña -->
            <div class="input-group">
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Contraseña" 
                    required 
                    class="input-field"
                >
                <div class="input-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <rect width="18" height="11" x="3" y="11" rx="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </div>
            </div>

            <!-- Botón de ingreso -->
            <button type="submit" class="login-button">
                <span>Ingresar</span>
            </button>
    </form>

        <!-- Enlaces -->
        <div class="text-center mt-8">
            <div class="flex items-center justify-center space-x-2">
                <span class="text-sm" style="color: var(--color-texto); opacity: 0.7; font-style: italic;">¿No tienes cuenta?</span>
                <a href="{{ route('register') }}" class="link-elegant text-sm font-semibold">Regístrate aquí</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Función para efecto typewriter
    function typeWriter(element, text, speed = 100, callback = null) {
        let i = 0;
        element.innerHTML = '';
        element.classList.add('typing');
        
        function type() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;
                setTimeout(type, speed);
            } else {
                element.classList.remove('typing');
                element.classList.add('finished');
                if (callback) {
                    setTimeout(callback, 500);
                }
            }
        }
        type();
    }

    // Iniciar animaciones después de un pequeño delay
    setTimeout(() => {
        const mainTitle = document.getElementById('main-title');
        const subtitle = document.getElementById('subtitle');
        
        // Escribir "Bienvenido" primero
        typeWriter(mainTitle, 'Bienvenido', 120, () => {
            // Después escribir el subtítulo
            typeWriter(subtitle, 'Inicia sesión para disfrutar de tu comida favorita', 50);
        });
    }, 800);
});
</script>
@endsection

@push('styles')
<style>
    /* Ocultar header y footer del layout para el login */
    header, footer { display: none !important; }
</style>
@endpush
