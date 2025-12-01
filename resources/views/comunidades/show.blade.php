@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $comunidad->nombre }}</h1>
    @if($comunidad->imagen_representativa)
        <div class="image-container" data-animate="fade-in">
            <img src="{{ $comunidad->imagen_representativa }}" alt="{{ $comunidad->nombre }}">
            <div class="image-overlay"></div>
        </div>
    @endif
    <p>{{ $comunidad->descripcion }}</p>
    <p>Contacto: {{ $comunidad->contacto_email }} - {{ $comunidad->contacto_telefono }}</p>

    <h3>Experiencias</h3>
    <ul>
        @foreach($comunidad->experiencias as $exp)
            <li>
                <a href="{{ route('experiencias.show', $exp->experiencia_id) }}">{{ $exp->nombre }}</a>
                @if(session('admin_id')) ({{ $exp->estado }}) @endif
                @if($exp->reservas && $exp->reservas->count())
                    <ul>
                        @foreach($exp->reservas as $r)
                            <li>{{ $r->nombre_completo }} - {{ $r->fecha_experiencia }} @if(session('admin_id')) - Estado: {{ $r->estado }} @endif</li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>

    <p><a href="{{ route('reservas.create') }}?comunidad_id={{ $comunidad->comunidad_id }}" class="btn btn-primary">Reservar en esta comunidad</a></p>

    @if(isset($climas) && $climas->count())
        <h3>Información climática</h3>
        @foreach($climas as $cl)
            <div style="border:1px solid #ccc;padding:8px;margin-bottom:8px;">
                <strong>Tipo:</strong> {{ $cl->tipo_experiencia }}<br>
                <strong>Temporada:</strong>
                @if($cl->temporada == 'seca') Temporada seca
                @elseif($cl->temporada == 'humeda') Temporada húmeda
                @else {{ $cl->temporada }} @endif<br>
                <strong>Temp. promedio:</strong> {{ $cl->temp_min_promedio }} - {{ $cl->temp_max_promedio }} °C<br>
                <strong>Mejor época:</strong> {{ $cl->mejor_epoca ? 'Sí' : 'No' }}<br>
                <p>{{ $cl->recomendacion_vestimenta }}</p>
            </div>
        @endforeach
    @endif
</div>
@endsection
