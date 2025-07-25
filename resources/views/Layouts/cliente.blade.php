<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta hip-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel Cliente - FastBite')</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --color-primario: #ea580c;
            --color-secundario: #fb923c;
            --color-acento: #f97316;
            --color-acento-claro: #fed7aa;
            --color-enfasis: #2a9d8f;
            --color-fondo: #fefefe;
            --color-texto: #1f2937;
            --font-primary: 'Nunito Sans', sans-serif;
        }

        * {
            font-family: var(--font-primary);
        }

        body {
            background: linear-gradient(135deg, #fefefe 0%, #f8fafc 100%);
        }

        /* Header moderno con glassmorphism */
        .navbar-gradient {
            background: linear-gradient(135deg, var(--color-primario) 0%, var(--color-secundario) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 8px 32px rgba(234, 88, 12, 0.3);
            position: relative;
            /* overflow: hidden; */
            /* <-- Eliminar esto para que los dropdowns no se recorten */
            z-index: 10000 !important;
        }

        .navbar-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.03)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .navbar-content {
            position: relative;
            z-index: 10001 !important;
        }

        /* Logo animado mejorado con más dinamismo */
        .logo-container {
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            transform-origin: center center;
        }

        .logo-container:hover {
            transform: scale(1.25) rotate(-5deg);
            filter: drop-shadow(0 16px 32px rgba(249, 115, 22, 0.6)) brightness(1.1);
        }

        .logo-svg {
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2)) brightness(1.05) contrast(1.1);
            transition: all 0.4s ease-in-out;
        }

        .logo-container:hover .logo-svg {
            filter: drop-shadow(0 12px 24px rgba(249, 115, 22, 0.7)) brightness(1.2) contrast(1.2) saturate(1.2);
            transform: rotate(2deg);
        }

        /* Animación de rotación sutil para el logo */
        @keyframes logoFloat {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-3px) rotate(1deg);
            }
        }

        .logo-container {
            animation: logoFloat 4s ease-in-out infinite;
        }

        .logo-container:hover {
            animation-play-state: paused;
        }

        /* Título principal con efecto mejorado */
        .main-title {
            font-family: var(--font-primary);
            background: linear-gradient(135deg, #fed7aa 0%, #fb923c 50%, #ea580c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            font-style: normal;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            letter-spacing: -0.02em;
        }

        .subtitle {
            font-family: var(--font-primary);
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            font-style: italic;
            letter-spacing: 0.02em;
        }

        /* Navegación elegante */
        .nav-link {
            position: relative;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            padding: 0.75rem 1.25rem;
            border-radius: 0.875rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            font-size: 0.95rem;
            letter-spacing: 0.01em;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        /* Botón gradiente mejorado */
        .btn-gradient {
            background: linear-gradient(135deg, var(--color-primario) 0%, var(--color-secundario) 100%);
            color: white;
            font-weight: 700;
            padding: 0.875rem 1.75rem;
            border-radius: 0.875rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 6px 16px rgba(234, 88, 12, 0.3);
            position: relative;
            overflow: hidden;
            font-size: 0.95rem;
            letter-spacing: 0.01em;
        }

        .btn-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-gradient:hover::before {
            left: 100%;
        }

        .btn-gradient:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 12px 24px rgba(234, 88, 12, 0.4);
        }

        /* Notificaciones modernas */
        .notification-btn {
            position: relative;
            padding: 0.875rem;
            border-radius: 0.875rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.1);
        }

        .notification-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }

        .notification-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.15);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Dropdown moderno - ACTUALIZADO */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(234, 88, 12, 0.15);
            border-radius: 1.25rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            position: absolute;
            right: 0;
            top: calc(100% + 0.5rem);
            min-width: 200px;
            z-index: 99999 !important;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px) scale(0.95);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
            max-height: 400px;
            overflow-y: auto;
            overflow-x: hidden;
            /* <-- Evita scroll horizontal */
            padding: 0.5rem 0.25rem;
            /* Espaciado vertical y horizontal */
        }

        .dropdown-menu.user-dropdown {
            width: 220px;
            padding: 0.75rem 0.5rem;
        }

        .dropdown-menu.show {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) scale(1) !important;
            pointer-events: auto !important;
        }

        .dropdown-item {
            color: var(--color-texto);
            padding: 0.875rem 1.25rem;
            border-radius: 0.75rem;
            margin: 0.25rem 0.5rem;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.95rem;
            display: block;
            text-decoration: none;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, var(--color-primario), var(--color-secundario));
            color: white;
            transform: translateX(6px);
        }

        /* Notificaciones específicas */
        .notifications-dropdown {
            width: 320px;
            max-width: 90vw;
        }

        .user-dropdown {
            width: 200px;
        }

        /* Overlay para cerrar dropdowns en móvil */
        .dropdown-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 999;
            background: transparent;
            display: none;
        }

        .dropdown-overlay.show {
            display: block;
        }

        /* Notificación individual */
        .notification-item {
            padding: 0.875rem 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .notification-item:hover {
            background: rgba(234, 88, 12, 0.1);
        }

        .notification-item.unread {
            background: rgba(42, 157, 143, 0.05);
            border-left: 4px solid var(--color-enfasis);
        }

        /* Alertas modernas */
        .alert {
            border-radius: 1.25rem;
            padding: 1.25rem 1.75rem;
            margin-bottom: 1.5rem;
            border: none;
            backdrop-filter: blur(10px);
            font-weight: 500;
            position: relative;
            overflow: hidden;
            font-size: 0.95rem;
        }

        .alert::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.15) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .alert:hover::before {
            transform: translateX(100%);
        }

        .alert-success {
            background: rgba(42, 157, 143, 0.1);
            border-left: 4px solid var(--color-enfasis);
            color: var(--color-enfasis);
        }

        .alert-error {
            background: rgba(234, 88, 12, 0.1);
            border-left: 4px solid var(--color-primario);
            color: var(--color-primario);
        }

        /* Footer elegante */
        .footer-glass {
            background: linear-gradient(135deg, var(--color-primario) 0%, var(--color-secundario) 100%);
            position: relative;
            overflow: hidden;
        }

        .footer-glass::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.03)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .footer-content {
            position: relative;
            z-index: 1;
        }

        /* Contenido principal con glassmorphism sutil */
        .main-content {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-radius: 1.5rem;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
            margin: 2rem;
            padding: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Iconos sociales mejorados con más brillo y dinamismo */
        .social-icon {
            display: inline-block;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            transform-origin: center center;
        }

        .social-icon::before {
            content: '';
            position: absolute;
            top: -8px;
            left: -8px;
            right: -8px;
            bottom: -8px;
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.3), rgba(251, 146, 60, 0.3));
            border-radius: 50%;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s ease;
            z-index: -1;
        }

        .social-icon:hover::before {
            opacity: 1;
            transform: scale(1);
        }

        .social-icon:hover {
            transform: scale(1.4) rotate(10deg);
            filter: brightness(1.4) saturate(1.3) contrast(1.2) drop-shadow(0 8px 16px rgba(0, 0, 0, 0.4));
        }

        .social-icon img {
            filter: brightness(1.1) saturate(1.2) contrast(1.1);
            transition: all 0.3s ease;
            border-radius: 6px;
        }

        .social-icon:hover img {
            filter: brightness(1.3) saturate(1.4) contrast(1.3) drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
        }

        /* Contenedor de iconos sociales con espaciado mejorado */
        .social-icons-container {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            justify-content: flex-start;
            padding: 0.5rem 0;
        }

        /* Iconos SVG personalizados más brillantes */
        .social-svg-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
            border-radius: 12px;
            padding: 8px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
        }

        .social-svg-icon::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
            transition: left 0.5s;
        }

        .social-svg-icon:hover::before {
            left: 100%;
        }

        .social-svg-icon:hover {
            transform: scale(1.3) rotate(8deg);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.25);
            background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
        }

        /* Animaciones de entrada */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        /* Responsive mejoras */
        @media (max-width: 768px) {
            .navbar-gradient {
                padding: 1rem 0;
            }

            .main-content {
                margin: 1rem;
                padding: 1.5rem;
            }

            .nav-link {
                padding: 0.625rem 1rem;
                font-size: 0.9rem;
            }

            .social-icons-container {
                gap: 1rem;
            }

            .social-svg-icon {
                width: 36px;
                height: 36px;
                padding: 6px;
            }
        }

        /* --- FIX: Asegura que los menús flotantes estén por encima del contenido --- */
        .dropdown-menu {
            z-index: 99999 !important;
        }

        .navbar-content,
        .navbar-gradient {
            z-index: 10000 !important;
            position: relative;
        }

        .main-content {
            position: relative;
            z-index: 1;
        }
    </style>
    @stack('styles')
