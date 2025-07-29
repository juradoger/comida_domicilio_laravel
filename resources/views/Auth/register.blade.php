@extends('Layouts.plantilla')
@section('title', 'Registro')

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

    .register-button {
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

    .register-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s;
    }

    .register-button:hover::before {
        left: 100%;
    }

    .register-button:hover {
        background: linear-gradient(135deg, #e55a2b 0%, #d67c1a 50%, #e6b800 100%);
        transform: translateY(-4px) scale(1.03);
        box-shadow: 
            0 15px 40px rgba(255, 107, 53, 0.6),
        0 0 0 3px rgba(255, 204, 2, 0.5),
        inset 0 1px 0 rgba(255, 255, 255, 0.4),
        0 0 20px rgba(255, 204, 2, 0.3);
    }

    .register-button:active {
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

        <!-- Mensajes de error -->
        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- Formulario -->
        <form method="POST" action="{{ route('register.submit') }}" class="space-y-5">
            @csrf
            
            <!-- Tipo de Registro -->
            <div class="input-group">
                <select name="tipo_registro" id="tipo_registro" required class="input-field" onchange="toggleEmployeeFields()">
                    <option value="">Selecciona el tipo de cuenta</option>
                    <option value="cliente" {{ old('tipo_registro') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                    <option value="empleado" {{ old('tipo_registro') == 'empleado' ? 'selected' : '' }}>Empleado/Repartidor</option>
                </select>
                <div class="input-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </div>
            </div>
            
            <!-- Campo Nombre -->
            <div class="input-group">
                <input 
                    type="text" 
                    name="name" 
                    placeholder="Nombre" 
                    required 
                    class="input-field"
                    value="{{ old('name') }}"
                    autofocus
                >
                <div class="input-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </div>
            </div>

            <!-- Campo Apellido -->
            <div class="input-group">
                <input 
                    type="text" 
                    name="apellido" 
                    placeholder="Apellido" 
                    required 
                    class="input-field"
                    value="{{ old('apellido') }}"
                >
                <div class="input-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
            </div>

            <!-- Campo Email -->
            <div class="input-group">
                <input 
                    type="email" 
                    name="email" 
                    placeholder="Correo electrónico" 
                    required 
                    class="input-field"
                    value="{{ old('email') }}"
                >
                <div class="input-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
            </div>

            <!-- Campo Teléfono -->
            <div class="input-group">
                <input 
                    type="text" 
                    name="telefono" 
                    placeholder="Teléfono" 
                    required 
                    class="input-field"
                    value="{{ old('telefono') }}"
                >
                <div class="input-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                </div>
            </div>

            <!-- Campos específicos para empleados -->
            <div id="employee-fields" style="display: none;">
                <!-- Campo CI -->
                <div class="input-group">
                    <input 
                        type="text" 
                        name="ci" 
                        placeholder="CI (7-8 dígitos)" 
                        class="input-field"
                        value="{{ old('ci') }}"
                        maxlength="8"
                        pattern="[0-9]{7,8}"
                    >
                    <div class="input-icon">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <rect width="18" height="11" x="3" y="11" rx="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </div>
                </div>

                <!-- Campo Licencia de Conducir -->
                <div class="input-group">
                    <input 
                        type="text" 
                        name="licencia_conducir" 
                        placeholder="Licencia de conducir" 
                        class="input-field"
                        value="{{ old('licencia_conducir') }}"
                    >
                    <div class="input-icon">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                        </svg>
                    </div>
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

            <!-- Campo Confirmar Contraseña -->
            <div class="input-group">
                <input 
                    type="password" 
                    name="password_confirmation" 
                    placeholder="Confirmar contraseña" 
                    required 
                    class="input-field"
                >
                <div class="input-icon">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <rect width="18" height="11" x="3" y="11" rx="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        <circle cx="12" cy="16" r="1"/>
                    </svg>
                </div>
            </div>

            <!-- Botón de registro -->
            <button type="submit" class="register-button">
                <span>Crear Cuenta</span>
            </button>
        </form>

        <!-- Enlaces -->
        <div class="text-center mt-8">
            <div class="flex items-center justify-center space-x-2">
                <span class="text-sm" style="color: var(--color-texto); opacity: 0.7; font-style: italic;">¿Ya tienes cuenta?</span>
                <a href="{{ route('login') }}" class="link-elegant text-sm font-semibold">Inicia sesión aquí</a>
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
        
        // Escribir "Únete a nosotros" primero
        typeWriter(mainTitle, 'Únete a nosotros', 120, () => {
            // Después escribir el subtítulo
            typeWriter(subtitle, 'Crea tu cuenta y disfruta de la mejor comida', 50);
        });
    }, 800);

    // Función para mostrar/ocultar campos específicos para empleados
    function toggleEmployeeFields() {
        const tipoRegistro = document.getElementById('tipo_registro').value;
        const employeeFields = document.getElementById('employee-fields');
        const ciInput = document.querySelector('input[name="ci"]');
        const licenciaInput = document.querySelector('input[name="licencia_conducir"]');

        if (tipoRegistro === 'empleado') {
            employeeFields.style.display = 'block';
            ciInput.required = true;
            licenciaInput.required = true;
        } else {
            employeeFields.style.display = 'none';
            ciInput.required = false;
            licenciaInput.required = false;
        }
    }

    // Llamar a la función para establecer el estado inicial
    toggleEmployeeFields();

    // Agregar event listener para el cambio de tipo de registro
    document.getElementById('tipo_registro').addEventListener('change', toggleEmployeeFields);
});
</script>
@endsection

@push('styles')
<style>
    /* Ocultar header y footer del layout para el registro */
    header, footer { display: none !important; }
</style>
@endpush
