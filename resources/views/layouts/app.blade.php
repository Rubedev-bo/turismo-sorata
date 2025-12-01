<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sorata Adventures')</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            if (window.AOS) AOS.init({duration:800, easing: 'ease-in-out', once: true});
        });
    </script>
    @stack('scripts')
</body>
</html>
{{-- <!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Sorata Pacha</title>
</head>
<body>

    <header class="header">
        <nav class="header__nav">
            <a href="{{ url('/') }}" class="nav__link">Inicio</a> |
            <a href="{{ route('comunidades.index') }}" class="nav__link">Comunidades</a> |
            <a href="{{ route('experiencias.index') }}" class="nav__link">Experiencias</a> |
            @if(session('admin_id'))
                <a href="{{ route('admin.dashboard') }}" class="nav__link">Panel Admin</a> |
                <form action="{{ route('admin.logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit">Salir Admin</button>
                </form>
            @else
                <a href="{{ route('admin.login') }}" class="nav__link">Admin (login)</a>
            @endif
        </nav>
    </header>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif

    <main>
        @yield('content')
    </main>
	<footer>
		<p>MI FOOTER</p>
	</footer>
    @yield('scripts')
</body>
</html> --}}
