@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Experiencia</h1>
    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('experiencias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Comunidad</label>
            <select name="comunidad_id" required>
                <option value="">Seleccione comunidad</option>
                @foreach($comunidades as $c)
                    <option value="{{ $c->comunidad_id }}">{{ $c->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Nombre</label>
            <input type="text" name="nombre" required>
        </div>
        <div>
            <label>Imagen principal</label>
            <input type="file" name="imagen_principal" accept="image/*">
        </div>
        <div>
            <label>Descripción corta</label>
            <input type="text" name="descripcion_corta">
        </div>
        <div>
            <label>Descripción completa</label>
            <textarea name="descripcion_completa" rows="4"></textarea>
        </div>
        <div>
            <label>Precio (bs)</label>
            <input type="number" step="0.01" name="precio_bs" required>
        </div>
        <div>
            <label>Duración estimada</label>
            <input type="text" name="duracion_estimada" placeholder="Ej: 4-6 horas">
        </div>
        <div>
            <label>Tipo actividad</label>
            <input type="text" name="tipo_actividad" required>
        </div>
        <div style="margin-top:12px">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('experiencias.index') }}" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>
@endsection
