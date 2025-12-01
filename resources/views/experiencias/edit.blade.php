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

    <form action="{{ route('experiencias.update', $experiencia->experiencia_id) }}" method="POST" enctype="multipart/form-data">
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
            <select name="tipo_actividad" required>
                <option value="">-- Seleccione --</option>
                <option value="trekking" {{ old('tipo_actividad', $experiencia->tipo_actividad) == 'trekking' ? 'selected' : '' }}>Trekking</option>
                <option value="hospedaje" {{ old('tipo_actividad', $experiencia->tipo_actividad) == 'hospedaje' ? 'selected' : '' }}>Hospedaje</option>
                <option value="cultural" {{ old('tipo_actividad', $experiencia->tipo_actividad) == 'cultural' ? 'selected' : '' }}>Cultural</option>
            </select>
        </div>
        <div>
            <label>Imagen principal (si deseas reemplazarla, sube una nueva) (máx 10 MB)</label>
            <input type="file" name="imagen_principal" accept="image/*">
            @if($experiencia->imagen_principal)
                <div style="margin-top:8px">
                    <small>Imagen actual:</small><br>
                    <img src="{{ $experiencia->imagen_principal }}" alt="{{ $experiencia->nombre }}" style="max-width:160px;margin-top:6px;border-radius:6px">
                </div>
            @endif
        </div>
        <div>
            <label>Descripción corta</label>
            <input type="text" name="descripcion_corta" value="{{ old('descripcion_corta', $experiencia->descripcion_corta) }}">
        </div>
        <div>
            <label>Descripción completa</label>
            <textarea name="descripcion_completa">{{ old('descripcion_completa', $experiencia->descripcion_completa) }}</textarea>
        </div>
        <div>
            <label>Duración estimada</label>
            <input type="text" name="duracion_estimada" value="{{ old('duracion_estimada', $experiencia->duracion_estimada) }}" placeholder="Ej: 4 horas">
        </div>
        <div>
            <label>Estado</label>
            <select name="estado">
                <option value="activa" {{ $experiencia->estado == 'activa' ? 'selected' : '' }}>Activa</option>
                <option value="inactiva" {{ $experiencia->estado == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
            </select>
        </div>
        <hr>
        <h3>Información climática (opcional)</h3>
        <div>
            <label>Temporada</label>
            <input type="text" name="clima_temporada" value="{{ old('clima_temporada', optional($clima)->temporada) }}">
        </div>
        <div>
            <label>Mejor época</label>
            <select name="clima_mejor_epoca">
                <option value="">-- Seleccione --</option>
                <option value="1" {{ (string) old('clima_mejor_epoca', optional($clima)->mejor_epoca ? '1' : '0') === '1' ? 'selected' : '' }}>Sí (mejor época)</option>
                <option value="0" {{ (string) old('clima_mejor_epoca', optional($clima)->mejor_epoca ? '1' : '0') === '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div>
            <label>Temperatura máxima promedio</label>
            <input type="number" step="0.1" name="clima_temp_max_promedio" value="{{ old('clima_temp_max_promedio', optional($clima)->temp_max_promedio) }}">
        </div>
        <div>
            <label>Temperatura mínima promedio</label>
            <input type="number" step="0.1" name="clima_temp_min_promedio" value="{{ old('clima_temp_min_promedio', optional($clima)->temp_min_promedio) }}">
        </div>
        <div>
            <label>Recomendación de vestimenta</label>
            <textarea name="clima_recomendacion_vestimenta">{{ old('clima_recomendacion_vestimenta', optional($clima)->recomendacion_vestimenta) }}</textarea>
        </div>
        <div>
            <label>Consideraciones especiales</label>
            <textarea name="clima_consideraciones_especiales">{{ old('clima_consideraciones_especiales', optional($clima)->consideraciones_especiales) }}</textarea>
        </div>
        <div>
            <label>Estado clima</label>
            <select name="clima_estado">
                <option value="activa" {{ optional($clima)->estado == 'activa' ? 'selected' : '' }}>Activa</option>
                <option value="inactiva" {{ optional($clima)->estado == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
            </select>
        </div>

        <hr>
        <h3>Equipamiento (opcional)</h3>
        <div>
            <label>Categoria</label>
            <input type="text" name="equipamiento_categoria" value="{{ old('equipamiento_categoria') }}">
        </div>
        <div>
            <label>Explicación del equipamiento (opcional)</label>
            <textarea name="equipamiento_explicacion">{{ old('equipamiento_explicacion') }}</textarea>
        </div>
        <div>
            <label>Items (separados por comas)</label>
            <textarea name="equipamiento_items">{{ old('equipamiento_items', isset($equip_text) ? implode(', ', explode("\n", $equip_text)) : '') }}</textarea>
        </div>
        <button type="submit">Actualizar</button>
    </form>
</div>
@endsection
