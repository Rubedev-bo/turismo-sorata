@extends('layouts.app')

@section('content')
<div class="container">
    @if($experiencia->imagen_principal)
        <div class="image-container" data-animate="parallax">
            <img src="{{ $experiencia->imagen_principal }}" alt="{{ $experiencia->nombre }}">
            <div class="image-overlay"></div>
        </div>
    @endif
    <h1>{{ $experiencia->nombre }}</h1>
    <p>{{ $experiencia->descripcion_corta }}</p>
    <p>Precio: {{ $experiencia->precio_bs }} bs</p>
    <p>Tipo: {{ $experiencia->tipo_actividad }}</p>
    @if(session('admin_id'))
        <p>Estado: {{ $experiencia->estado }}</p>
    @endif
    @if(session('admin_id'))
        <h3>Reservas para esta experiencia</h3>
        @if($experiencia->reservas && $experiencia->reservas->count())
            <ul>
                @foreach($experiencia->reservas as $r)
                    <li>{{ $r->nombre_completo }} - {{ $r->fecha_experiencia }} @if(session('admin_id')) - Estado: {{ $r->estado }} @endif</li>
                @endforeach
            </ul>
        @else
            <p>No hay reservas para esta experiencia.</p>
        @endif

        <h3>Reservar esta experiencia</h3>
        <form action="{{ route('reservas.store') }}" method="POST" class="centered-form" data-animate="fade-in-up">
            @csrf
            <input type="hidden" name="experiencia_id" value="{{ $experiencia->experiencia_id }}">
            <div>
                <label>Fecha experiencia</label>
                <input type="date" name="fecha_experiencia" required min="{{ date('Y-m-d') }}">
            </div>
            <div>
                <label>Numero adultos</label>
                <input type="number" name="numero_adultos" value="1" min="0" required>
            </div>
            <div>
                <label>Numero ninos</label>
                <input type="number" name="numero_ninos" value="0" min="0">
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
            <button type="submit" class="btn btn-primary">Reservar</button>
        </form>
    @endif

    @if(isset($climas) && $climas->count())
        <h3>Información climática</h3>
        @foreach($climas as $cl)
            <div style="border:1px solid #ccc;padding:8px;margin-bottom:8px;">
                <strong>Temporada:</strong>
                @if($cl->temporada == 'seca') Temporada seca
                @elseif($cl->temporada == 'humeda') Temporada húmeda
                @else {{ $cl->temporada }} @endif<br>
                <strong>Mejor época:</strong>
                    {{ $cl->mejor_epoca ? 'Sí' : 'No' }}<br>
                <p>{{ $cl->recomendacion_vestimenta }}</p>
            </div>
        @endforeach
    @endif
</div>
@endsection
