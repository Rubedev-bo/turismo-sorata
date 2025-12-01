@extends('layouts.app')

@section('title','Reserva Confirmada')

@section('content')
<section class="reservation-success" style="padding:60px 0;">
    <div class="container center" data-aos="fade-up">
        <h1>¡Reserva Confirmada!</h1>
        <p>Tu reserva con número <strong>#{{ $id ?? '---' }}</strong> fue registrada correctamente. Te hemos enviado un correo de confirmación (si se proporcionó email).</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Volver al Inicio</a>
    </div>
</section>
@endsection
