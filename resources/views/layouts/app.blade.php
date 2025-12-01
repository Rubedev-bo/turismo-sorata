<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sorata Pacha</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700;800&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Sorata Pacha styles -->
    <link rel="stylesheet" href="/css/sorata.css">
</head>
<body>
    <header class="header">
        <div class="header__nav header__inner">
            <div class="nav__brand">
                <a href="{{ url('/') }}" class="nav__link">Sorata Pacha</a>
            </div>
            <nav class="nav__links" aria-label="Main Navigation">
                <a href="{{ url('/') }}" class="nav__link">Inicio</a>
                <a href="{{ route('comunidades.index') }}" class="nav__link">Comunidades</a>
                <a href="{{ route('experiencias.index') }}" class="nav__link">Experiencias</a>
                @if(session('admin_id'))
                    <a href="{{ route('admin.dashboard') }}" class="nav__link">Panel Admin</a>
                    <form action="{{ route('admin.logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="nav__link logout-button">Salir Admin</button>
                    </form>
                @else
                    <a href="{{ route('admin.login') }}" class="nav__link">Admin (login)</a>
                @endif
            </nav>

            <button class="hamburger" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobile-nav">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
        </div>

        <div id="mobile-nav" class="mobile-nav-panel" aria-hidden="true">
            <nav class="mobile-nav-inner">
                <a href="{{ url('/') }}" class="nav__link">Inicio</a>
                <a href="{{ route('comunidades.index') }}" class="nav__link">Comunidades</a>
                <a href="{{ route('experiencias.index') }}" class="nav__Link">Experiencias</a>
                @if(session('admin_id'))
                    <a href="{{ route('admin.dashboard') }}" class="nav__link">Panel Admin</a>
                    <form action="{{ route('admin.logout') }}" method="POST" style="display:block;margin-top:8px;">
                        @csrf
                        <button type="submit" class="nav__link logout-button">Salir Admin</button>
                    </form>
                @else
                    <a href="{{ route('admin.login') }}" class="nav__link">Admin (login)</a>
                @endif
            </nav>
        </div>
        <div class="mobile-backdrop" id="mobile-backdrop" aria-hidden="true"></div>
    </header>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif

    <main>
        @yield('content')
    </main>
	<footer>
        <div class="site-footer container">
            <div class="footer-grid">
                <div class="footer-col footer-brand">
                    <h4>Sobre Sorata Pacha</h4>
                    <p>Turismo comunitario en Sorata, La Paz. Promovemos experiencias sostenibles y auténticas con las comunidades locales.</p>
                </div>
                <div class="footer-col">
                    <h4>Comunidades</h4>
                    <ul>
                        <li><a href="{{ route('comunidades.index') }}">Ver comunidades</a></li>
                        <li class="footer-action"><a href="{{ route('comunidades.index') }}">Crear comunidad</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Experiencias</h4>
                    <ul>
                        <li><a href="{{ route('experiencias.index') }}">Ver experiencias</a></li>
                        <li class="footer-action"><a href="{{ route('experiencias.index') }}">Crear experiencia</a></li>
                    </ul>
                </div>
                <div class="footer-col footer-contact">
                    <h4>Contacto</h4>
                    <ul>
                        <li><a href="{{ route('reservas.create') }}">Realizar una reserva</a></li>
                        <li><a href="{{ url('/') }}">Inicio</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-copy">&copy; {{ date('Y') }} Sorata Pacha. Todos los derechos reservados.</div>
                <div class="footer-social">
                    <!-- Simple social placeholders; replace with icons if desired -->
                    <a href="#" aria-label="Instagram">IG</a>
                    <a href="#" aria-label="Facebook">FB</a>
                    <a href="#" aria-label="YouTube">YT</a>
                </div>
            </div>
        </div>
	</footer>
    <!-- Sorata Pacha scripts -->
    <script src="/js/sorata.js" defer></script>
</body>
</html>
