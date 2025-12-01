@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Comunidades</h1>
    @if(session('admin_id'))
        <a href="{{ route('comunidades.create') }}">Crear comunidad</a>
    @endif
    <div class="comunidades-grid" data-animate="fade-in-up">
        @foreach($comunidades as $comunidad)
        <div class="comunidad-card card animate-on-scroll" data-animate="scale-in">
            <div class="image-container">
                @if($comunidad->imagen_representativa)
                    <img src="{{ $comunidad->imagen_representativa }}" alt="{{ $comunidad->nombre }}">
                @else
                    <img src="/images/placeholder-comunidad.jpg" alt="{{ $comunidad->nombre }}">
                @endif
                <div class="image-overlay"></div>
            </div>
            <div class="card-content">
                <h3><a href="{{ route('comunidades.show', $comunidad) }}">{{ $comunidad->nombre }}</a></h3>
                <p>{{ \Illuminate\Support\Str::limit($comunidad->descripcion, 120) }}</p>
                <div class="card-actions">
                    <a href="{{ route('comunidades.show', $comunidad) }}" class="btn btn-secondary">Ver más</a>
                    @if(session('admin_id'))
                        <a href="{{ route('comunidades.edit', $comunidad) }}">Editar</a>
                        |
                        @php $label = $comunidad->estado === 'activa' ? 'Desactivar' : 'Activar'; @endphp
                        <a href="{{ route('comunidades.desactivar', $comunidad) }}">{{ $label }}</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
