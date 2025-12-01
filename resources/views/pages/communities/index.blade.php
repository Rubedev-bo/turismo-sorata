@extends('layouts.app')

@section('title','Comunidades - Sorata')

@section('content')
<section class="page-top" style="padding:60px 0;">
    <div class="container">
        <h1 data-aos="fade-down">Comunidades</h1>
        <p data-aos="fade-down" data-aos-delay="100">Explora las comunidades que forman parte de nuestras experiencias.</p>
        <div class="communities-grid" style="margin-top:24px;" data-aos="fade-up">
            @foreach($communities as $community)
                <x-community-card :community="$community" />
            @endforeach
        </div>
    </div>
</section>
@endsection
