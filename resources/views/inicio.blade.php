@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bienvenidos a Sorata Pacha</h1>
    <p>Explora comunidades y experiencias turísticas. Reserva sin necesidad de iniciar sesión.</p>
    <p><a href="{{ route('comunidades.index') }}">Ver comunidades</a> | <a href="{{ route('experiencias.index') }}">Ver experiencias</a></p>
    <p><a href="{{ route('reservas.create') }}">Realizar una reserva</a></p>

    @if(isset($reservas) && $reservas->count())
    <h2>Reservas recientes</h2>
    <ul>
        @foreach($reservas as $r)
            <li>
                <strong>{{ $r->nombre_completo }}</strong> — {{ optional($r->experiencia)->nombre ?? 'Experiencia' }}
                @if(isset($r->fecha_experiencia)) | Fecha: {{ $r->fecha_experiencia }} @endif
            </li>
        @endforeach
    </ul>
    @endif
</div>
@endsection
