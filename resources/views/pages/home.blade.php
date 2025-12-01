@extends('layouts.app')

@section('title','Sorata Adventures')

@section('content')
    <x-hero />

    <section class="features" style="background:#F8F9FA;padding:100px 0;">
        <div class="container grid-3">
            <x-feature-card icon="🏔️" title="Montañas Épicas" text="Descubre rutas ancestrales y vistas impresionantes." />
            <x-feature-card icon="🌿" title="Naturaleza Única" text="Fauna y flora de los Yungas y zonas altoandinas." />
            <x-feature-card icon="🎒" title="Aventura Total" text="Trekking, acampe y experiencias culturales." />
        </div>
    </section>

    <section class="content-section" data-aos="fade-up" style="padding:100px 0;">
        <div class="container two-col">
            <div class="col text">
                <h2>Explora Sorata</h2>
                <p>Una región cargada de tradición, paisajes y aventuras únicas en Bolivia.</p>
            </div>
            <div class="col media">
                <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800" alt="Montañas" loading="lazy">
            </div>
        </div>
    </section>

    <section class="content-section" data-aos="fade-up" style="padding:100px 0;background:#fff;">
        <div class="container two-col reverse">
            <div class="col media">
                <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=800" alt="Cultura" loading="lazy">
            </div>
            <div class="col text">
                <h2>Conecta con la cultura local</h2>
                <p>Interactúa con comunidades locales y aprende de sus tradiciones.</p>
            </div>
        </div>
    </section>

    <section class="tours" data-aos="fade-up" style="padding:100px 0;background:#F8F9FA;">
        <div class="container">
            <h2 class="section-title">Nuestros Tours</h2>
            <div class="grid-3">
                @php $list = $experiencias ?? $experiences ?? collect(); @endphp
                @forelse($list as $experiencia)
                    <x-tour-card
                        :title="$experiencia->title ?? $experiencia->nombre ?? $experiencia->name ?? 'Tour'"
                        :price="$experiencia->price ?? $experiencia->precio ?? 0"
                        :description="$experiencia->description ?? $experiencia->descripcion ?? ($experiencia->summary ?? '')"
                        :image="$experiencia->imagen ?? $experiencia->image ?? ($experiencia->foto ?? 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=600')"
                        :experienceId="$experiencia->id ?? $experiencia->experience_id ?? null"
                    />
                @empty
                    <div class="center" style="padding:40px 0;color:var(--gris-piedra);">
                        <p>No hay tours disponibles en este momento. Por favor, revisa más tarde.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="testimonials" data-aos="fade-up" style="padding:80px 0;">
        <div class="container center">
            <x-testimonial quote="Una experiencia inolvidable—las montañas son espectaculares." avatar="https://i.pravatar.cc/150?img=32" name="María" from="La Paz" />
        </div>
    </section>

    <section class="cta-final" data-aos="fade-up" style="padding:80px 0;background:linear-gradient(135deg,#1E5F8C 0%,#2D7A4F 100%);">
        <div class="container center white">
            <h2>¿Listo Para Tu Próxima Aventura?</h2>
            <a href="{{ route('contact') }}" class="btn btn-cta">Comencemos</a>
        </div>
    </section>

@endsection
