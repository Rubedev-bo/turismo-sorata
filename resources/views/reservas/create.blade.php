@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Reserva</h1>
    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservas.store') }}" method="POST" id="reservationForm">
        @csrf
        @if(!empty($experienciaId) && $experiencias->count())
            {{-- Reserva iniciada desde una experiencia: ocultar selector y enviar hidden --}}
            <input type="hidden" name="experiencia_id" value="{{ $experienciaId }}">
            <p>Reservando: <strong>{{ $experiencias->first()->nombre }}</strong></p>
            <div class="summary-price"><span>Precio por persona:</span> <strong>{{ $experiencias->first()->precio_bs ?? $experiencias->first()->price ?? 0 }} Bs.</strong></div>
        @else
            <div>
                <label>Comunidad (opcional)</label>
                <select name="comunidad_id" id="comunidad_select">
                    <option value="">-- Seleccione comunidad --</option>
                    @if(isset($comunidades))
                        @foreach($comunidades as $c)
                            <option value="{{ $c->comunidad_id }}" @if(!empty($comunidadId) && $comunidadId == $c->comunidad_id) selected @endif>{{ $c->nombre }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div>
                <label>Experiencia</label>
                <select name="experiencia_id" id="experiencia_select" required>
                    <option value="">Seleccione experiencia</option>
                    @foreach($experiencias as $exp)
                        <option value="{{ $exp->experiencia_id }}" data-precio="{{ $exp->precio_bs }}">{{ $exp->nombre }} - {{ $exp->precio_bs }} bs</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div>
            <label>Fecha experiencia</label>
            <input type="date" name="fecha_experiencia" required min="{{ date('Y-m-d') }}">
        </div>
        <div>
            <label>Numero adultos</label>
            <input type="number" id="adults" name="numero_adultos" value="1" min="0" required>
        </div>
        <div>
            <label>Numero ninos</label>
            <input type="number" id="children" name="numero_ninos" value="0" min="0">
        </div>
        <div>
            <label>Tipo de habitación</label>
            <select name="tipo_habitacion">
                <option value="Simple">Simple</option>
                <option value="Doble">Doble</option>
                <option value="Triple">Triple</option>
            </select>
        </div>
        <div>
            <label>Servicios adicionales</label>
            <div>
                <label><input type="checkbox" name="servicios[]" value="Transporte"> Transporte</label>
                <label><input type="checkbox" name="servicios[]" value="Comidas"> Comidas</label>
                <label><input type="checkbox" name="servicios[]" value="Guia"> Guía</label>
            </div>
        </div>
        <div>
            <label>Nombre completo</label>
            <input type="text" name="nombre_completo" required>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Telefono</label>
            <input type="text" name="telefono" required>
        </div>
        <div>
            <label><input type="checkbox" name="terminos" value="1" required> Acepto términos y condiciones</label>
        </div>
        <button type="submit">Reservar</button>
    </form>

@section('scripts')
<script>
    // Si se cambia la comunidad, recargar la página con query param para filtrar experiencias.
    document.getElementById('comunidad_select')?.addEventListener('change', function(e){
        var comunidadId = e.target.value;
        var url = new URL(window.location.href);
        if (comunidadId) url.searchParams.set('comunidad_id', comunidadId); else url.searchParams.delete('comunidad_id');
        window.location.href = url.toString();
    });

    // Actualizar precio mostrado cuando se selecciona una experiencia
    var expSelect = document.getElementById('experiencia_select');
    var summaryPriceEl = document.querySelector('.summary-price strong');
    function updatePriceFromSelect(){
        if(!expSelect) return;
        var opt = expSelect.selectedOptions[0];
        if(!opt) return;
        var precio = opt.dataset.precio || opt.getAttribute('data-precio') || '';
        if(precio && summaryPriceEl) summaryPriceEl.textContent = precio + ' Bs.';
    }
    expSelect?.addEventListener('change', updatePriceFromSelect);
    updatePriceFromSelect();
</script>
@endsection
</div>
@endsection
