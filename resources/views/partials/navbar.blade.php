<header class="site-header" id="site-header">
    <div class="container nav-container">
        <div class="brand">
            <a href="{{ route('home') }}">Sorata <strong>Pacha</strong></a>
        </div>

        <nav class="nav-links" id="nav-links">
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('tours') }}">Tours</a>
            <a href="{{ route('comunidades.index') }}">Destinos</a>
            <a href="{{ route('contact') }}">Contacto</a>
            <button class="nav-login btn-secondary" id="login-open" type="button">Login</button>
        </nav>

        <button id="nav-toggle" class="nav-toggle" aria-label="Abrir menú">☰</button>
    </div>

    <!-- Login Modal -->
    <div id="login-modal" class="modal" aria-hidden="true" style="display:none;">
        <div class="modal-backdrop" id="login-backdrop"></div>
        <div class="modal-dialog" role="dialog" aria-modal="true">
            <button class="modal-close" id="login-close" aria-label="Cerrar">×</button>
            <h3 class="center">Iniciar sesión</h3>

            <form method="POST" action="{{ route('admin.login.post') }}" class="login-form">
                @csrf
                <label for="login-usuario">Usuario</label>
                <input id="login-usuario" name="usuario" type="text" required>
                @error('usuario') <div class="form-error">{{ $message }}</div> @enderror

                <label for="login-password">Contraseña</label>
                <input id="login-password" name="password" type="password" required>
                @error('password') <div class="form-error">{{ $message }}</div> @enderror

                <div style="margin:12px 0;">
                    <label><input type="checkbox" name="remember"> Recuérdame</label>
                </div>

                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
        </div>
    </div>

</header>
