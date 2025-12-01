@extends('layouts.app')

@section('content')
<div class="hero-section" data-parallax="0.12">
    <div class="container">
        <h1 data-animate="typewriter">Descubre la Magia de Sorata</h1>
        <p class="lead" data-animate="fade-in">Explora tours, comunidades y experiencias en Sorata, La Paz, Bolivia.</p><br>
        <div class="hero-cta" data-animate="slide-up">
            <a href="{{ route('experiencias.index') }}" class="btn btn-primary">Explorar Tours</a>
        </div>
    </div>
</div>

{{-- <div class="container" data-animate="fade-in-up">
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
</div> --}}
@endsection
