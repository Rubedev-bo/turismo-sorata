@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel Administrador</h1>
    <ul>
        <li><a href="{{ route('reservas.admin') }}">Gestionar Reservas</a></li>
        <li><a href="{{ route('comunidades.index') }}">Gestionar Comunidades</a></li>
        <li><a href="{{ route('experiencias.index') }}">Gestionar Experiencias</a></li>
    </ul>
</div>
@endsection
