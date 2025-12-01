@props(['community'])

<div class="community-card" data-aos="zoom-in" data-community="{{ $community->comunidad_id ?? $community->id ?? '' }}">
    <div class="card-image">
        <img src="{{ $community->imagen ?? 'https://images.unsplash.com/photo-1501594907352-04cda38ebc29?w=800' }}" alt="{{ $community->nombre ?? $community->name }}" loading="lazy">
    </div>
    <div class="card-content">
        <h3>{{ $community->nombre ?? $community->name }}</h3>
        <p class="card-description">{{ Str::limit($community->descripcion ?? $community->description ?? '', 120) }}</p>
        <div class="card-footer">
            <a href="{{ route('comunidades.show', $community->comunidad_id ?? $community->id) }}" class="btn btn-outline">Ver comunidad</a>
        </div>
    </div>
</div>
