@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Comunidad</h1>
    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('comunidades.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" required>
        </div>
        <div>
            <label>Descripcion</label>
            <textarea name="descripcion">{{ old('descripcion') }}</textarea>
        </div>
        <div>
            <label>Imagen representativa</label>
            <input type="file" name="imagen_representativa" accept="image/*">
        </div>
        <div>
            <label>Teléfono de contacto</label>
            <input type="text" name="contacto_telefono" value="{{ old('contacto_telefono') }}">
        </div>
        <div>
            <label>Punto de partida (Sorata)</label>
            <input type="text" name="punto_partida_sorata" value="{{ old('punto_partida_sorata') }}">
        </div>
        <div>
            <label>Dificultad de acceso</label>
            <input type="text" name="dificultad_acceso" value="{{ old('dificultad_acceso') }}">
        </div>
        <div>
            <label>Recomendaciones de acceso</label>
            <textarea name="recomendaciones_acceso">{{ old('recomendaciones_acceso') }}</textarea>
        </div>
        <div>
            <label>Contacto email</label>
            <input type="email" name="contacto_email" value="{{ old('contacto_email') }}">
        </div>
        <div>
            <label>Estado</label>
            <select name="estado">
                <option value="activa">Activa</option>
                <option value="inactiva">Inactiva</option>
            </select>
        </div>
        <div style="margin-top:12px">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('comunidades.index') }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>
@endsection
