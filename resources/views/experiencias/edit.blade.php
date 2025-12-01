@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Experiencia</h1>
    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('experiencias.update', $experiencia->experiencia_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Comunidad</label>
            <select name="comunidad_id" required>
                <option value="">Seleccione comunidad</option>
                @foreach($comunidades as $c)
                    <option value="{{ $c->comunidad_id }}" {{ $c->comunidad_id == $experiencia->comunidad_id ? 'selected' : '' }}>{{ $c->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $experiencia->nombre) }}" required>
        </div>
        <div>
            <label>Precio (bs)</label>
            <input type="number" step="0.01" name="precio_bs" value="{{ old('precio_bs', $experiencia->precio_bs) }}" required>
        </div>
        <div>
            <label>Tipo actividad</label>
            <input type="text" name="tipo_actividad" value="{{ old('tipo_actividad', $experiencia->tipo_actividad) }}" required>
        </div>
        <div>
            <label>Estado</label>
            <select name="estado">
                <option value="activa" {{ $experiencia->estado == 'activa' ? 'selected' : '' }}>Activa</option>
                <option value="inactiva" {{ $experiencia->estado == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
            </select>
        </div>
        <button type="submit">Actualizar</button>
    </form>
</div>
@endsection
