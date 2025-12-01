@props(['title','price','description','image','experienceId' => null])

<article class="tour-card" data-aos="zoom-in">
    <div class="tour-media">
        <img src="{{ $image }}" alt="{{ $title }}" loading="lazy">
    </div>
    <div class="tour-body">
        <h3 class="tour-title">{{ $title }}</h3>
        <p class="tour-price">${{ $price }}</p>
        <p class="tour-desc">{{ $description }}</p>
        @if($experienceId)
            <a href="{{ route('reservas.create') }}?experiencia_id={{ $experienceId }}" class="btn btn-primary">Reservar</a>
        @else
            <a href="{{ route('reservas.create') }}" class="btn btn-primary">Reservar</a>
        @endif
    </div>
</article>
