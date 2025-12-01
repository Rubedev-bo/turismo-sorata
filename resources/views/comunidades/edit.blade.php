@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Comunidad</h1>
    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('comunidades.update', $comunidad->comunidad_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $comunidad->nombre) }}" required>
        </div>
        <div>
            <label>Descripcion</label>
            <textarea name="descripcion">{{ old('descripcion', $comunidad->descripcion) }}</textarea>
        </div>
        <div>
            <label>Contacto email</label>
            <input type="email" name="contacto_email" value="{{ old('contacto_email', $comunidad->contacto_email) }}">
        </div>
        <div>
            <label>Estado</label>
            <select name="estado">
                <option value="activa" {{ $comunidad->estado == 'activa' ? 'selected' : '' }}>Activa</option>
                <option value="inactiva" {{ $comunidad->estado == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
            </select>
        </div>
        <button type="submit">Actualizar</button>
    </form>
</div>
@endsection
