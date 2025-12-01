@props(['title' => 'Descubre la Magia de Sorata','subtitle' => 'Explora tours, comunidades y experiencias en Sorata, La Paz, Bolivia.','image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1600'])

<section class="hero" style="background-image: url('{{ $image }}');" data-aos="fade-up">
    <div class="hero-overlay"></div>
    <div class="container hero-inner">
        <h1 class="hero-title">{{ $title }}</h1>
        <p class="hero-sub">{{ $subtitle }}</p>
        <div class="hero-cta">
            <a href="{{ route('tours') }}" class="btn btn-primary">Explorar Tours</a>
            <a href="{{ route('contact') }}" class="btn btn-secondary">Contáctanos</a>
        </div>
    </div>
</section>
