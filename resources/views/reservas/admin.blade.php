@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel de Reservas</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Experiencia</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservas as $res)
            <tr>
                <td>{{ $res->reserva_id }}</td>
                <td>{{ $res->nombre_completo }} ({{ $res->email }})</td>
                <td>{{ optional($res->experiencia)->nombre }}</td>
                <td>{{ $res->fecha_experiencia }}</td>
                <td>{{ $res->estado }}</td>
                <td>
                    <form action="{{ route('reservas.updateEstado', $res->reserva_id) }}" method="POST" style="display:inline">
                        @csrf
                        <select name="estado">
                            <option value="pendiente" {{ $res->estado=='pendiente' ? 'selected' : '' }}>pendiente</option>
                            <option value="confirmada" {{ $res->estado=='confirmada' ? 'selected' : '' }}>confirmada</option>
                            <option value="cancelada" {{ $res->estado=='cancelada' ? 'selected' : '' }}>cancelada</option>
                        </select>
                        <button type="submit">Actualizar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $reservas->links() }}
</div>
@endsection
