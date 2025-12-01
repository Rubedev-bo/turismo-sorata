@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Experiencias</h1>
    @if(session('admin_id'))
        <a href="{{ route('experiencias.create') }}">Crear experiencia</a>
    @endif
    <form method="GET" action="{{ route('experiencias.filter') }}">
        <input type="text" name="tipo_actividad" placeholder="Tipo actividad" value="{{ request('tipo_actividad') }}">
        <button type="submit">Filtrar</button>
    </form>
    <div class="experiencias-grid" data-animate="fade-in-up">
        @foreach($experiencias as $exp)
        <div class="experiencia-card card animate-on-scroll" data-animate="scale-in">
            <div class="image-container">
                @if($exp->imagen_principal)
                    <img src="{{ $exp->imagen_principal }}" alt="{{ $exp->nombre }}">
                @else
                    <img src="/images/placeholder-experiencia.jpg" alt="{{ $exp->nombre }}">
                @endif
                <div class="image-overlay"></div>
            </div>
            <div class="card-content">
                <h3><a href="{{ route('experiencias.show', $exp->experiencia_id) }}">{{ $exp->nombre }}</a></h3>
                <p>{{ $exp->precio_bs }} bs @if(session('admin_id')) - {{ $exp->estado }} @endif</p>
                <div class="card-actions">
                    <a href="{{ route('experiencias.show', $exp->experiencia_id) }}" class="btn btn-secondary">Ver más</a>
                    @if(session('admin_id'))
                        <a href="{{ route('experiencias.edit', $exp->experiencia_id) }}">Editar</a>
                        |
                        @php $toggleLabel = $exp->estado === 'activa' ? 'Desactivar' : 'Activar'; @endphp
                        <a href="{{ route('experiencias.desactivar', $exp->experiencia_id) }}">{{ $toggleLabel }}</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
