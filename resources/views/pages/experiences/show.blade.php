@extends('layouts.app')

@section('title', $experience->nombre ?? 'Experiencia')

@section('content')
<section class="experience-hero" style="padding:60px 0;">
    <div class="container">
        <div class="two-col" data-aos="fade-up">
            <div class="col media">
                <img src="{{ $experience->imagen ?? 'https://images.unsplash.com/photo-1483728642387-6c3bdd6c93e5?w=600' }}" alt="{{ $experience->nombre }}" loading="lazy">
            </div>
            <div class="col text">
                <h1>{{ $experience->nombre }}</h1>
                <p>{{ $experience->descripcion_corta ?? $experience->description ?? '' }}</p>
                <p><strong>Precio:</strong> {{ $experience->precio_bs ?? $experience->price }} Bs.</p>
                <p><strong>Comunidad:</strong> {{ $experience->comunidad->nombre ?? $experience->community->name ?? '' }}</p>
                <a href="{{ route('reservas.create') }}?experiencia_id={{ $experience->experiencia_id ?? $experience->id }}" class="btn btn-primary">Reservar</a>
            </div>
        </div>

        @if(isset($climas) && $climas->count())
            <div class="climate-section" style="margin-top:32px;" data-aos="fade-up">
                <h3>Información climática</h3>
                @foreach($climas as $cl)
                    <div class="climate-card">
                        <h4>{{ $cl->temporada }}</h4>
                        <p>{{ $cl->recomendacion_vestimenta }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
