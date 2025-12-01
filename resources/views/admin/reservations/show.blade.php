@extends('layouts.admin')

@section('title','Detalle Reserva')

@section('content')
<div class="admin-header">
    <h1>Detalle de Reserva</h1>
    <a href="{{ route('reservas.admin') }}" class="btn btn-outline">Volver</a>
</div>

<div class="admin-table-container">
    <h3>Reserva #{{ $reservation->numero_reserva ?? $reservation->id }}</h3>
    <p><strong>Turista:</strong> {{ $reservation->nombre_completo ?? $reservation->name }}</p>
    <p><strong>Email:</strong> {{ $reservation->email }}</p>
    <p><strong>Teléfono:</strong> {{ $reservation->telefono ?? $reservation->phone }}</p>
    <p><strong>Experiencia:</strong> {{ $reservation->experiencia->nombre ?? $reservation->experience->name }}</p>
    <p><strong>Fecha:</strong> {{ optional($reservation->fecha_experiencia ?? $reservation->date)->format('d/m/Y') }}</p>
    <p><strong>Personas:</strong> {{ ($reservation->numero_adultos ?? 0) + ($reservation->numero_ninos ?? 0) }}</p>
    <p><strong>Estado:</strong> <span class="status-badge status-{{ $reservation->estado ?? $reservation->status }}">{{ ucfirst($reservation->estado ?? $reservation->status) }}</span></p>
</div>

@endsection
