@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $comunidad->nombre }}</h1>
    <p>{{ $comunidad->descripcion }}</p>
    <p>Contacto: {{ $comunidad->contacto_email }} - {{ $comunidad->contacto_telefono }}</p>

    <h3>Experiencias</h3>
    <ul>
        @foreach($comunidad->experiencias as $exp)
            <li>
                <a href="{{ route('experiencias.show', $exp->experiencia_id) }}">{{ $exp->nombre }}</a> ({{ $exp->estado }})
                @if($exp->reservas && $exp->reservas->count())
                    <ul>
                        @foreach($exp->reservas as $r)
                            <li>{{ $r->nombre_completo }} - {{ $r->fecha_experiencia }} - Estado: {{ $r->estado }}</li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>

    <p><a href="{{ route('reservas.create') }}?comunidad_id={{ $comunidad->comunidad_id }}">Reservar en esta comunidad</a></p>

    @if(isset($climas) && $climas->count())
        <h3>Información climática</h3>
        @foreach($climas as $cl)
            <div style="border:1px solid #ccc;padding:8px;margin-bottom:8px;">
                <strong>Tipo:</strong> {{ $cl->tipo_experiencia }}<br>
                <strong>Temporada:</strong> {{ $cl->temporada }}<br>
                <strong>Temp. promedio:</strong> {{ $cl->temp_min_promedio }} - {{ $cl->temp_max_promedio }} °C<br>
                <p>{{ $cl->recomendacion_vestimenta }}</p>
            </div>
        @endforeach
    @endif
</div>
@endsection
