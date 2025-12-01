@extends('layouts.app')

@section('title', $comunidad->nombre ?? 'Comunidad')

@section('content')
<section class="community-hero" style="padding:60px 0;">
    <div class="container">
        <h1 data-aos="fade-up">{{ $comunidad->nombre }}</h1>
        <p data-aos="fade-up" data-aos-delay="100">{{ $comunidad->descripcion }}</p>
        <div class="community-experiences" style="margin-top:24px;">
            <h3 data-aos="fade-up">Experiencias en esta comunidad</h3>
            <div class="experiences-grid" style="margin-top:16px;">
                @foreach($comunidad->experiencias as $exp)
                    <x-experience-card :experience="$exp" />
                @endforeach
            </div>
        </div>

        @if(isset($climas) && $climas->count())
            <div class="climate-info" style="margin-top:32px;" data-aos="fade-up">
                <h3>Información climática</h3>
                @foreach($climas as $cl)
                    <div class="climate-card">
                        <h4>{{ $cl->temporada }} — {{ $cl->tipo_experiencia }}</h4>
                        <p>{{ $cl->recomendacion_vestimenta }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
