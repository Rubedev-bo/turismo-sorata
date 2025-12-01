@extends('layouts.app')

@section('title','Experiencias - Sorata')

@section('content')
<section class="page-top" style="padding:60px 0;">
    <div class="container">
        <h1 data-aos="fade-down">Experiencias</h1>
        <p data-aos="fade-down" data-aos-delay="100">Filtra y encuentra la experiencia perfecta.</p>

        @include('components.filter-bar', ['comunidades' => $comunidades ?? $communities ?? null, 'experiences' => $experiences])

        <div class="experiences-grid" style="margin-top:24px;">
            @foreach($experiences as $exp)
                <x-experience-card :experience="$exp" />
            @endforeach
        </div>
    </div>
</section>
@endsection
