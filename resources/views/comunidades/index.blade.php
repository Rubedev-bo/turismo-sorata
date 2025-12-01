@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Comunidades</h1>
    @if(session('admin_id'))
        <a href="{{ route('comunidades.create') }}">Crear comunidad</a>
    @endif
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comunidades as $comunidad)
            <tr>
                <td><a href="{{ route('comunidades.show', $comunidad->comunidad_id) }}">{{ $comunidad->nombre }}</a></td>
                <td>{{ $comunidad->estado }}</td>
                <td>
                    @if(session('admin_id'))
                        <a href="{{ route('comunidades.edit', $comunidad->comunidad_id) }}">Editar</a>
                        |
                        <a href="{{ route('comunidades.desactivar', $comunidad->comunidad_id) }}">Desactivar</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
