@extends('layouts.app')

@section('title','Clima - Sorata')

@section('content')
<section class="climate-section" style="padding:60px 0;">
    <div class="container">
        <h1 data-aos="fade-up">Información Climática</h1>
        <p data-aos="fade-up" data-aos-delay="100">Datos y recomendaciones según temporada y tipo de experiencia.</p>

        @if(isset($climates) && $climates->count())
            <div class="climate-grid" style="margin-top:24px;">
                @foreach($climates as $cl)
                    <div class="climate-card" data-aos="fade-up">
                        <h3>{{ $cl->tipo_experiencia }} — {{ $cl->temporada }}</h3>
                        <p><strong>Mejor época:</strong> {{ $cl->mejor_epoca }}</p>
                        <p>{{ $cl->recomendacion_vestimenta }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p data-aos="fade-up">No hay información climática disponible.</p>
        @endif
    </div>
</section>
@endsection
