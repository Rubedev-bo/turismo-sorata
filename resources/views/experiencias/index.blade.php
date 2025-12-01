@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Experiencias</h1>
    @if(session('admin_id'))
        <a href="{{ route('experiencias.create') }}">Crear experiencia</a>
    @endif
    <form method="GET" action="{{ route('experiencias.filter') }}">
        <input type="text" name="tipo_actividad" placeholder="Tipo actividad" value="{{ request('tipo_actividad') }}">
        <button type="submit">Filtrar</button>
    </form>
    <ul>
        @foreach($experiencias as $exp)
            <li>
                <a href="{{ route('experiencias.show', $exp->experiencia_id) }}">{{ $exp->nombre }}</a>
                - {{ $exp->precio_bs }} bs
                - {{ $exp->estado }}
                @if(session('admin_id'))
                    - <a href="{{ route('experiencias.edit', $exp->experiencia_id) }}">Editar</a>
                    | <a href="{{ route('experiencias.desactivar', $exp->experiencia_id) }}">Desactivar</a>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection
