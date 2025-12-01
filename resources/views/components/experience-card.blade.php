@props(['experience','delay' => 0])

<div class="experience-card" data-aos="zoom-in" data-aos-delay="{{ $delay }}" data-type="{{ $experience->tipo_actividad ?? $experience->type ?? 'trekking' }}" data-community="{{ $experience->comunidad_id ?? $experience->community_id ?? '' }}">
    <div class="card-image">
        <img src="{{ $experience->imagen ?? 'https://images.unsplash.com/photo-1483728642387-6c3bdd6c93e5?w=600' }}" alt="{{ $experience->nombre ?? $experience->title }}" loading="lazy">
        <div class="card-badge">{{ $experience->tipo_actividad ?? ucfirst($experience->type ?? 'Trekking') }}</div>
    </div>
    <div class="card-content">
        <h3>{{ $experience->nombre ?? $experience->title }}</h3>
        <p class="card-community">📍 {{ $experience->comunidad->nombre ?? $experience->community->name ?? ($experience->community_name ?? '') }}</p>
        <p class="card-description">{{ Str::limit($experience->descripcion_corta ?? $experience->description ?? '', 120) }}</p>
        <div class="card-footer">
            <div class="card-price">
                <span class="price-label">Desde</span>
                <span class="price-amount">{{ $experience->precio_bs ?? $experience->price ?? '0' }} Bs.</span>
            </div>
            <a href="{{ route('experiencias.show', $experience->experiencia_id ?? $experience->id) }}" class="btn btn-primary btn-sm">Ver Detalles</a>
        </div>
    </div>
</div>
