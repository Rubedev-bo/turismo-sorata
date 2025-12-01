@extends('layouts.app')

@section('title','Tours - Sorata Adventures')

@section('content')
    <section class="page-top" style="padding:80px 0;">
        <div class="container">
            <h1>Tours</h1>
            <p>Explora todos nuestros tours disponibles.</p>
        </div>
    </section>

    <section class="tours-grid" style="padding:80px 0;">
        <div class="container grid-3">
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
    </section>

@endsection