</head>

<body class="min-h-screen flex flex-col">
    <!-- Navbar para cliente -->
    <header class="navbar-gradient text-white shadow-md sticky top-0 z-50">
        <div class="navbar-content">
            <div class="container mx-auto flex justify-between items-center py-4 px-4">
                <div class="flex items-center gap-4">
                    <div class="logo-container">
                        <svg width="56" height="56" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg"
                            class="logo-svg">
                            <defs>
                                <!-- Gradiente principal naranja dorado -->
                                <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%"
                                    y2="100%">
                                    <stop offset="0%" style="stop-color:#fed7aa;stop-opacity:1" />
                                    <stop offset="40%" style="stop-color:#fb923c;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#ea580c;stop-opacity:1" />
                                </linearGradient>

                                <!-- Gradiente para el interior -->
                                <linearGradient id="logoInnerGradient" x1="0%" y1="0%" x2="100%"
                                    y2="100%">
                                    <stop offset="0%" style="stop-color:#f97316;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#ea580c;stop-opacity:1" />
                                </linearGradient>

                                <!-- Gradiente para detalles -->
                                <linearGradient id="logoDetailGradient" x1="0%" y1="0%" x2="100%"
                                    y2="100%">
                                    <stop offset="0%" style="stop-color:#2a9d8f;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#20b2aa;stop-opacity:1" />
                                </linearGradient>

                                <!-- Sombra interna -->
                                <filter id="innerShadow">
                                    <feDropShadow dx="0" dy="2" stdDeviation="2" flood-color="#c2410c"
                                        flood-opacity="0.3" />
                                </filter>
                            </defs>

                            <!-- Círculo base principal -->
                            <circle cx="60" cy="60" r="50" fill="url(#logoGradient)" stroke="#c2410c"
                                stroke-width="2" filter="url(#innerShadow)" />

                            <!-- Círculo interior decorativo -->
                            <circle cx="60" cy="60" r="42" fill="none"
                                stroke="rgba(255,255,255,0.2)" stroke-width="1" stroke-dasharray="5,3" />

                            <!-- Hamburguesa superior (pan) -->
                            <ellipse cx="60" cy="45" rx="22" ry="8"
                                fill="url(#logoInnerGradient)" stroke="#c2410c" stroke-width="1.5" />

                            <!-- Decoración del pan (semillas) -->
                            <circle cx="52" cy="43" r="1.5" fill="#fed7aa" />
                            <circle cx="58" cy="41" r="1.5" fill="#fed7aa" />
                            <circle cx="65" cy="43" r="1.5" fill="#fed7aa" />
                            <circle cx="71" cy="41" r="1.5" fill="#fed7aa" />

                            <!-- Lechuga -->
                            <path
                                d="M40 52 Q45 48 50 52 Q55 48 60 52 Q65 48 70 52 Q75 48 80 52 Q75 56 70 52 Q65 56 60 52 Q55 56 50 52 Q45 56 40 52 Z"
                                fill="url(#logoDetailGradient)" opacity="0.8" />

                            <!-- Carne -->
                            <ellipse cx="60" cy="58" rx="20" ry="4" fill="#8b0000"
                                stroke="#5d0000" stroke-width="1" />

                            <!-- Queso -->
                            <path d="M42 62 L78 62 L76 68 L44 68 Z" fill="#ffd700" stroke="#e6c200"
                                stroke-width="1" />

                            <!-- Pan inferior -->
                            <ellipse cx="60" cy="75" rx="24" ry="10"
                                fill="url(#logoInnerGradient)" stroke="#c2410c" stroke-width="1.5" />

                            <!-- Detalles del pan inferior -->
                            <path d="M38 72 Q60 68 82 72" stroke="rgba(255,255,255,0.3)" stroke-width="1"
                                fill="none" />
                            <path d="M40 78 Q60 82 80 78" stroke="rgba(194, 65, 12, 0.3)" stroke-width="1"
                                fill="none" />

                            <!-- Brillos y reflejos -->
                            <ellipse cx="50" cy="38" rx="8" ry="3"
                                fill="rgba(255,255,255,0.4)" opacity="0.6" />
                            <ellipse cx="70" cy="68" rx="6" ry="2"
                                fill="rgba(255,255,255,0.3)" opacity="0.5" />

                            <!-- Texto FastBite integrado -->
                            <text x="60" y="95" font-family="Nunito Sans, sans-serif" font-size="8"
                                font-weight="700" text-anchor="middle" fill="white" opacity="0.8">FastBite</text>
                        </svg>
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="main-title text-2xl lg:text-3xl">FastBite</h1>
                        <p class="subtitle text-sm">Tu comida favorita</p>
                    </div>
                </div>

                <nav class="hidden lg:flex gap-2 items-center">
                    <a href="{{ route('cliente.dashboard') }}"
                        class="nav-link {{ request()->routeIs('cliente.dashboard') ? 'bg-white/20' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('cliente.menu') }}"
                        class="nav-link {{ request()->routeIs('cliente.menu') ? 'bg-white/20' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Menú
                    </a>
                    <a href="{{ route('cliente.carrito') }}"
                        class="nav-link {{ request()->routeIs('cliente.carrito') ? 'bg-white/20' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0L17 18" />
                        </svg>
                        Carrito
                    </a>
                    <a href="{{ route('cliente.pedidos.index') }}"
                        class="nav-link {{ request()->routeIs('cliente.pedidos.*') ? 'bg-white/20' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Mis Pedidos
                    </a>
                    <a href="{{ route('cliente.pagos.index') }}"
                        class="nav-link {{ request()->routeIs('cliente.pagos.*') ? 'bg-white/20' : '' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Mis Pagos
                    </a>

                    <!-- Notificaciones -->
                    <div class="dropdown relative ml-4" id="notifications-dropdown">
                        <button type="button" class="notification-btn flex items-center gap-1"
                            onclick="cargarNotificaciones()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span id="notification-badge" class="notification-badge hidden">0</span>
                        </button>
                        <div class="dropdown-menu notifications-dropdown">
                            <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                                <h3 class="text-lg font-bold text-gray-800">Notificaciones</h3>
                                <button onclick="marcarTodasLeidas()"
                                    class="text-xs text-orange-600 hover:text-orange-800 font-medium">
                                    Marcar todas como leídas
                                </button>
                            </div>
                            <div id="notifications-container" class="max-h-80 overflow-y-auto">
                                <div class="p-8 text-center text-gray-500">
                                    <div
                                        class="animate-spin rounded-full h-8 w-8 border-b-2 border-orange-500 mx-auto mb-3">
                                    </div>
                                    <p class="text-sm">Cargando notificaciones...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @auth
                        <div class="dropdown relative ml-4">
                            <button type="button" class="btn-gradient flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="dropdown-menu user-dropdown py-2">
                                <a href="{{ route('cliente.perfil.edit') }}" class="dropdown-item">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Mi Perfil
                                </a>
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-gradient ml-4">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Iniciar Sesión
                        </a>
                    @endauth
                </nav>

                <!-- Menú móvil (hamburguesa) -->
                <button class="lg:hidden nav-link" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    @yield('header')

    <!-- Menú móvil desplegable -->
    <div id="mobile-menu" class="lg:hidden hidden bg-gradient-to-r from-orange-600 to-orange-400 text-white">
        <div class="container mx-auto px-4 py-4 space-y-2">
            <a href="{{ route('cliente.dashboard') }}" class="block nav-link">Dashboard</a>
            <a href="{{ route('cliente.menu') }}" class="block nav-link">Menú</a>
            <a href="{{ route('cliente.carrito') }}" class="block nav-link">Carrito</a>
            <a href="{{ route('cliente.pedidos.index') }}" class="block nav-link">Mis Pedidos</a>
            <a href="{{ route('cliente.pagos.index') }}" class="block nav-link">Mis Pagos</a>
            @auth
                <a href="{{ route('cliente.perfil.edit') }}" class="block nav-link">Mi Perfil</a>
                <a href="{{ route('logout') }}" class="block nav-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">Cerrar
                    Sesión</a>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="block nav-link">Iniciar Sesión</a>
            @endauth
        </div>
    </div>

    <!-- Contenido principal -->
    <main class="flex-1 animate-fade-in-up">
        <div class="main-content">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error" role="alert">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer elegante -->
    <footer class="footer-glass text-white mt-10">
        <div class="footer-content">
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Información principal -->
                    <div class="lg:col-span-2">
                        <div class="flex items-center gap-4 mb-4">
                            <svg width="48" height="48" viewBox="0 0 120 120"
                                xmlns="http://www.w3.org/2000/svg" class="logo-svg">
                                <defs>
                                    <linearGradient id="footerLogoGradient" x1="0%" y1="0%"
                                        x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#fed7aa;stop-opacity:1" />
                                        <stop offset="40%" style="stop-color:#fb923c;stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#ea580c;stop-opacity:1" />
                                    </linearGradient>
                                </defs>
                                <circle cx="60" cy="60" r="50" fill="url(#footerLogoGradient)"
                                    stroke="#c2410c" stroke-width="2" />
                                <ellipse cx="60" cy="45" rx="22" ry="8"
                                    fill="#c2410c" />
                                <circle cx="52" cy="43" r="1.5" fill="#fed7aa" />
                                <circle cx="58" cy="41" r="1.5" fill="#fed7aa" />
                                <circle cx="65" cy="43" r="1.5" fill="#fed7aa" />
                                <circle cx="71" cy="41" r="1.5" fill="#fed7aa" />
                                <ellipse cx="60" cy="58" rx="20" ry="4"
                                    fill="#8b0000" />
                                <ellipse cx="60" cy="75" rx="24" ry="10"
                                    fill="#c2410c" />
                                <text x="60" y="95" font-family="Nunito Sans, sans-serif" font-size="8"
                                    font-weight="700" text-anchor="middle" fill="white"
                                    opacity="0.8">FastBite</text>
                            </svg>
                            <div>
                                <h3 class="text-2xl font-bold">FastBite</h3>
                                <p class="text-sm opacity-80 italic">Tu comida favorita a domicilio</p>
                            </div>
                        </div>
                        <p class="text-white/80 mb-6 leading-relaxed">
                            Disfruta de la mejor comida rápida desde la comodidad de tu hogar.
                            Entrega rápida, sabores únicos y la mejor experiencia gastronómica.
                        </p>

                        <!-- Iconos sociales mejorados con SVG personalizados -->
                        <div class="social-icons-container">
                            <!-- Facebook -->
                            <a href="#" class="social-svg-icon" title="Facebook">
                                <svg viewBox="0 0 24 24" fill="#1877F2" width="100%" height="100%">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>

                            <!-- Instagram -->
                            <a href="#" class="social-svg-icon" title="Instagram">
                                <svg viewBox="0 0 24 24" fill="url(#instagramGradient)" width="100%"
                                    height="100%">
                                    <defs>
                                        <linearGradient id="instagramGradient" x1="0%" y1="0%"
                                            x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#833ab4" />
                                            <stop offset="50%" style="stop-color:#fd1d1d" />
                                            <stop offset="100%" style="stop-color:#fcb045" />
                                        </linearGradient>
                                    </defs>
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>

                            <!-- WhatsApp -->
                            <a href="#" class="social-svg-icon" title="WhatsApp">
                                <svg viewBox="0 0 24 24" fill="#25D366" width="100%" height="100%">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                                </svg>
                            </a>

                            <!-- Twitter/X -->
                            <a href="#" class="social-svg-icon" title="Twitter">
                                <svg viewBox="0 0 24 24" fill="#1DA1F2" width="100%" height="100%">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                            </a>

                            <!-- YouTube -->
                            <a href="#" class="social-svg-icon" title="YouTube">
                                <svg viewBox="0 0 24 24" fill="#FF0000" width="100%" height="100%">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Enlaces rápidos -->
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Navegación</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('cliente.dashboard') }}"
                                    class="text-white/80 hover:text-white transition-colors">Inicio</a></li>
                            <li><a href="{{ route('cliente.menu') }}"
                                    class="text-white/80 hover:text-white transition-colors">Nuestro Menú</a></li>
                            <li><a href="{{ route('cliente.pedidos.index') }}"
                                    class="text-white/80 hover:text-white transition-colors">Mis Pedidos</a></li>
                            <li><a href="{{ route('cliente.carrito') }}"
                                    class="text-white/80 hover:text-white transition-colors">Carrito</a></li>
                        </ul>
                    </div>

                    <!-- Soporte -->
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Soporte</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-white/80 hover:text-white transition-colors">Centro de
                                    Ayuda</a></li>
                            <li><a href="#"
                                    class="text-white/80 hover:text-white transition-colors">Contacto</a></li>
                            <li><a href="#" class="text-white/80 hover:text-white transition-colors">Términos de
                                    Servicio</a></li>
                            <li><a href="#" class="text-white/80 hover:text-white transition-colors">Política de
                                    Privacidad</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-white/20 py-6">
                <div class="container mx-auto px-4 text-center">
                    <p class="text-white/70">
                        &copy; {{ date('Y') }} <span class="italic font-semibold">FastBite</span> - Tu comida
                        favorita.
                        Todos los derechos reservados.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Función para el menú móvil
            window.toggleMobileMenu = function() {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            };

            // Cerrar menú móvil al hacer clic en un enlace
            const mobileLinks = document.querySelectorAll('#mobile-menu a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function() {
                    document.getElementById('mobile-menu').classList.add('hidden');
                });
            });

            // Manejo de dropdowns mejorado
            const dropdowns = document.querySelectorAll('.dropdown');
            let lastOpenedMenu = null;

            dropdowns.forEach(dropdown => {
                const button = dropdown.querySelector('button');
                const menu = dropdown.querySelector('.dropdown-menu');

                if (!button || !menu) return;

                // Agregar event listener al botón
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    // Cerrar otros dropdowns
                    dropdowns.forEach(otherDropdown => {
                        const otherMenu = otherDropdown.querySelector('.dropdown-menu');
                        if (otherMenu && otherMenu !== menu) {
                            otherMenu.classList.remove('show');
                        }
                    });
                    // Toggle el dropdown actual
                    menu.classList.toggle('show');
                    if (menu.classList.contains('show')) {
                        lastOpenedMenu = menu;
                        // Foco accesible
                        setTimeout(() => menu.focus && menu.focus(), 10);
                    } else {
                        lastOpenedMenu = null;
                    }
                });
            });

            // Cerrar dropdowns al hacer clic fuera
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    dropdowns.forEach(dropdown => {
                        const menu = dropdown.querySelector('.dropdown-menu');
                        if (menu) {
                            menu.classList.remove('show');
                        }
                    });
                    lastOpenedMenu = null;
                }
            });

            // Cerrar dropdowns con Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && lastOpenedMenu) {
                    lastOpenedMenu.classList.remove('show');
                    lastOpenedMenu = null;
                }
            });

            // Función para cargar notificaciones
            window.cargarNotificaciones = function() {
                fetch('{{ route('cliente.api.notificaciones') }}')
                    .then(response => response.json())
                    .then(data => {
                        actualizarContadorNotificaciones(data.no_leidas);
                        mostrarNotificaciones(data.notificaciones);
                    })
                    .catch(error => {
                        console.error('Error al cargar notificaciones:', error);
                        mostrarErrorNotificaciones();
                    });
            };

            // Función para actualizar el contador de notificaciones
            function actualizarContadorNotificaciones(cantidad) {
                const badge = document.getElementById('notification-badge');
                if (cantidad > 0) {
                    badge.textContent = cantidad;
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            }

            // Función para mostrar las notificaciones
            function mostrarNotificaciones(notificaciones) {
                const container = document.getElementById('notifications-container');

                if (notificaciones.length === 0) {
                    container.innerHTML = `
                        <div class="p-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <p class="text-sm">No tienes notificaciones</p>
                        </div>
                    `;
                    return;
                }

                let html = '';
                notificaciones.forEach(notificacion => {
                    const fechaFormateada = new Date(notificacion.created_at).toLocaleString('es-ES', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    html += `
                        <div class="notification-item ${!notificacion.leido ? 'unread' : ''}" onclick="marcarComoLeida(${notificacion.id})">
                            <p class="text-sm text-gray-800 font-medium">${notificacion.mensaje}</p>
                            <p class="text-xs text-gray-500 mt-1">${fechaFormateada}</p>
                        </div>
                    `;
                });

                html += `
                    <div class="p-3 border-t border-gray-200">
                        <a href="{{ route('cliente.notificaciones.index') }}" class="block text-center text-sm font-medium text-orange-600 hover:text-orange-800">
                            Ver todas las notificaciones
                        </a>
                    </div>
                `;

                container.innerHTML = html;
            }

            // Función para mostrar error
            function mostrarErrorNotificaciones() {
                const container = document.getElementById('notifications-container');
                container.innerHTML = `
                    <div class="p-8 text-center text-red-500">
                        <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm">Error al cargar notificaciones</p>
                        <button onclick="cargarNotificaciones()" class="mt-2 text-xs text-orange-600 hover:text-orange-800">Reintentar</button>
                    </div>
                `;
            }

            // Función para marcar como leída
            window.marcarComoLeida = function(id) {
                fetch(`{{ url('cliente/api/notificaciones') }}/${id}/leida`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            cargarNotificaciones(); // Recargar notificaciones
                        }
                    })
                    .catch(error => console.error('Error:', error));
            };

            // Función para marcar todas como leídas
            window.marcarTodasLeidas = function() {
                fetch('{{ route('cliente.api.notificaciones.todas-leidas') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            cargarNotificaciones(); // Recargar notificaciones
                        }
                    })
                    .catch(error => console.error('Error:', error));
            };

            // Cargar notificaciones al inicio
            @auth
            cargarNotificaciones();

            // Recargar notificaciones cada 30 segundos
            setInterval(cargarNotificaciones, 30000);
        @endauth
        });
    </script>

    @stack('scripts')
</body>

</html>
