@extends('layouts.app')

@section('content')
<div class="sorata-modal-overlay" role="dialog" aria-modal="true" aria-labelledby="crear-experiencia-title">
    <div class="sorata-modal" style="position:relative">
        <button class="modal-close sorata-close" aria-label="Cerrar" onclick="window.location='{{ route('experiencias.index') }}'" style="position:absolute;right:12px;top:12px;background:transparent;border:0;font-size:20px;color:var(--andino);">✕</button>
        <div class="container">
            <h1 id="crear-experiencia-title">Crear Experiencia</h1>
            @if ($errors->any())
                <div class="errors" role="alert" style="margin-bottom:12px;color:#b00020;background:rgba(231,111,81,0.06);padding:10px;border-radius:8px;">
                    <ul style="margin:0;padding-left:1.1rem">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('experiencias.store') }}" method="POST" enctype="multipart/form-data" class="sorata-form">
                @csrf
                <div class="field">
                    <label>Comunidad</label>
                    <select name="comunidad_id" required>
                        <option value="">Seleccione comunidad</option>
                        @foreach($comunidades as $c)
                            <option value="{{ $c->comunidad_id }}">{{ $c->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label>Nombre</label>
                    <input type="text" name="nombre" required>
                </div>

                <div class="field">
                    <label>Precio (bs)</label>
                    <input type="number" step="0.01" name="precio_bs" required>
                </div>

                <div class="field">
                    <label>Tipo actividad</label>
                    <select name="tipo_actividad" required>
                        <option value="">-- Seleccione --</option>
                        <option value="trekking">Trekking</option>
                        <option value="hospedaje">Hospedaje</option>
                        <option value="cultural">Cultural</option>
                    </select>
                </div>

                <div class="field">
                    <label>Imagen principal (máx 10 MB)</label>
                    <input type="file" name="imagen_principal" accept="image/*" required>
                </div>

                <div class="field">
                    <label>Descripción corta</label>
                    <input type="text" name="descripcion_corta" value="{{ old('descripcion_corta') }}">
                </div>

                <div class="form-row-full field">
                    <label>Descripción completa</label>
                    <textarea name="descripcion_completa">{{ old('descripcion_completa') }}</textarea>
                </div>

                <div class="field">
                    <label>Duración estimada</label>
                    <input type="text" name="duracion_estimada" value="{{ old('duracion_estimada') }}" placeholder="Ej: 4 horas">
                </div>

                <div class="field">
                    <label>Estado</label>
                    <select name="estado">
                        <option value="activa" {{ old('estado') == 'activa' ? 'selected' : '' }}>Activa</option>
                        <option value="inactiva" {{ old('estado') == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                    </select>
                </div>

                <hr style="grid-column:1 / -1; width:100%">
                <h3 style="grid-column:1 / -1">Información climática (opcional)</h3>

                <div class="field">
                    <label>Clima (elige uno)</label>
                    <select name="clima_temporada">
                        <option value="">-- Seleccione --</option>
                        <option value="seca" {{ old('clima_temporada') == 'seca' ? 'selected' : '' }}>Temporada seca</option>
                        <option value="humeda" {{ old('clima_temporada') == 'humeda' ? 'selected' : '' }}>Temporada húmeda</option>
                    </select>
                </div>

                <div class="field">
                    <label>Mejor época (elige uno)</label>
                    <select name="clima_mejor_epoca">
                        <option value="">-- Seleccione --</option>
                            <option value="1" {{ old('clima_mejor_epoca') === '1' ? 'selected' : '' }}>Sí (mejor época)</option>
                            <option value="0" {{ old('clima_mejor_epoca') === '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="field">
                    <label>Temperatura máxima promedio</label>
                    <input type="number" step="0.1" name="clima_temp_max_promedio">
                </div>

                <div class="field">
                    <label>Temperatura mínima promedio</label>
                    <input type="number" step="0.1" name="clima_temp_min_promedio">
                </div>

                <div class="form-row-full field">
                    <label>Recomendación de vestimenta</label>
                    <textarea name="clima_recomendacion_vestimenta"></textarea>
                </div>

                <div class="form-row-full field">
                    <label>Consideraciones especiales</label>
                    <textarea name="clima_consideraciones_especiales"></textarea>
                </div>

                <div class="field">
                    <label>Estado clima</label>
                    <select name="clima_estado">
                        <option value="activa">Activa</option>
                        <option value="inactiva">Inactiva</option>
                    </select>
                </div>

                <hr style="grid-column:1 / -1; width:100%">
                <h3 style="grid-column:1 / -1">Equipamiento (opcional)</h3>

                <div class="field">
                    <label>Categoria</label>
                    <input type="text" name="equipamiento_categoria" placeholder="Ej: Indumentaria, Herramientas">
                </div>

                <div class="form-row-full field">
                    <label>Explicación del equipamiento (opcional)</label>
                    <textarea name="equipamiento_explicacion" placeholder="Explicación general para los items"></textarea>
                </div>

                <div class="form-row-full field">
                    <label>Items (separados por comas)</label>
                    <textarea name="equipamiento_items" placeholder="Botas, Chaqueta impermeable, Linterna"></textarea>
                </div>

                <div class="form-row-full actions" style="margin-top:8px">
                    <a href="{{ route('experiencias.index') }}" class="btn" style="background:transparent;color:var(--andino);border:1px solid rgba(30,95,140,0.08);padding:10px 14px;border-radius:8px;">Cerrar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
