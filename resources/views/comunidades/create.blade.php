@extends('layouts.app')

@section('content')
<div class="sorata-modal-overlay" role="dialog" aria-modal="true" aria-labelledby="crear-comunidad-title">
    <div class="sorata-modal" style="position:relative">
        <button class="modal-close sorata-close" aria-label="Cerrar" onclick="window.location='{{ route('comunidades.index') }}'" style="position:absolute;right:12px;top:12px;background:transparent;border:0;font-size:20px;color:var(--andino);">✕</button>
        <div class="container">
            <h1 id="crear-comunidad-title">Crear Comunidad</h1>
            @if ($errors->any())
                <div class="errors" role="alert" style="margin-bottom:12px;color:#b00020;background:rgba(231,111,81,0.06);padding:10px;border-radius:8px;">
                    <ul style="margin:0;padding-left:1.1rem">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('comunidades.store') }}" method="POST" enctype="multipart/form-data" class="sorata-form">
                @csrf
                <div class="field">
                    <label>Nombre <span class="required">*</span></label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" required>
                </div>

                <div class="form-row-full field">
                    <label>Descripcion</label>
                    <textarea name="descripcion">{{ old('descripcion') }}</textarea>
                </div>

                <div class="field">
                    <label>Contacto email</label>
                    <input type="email" name="contacto_email" value="{{ old('contacto_email') }}">
                </div>

                <div class="field">
                    <label>Imagen representativa (obligatoria, máx 10MB)</label>
                    <input type="file" name="imagen_representativa" accept="image/*" required>
                </div>

                <div class="field">
                    <label>Estado</label>
                    <select name="estado">
                        <option value="activa">Activa</option>
                        <option value="inactiva">Inactiva</option>
                    </select>
                </div>

                <div class="form-row-full actions" style="margin-top:8px">
                    <a href="{{ route('comunidades.index') }}" class="btn" style="background:transparent;color:var(--andino);border:1px solid rgba(30,95,140,0.08);padding:10px 14px;border-radius:8px;">Cerrar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
