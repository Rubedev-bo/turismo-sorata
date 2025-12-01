@extends('layouts.app')

@section('title','Equipamiento - Sorata')

@section('content')
<section class="equipment-section" style="padding:60px 0;">
    <div class="container">
        <h1 data-aos="fade-up">¿Qué Llevar?</h1>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Equipamiento recomendado según tu tipo de actividad</p>

        <div class="activity-tabs" data-aos="fade-up" data-aos-delay="200">
            <button class="tab-btn active" data-tab="trekking">🥾 Trekking</button>
            <button class="tab-btn" data-tab="hospedaje">🏠 Hospedaje</button>
            <button class="tab-btn" data-tab="cultural">🎭 Cultural</button>
        </div>

        <div class="tab-content active" id="trekking">
            <div class="equipment-grid">
                <div class="equipment-category essential" data-aos="zoom-in">
                    <div class="category-header"><span class="category-icon">⚠️</span><h3>ESENCIAL</h3></div>
                    <ul class="equipment-list">
                        <li><strong>Botiquín básico</strong><p>Indispensable por distancia de centros médicos</p></li>
                        <li><strong>Botas de trekking</strong><p>Terreno irregular requiere buen soporte</p></li>
                        <li><strong>Protector solar SPF 50+</strong><p>Radiación UV alta en altitud</p></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
