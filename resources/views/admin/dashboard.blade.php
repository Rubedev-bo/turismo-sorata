@extends('layouts.admin')

@section('title','Dashboard Admin')

@section('content')
<div class="admin-header">
    <h1>Dashboard</h1>
    <p>Resumen y accesos rápidos.</p>
</div>

<div class="admin-actions" style="padding:20px 0;">
    <div class="container grid-3">
        <div class="feature-card center">
            <h3>Comunidades</h3>
            <p>Crear o editar comunidades donde operamos.</p>
            <div style="margin-top:12px">
                <a href="{{ route('comunidades.create') }}" class="btn btn-primary">Crear Comunidad</a>
                <a href="{{ route('comunidades.index') }}" class="btn btn-secondary">Ver Comunidades</a>
            </div>
        </div>

        <div class="feature-card center">
            <h3>Experiencias</h3>
            <p>Agregar nuevas experiencias y gestionar precios.</p>
            <div style="margin-top:12px">
                <a href="{{ route('experiencias.create') }}" class="btn btn-primary">Crear Experiencia</a>
                <a href="{{ route('experiencias.index') }}" class="btn btn-secondary">Ver Experiencias</a>
            </div>
        </div>

        <div class="feature-card center">
            <h3>Reservas</h3>
            <p>Ver y gestionar reservas recibidas.</p>
            <div style="margin-top:12px">
                <a href="{{ route('reservas.create') }}" class="btn btn-primary">Crear Reserva</a>
                <a href="{{ route('reservas.admin') }}" class="btn btn-secondary">Panel Reservas</a>
            </div>
        </div>
    </div>
</div>

@endsection
