@extends('layouts.app')

@section('title','Cómo Llegar - Sorata')

@section('content')
<section class="guide-hero" style="background-image: url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1600');">
    <div class="hero-overlay"></div>
    <div class="hero-content" data-aos="fade-up">
        <h1>¿Cómo Llegar a Sorata?</h1>
        <p>Guía completa para tu viaje desde La Paz</p>
    </div>
</section>

<section class="route-section" style="padding:60px 0;">
    <div class="container">
        <div class="route-step" data-aos="fade-right">
            <div class="step-number">1</div>
            <div class="step-content">
                <h2>La Paz → Sorata</h2>
                <div class="transport-options">
                    <div class="transport-card">
                        <h4>🚌 Buses</h4>
                        <p><strong>Salida:</strong> Terminal de buses La Paz</p>
                        <p><strong>Duración:</strong> 4-5 horas</p>
                    </div>
                    <div class="transport-card">
                        <h4>🚐 Minibuses</h4>
                        <p><strong>Duración:</strong> 3.5-4 horas</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="route-step" data-aos="fade-left">
            <div class="step-number">2</div>
            <div class="step-content">
                <h2>Sorata → Comunidades</h2>
                <div class="communities-selector">
                    <select id="communitySelect" class="form-control">
                        <option value="">Selecciona una comunidad</option>
                        @foreach($comunidades ?? $communities ?? [] as $community)
                            <option value="{{ $community->comunidad_id ?? $community->id }}">{{ $community->nombre ?? $community->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="communityInfo" class="community-route-info" style="display:none"></div>
            </div>
        </div>
    </div>
</section>
@endsection
