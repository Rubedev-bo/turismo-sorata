@extends('layouts.app')

@section('content')
<div class="sorata-modal-overlay" role="dialog" aria-modal="true" aria-labelledby="admin-login-title">
    <div class="sorata-modal" style="position:relative">
        <button class="modal-close sorata-close" aria-label="Cerrar" onclick="window.location='{{ url('/') }}'" style="position:absolute;right:12px;top:12px;background:transparent;border:0;font-size:20px;color:var(--andino);">✕</button>
        <div class="container">
            <h1 id="admin-login-title">Login Administrador</h1>

            @if ($errors->any())
                <div class="errors" role="alert" style="margin-bottom:12px;color:#b00020;background:rgba(231,111,81,0.06);padding:10px;border-radius:8px;">
                    <ul style="margin:0;padding-left:1.1rem">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}" class="sorata-form" style="align-items:start;">
                @csrf
                <div class="field">
                    <label>Usuario <span class="required" aria-hidden="true">*</span></label>
                    <input type="text" name="usuario" value="{{ old('usuario') }}" required autocomplete="username">
                </div>
                <div class="field">
                    <label>Password <span class="required" aria-hidden="true">*</span></label>
                    <input type="password" name="password" required autocomplete="current-password">
                </div>

                <div class="form-row-full" style="display:flex;align-items:center;justify-content:space-between;margin-top:6px">
                    <div style="display:flex;align-items:center;gap:12px">
                        <a href="/admin/crear" class="nav__link" style="padding:8px 12px;background:transparent;border-radius:8px;color:var(--andino);">Crear usuario</a>
                    </div>

                    <div style="display:flex;gap:12px;align-items:center">
                        <a href="{{ url('/') }}" class="btn" style="background:transparent;color:var(--andino);border:1px solid rgba(30,95,140,0.08);padding:10px 14px;border-radius:8px;">Cerrar</a>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
