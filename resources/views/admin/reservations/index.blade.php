@extends('layouts.admin')

@section('title','Gestión de Reservas')

@section('content')
<div class="admin-header">
    <h1>Gestión de Reservas</h1>
    <div class="admin-stats">
        <div class="stat-card"><span class="stat-icon">⏳</span><div><strong>{{ $pendingCount ?? 0 }}</strong><p>Pendientes</p></div></div>
        <div class="stat-card"><span class="stat-icon">✅</span><div><strong>{{ $confirmedCount ?? 0 }}</strong><p>Confirmadas</p></div></div>
        <div class="stat-card"><span class="stat-icon">🎉</span><div><strong>{{ $completedCount ?? 0 }}</strong><p>Completadas</p></div></div>
    </div>
</div>

<div class="admin-filters">
    <form method="GET" action="{{ route('reservas.admin') }}" class="filters-form">
        <div class="filter-item"><label>Estado:</label>
            <select name="status" class="form-control">
                <option value="">Todos</option>
                <option value="pendiente" {{ request('status')=='pendiente'?'selected':'' }}>Pendiente</option>
                <option value="confirmada" {{ request('status')=='confirmada'?'selected':'' }}>Confirmada</option>
                <option value="cancelada" {{ request('status')=='cancelada'?'selected':'' }}>Cancelada</option>
                <option value="completada" {{ request('status')=='completada'?'selected':'' }}>Completada</option>
            </select>
        </div>
        <div class="filter-item"><label>Desde:</label><input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}"></div>
        <div class="filter-item"><label>Hasta:</label><input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}"></div>
        <div><button type="submit" class="btn btn-primary">Filtrar</button> <a href="{{ route('reservas.admin') }}" class="btn btn-outline">Limpiar</a></div>
    </form>
</div>

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr><th>Nº Reserva</th><th>Fecha</th><th>Turista</th><th>Experiencia</th><th>Personas</th><th>Estado</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr>
                    <td class="reservation-number">{{ $reservation->numero_reserva ?? $reservation->number ?? '' }}</td>
                    <td>{{ optional($reservation->fecha_experiencia ?? $reservation->date)->format('d/m/Y') ?? '' }}</td>
                    <td><strong>{{ $reservation->nombre_completo ?? $reservation->name }}</strong><br><small>{{ $reservation->email }}</small></td>
                    <td>{{ $reservation->experiencia->nombre ?? $reservation->experience->name ?? '' }}</td>
                    <td>{{ ($reservation->numero_adultos ?? 0) + ($reservation->numero_ninos ?? 0) }}</td>
                    <td><span class="status-badge status-{{ $reservation->estado ?? $reservation->status }}">{{ ucfirst($reservation->estado ?? $reservation->status) }}</span></td>
                    <td class="actions-cell">
                        <a href="{{ route('reservas.admin') }}?show={{ $reservation->reserva_id ?? $reservation->id }}" class="btn-icon">👁️</a>
                        <button class="btn-icon" onclick="openStatusModal({{ $reservation->reserva_id ?? $reservation->id }}, '{{ $reservation->estado ?? $reservation->status }}')">✏️</button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">No hay reservas registradas</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $reservations->links() ?? '' }}
</div>

<div id="statusModal" class="modal"><div class="modal-content"><span class="modal-close" onclick="closeStatusModal()">&times;</span>
    <h3>Cambiar Estado de Reserva</h3>
    <form id="statusForm" method="POST">
        @csrf
        <div class="form-group"><label>Nuevo Estado:</label>
            <select name="status" id="newStatus" class="form-control"><option value="pendiente">Pendiente</option><option value="confirmada">Confirmada</option><option value="cancelada">Cancelada</option><option value="completada">Completada</option></select>
        </div>
        <div class="modal-actions"><button type="button" class="btn btn-outline" onclick="closeStatusModal()">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambio</button></div>
    </form>
</div></div>

@push('scripts')
<script>
function openStatusModal(reservationId, currentStatus){ const modal=document.getElementById('statusModal'); const form=document.getElementById('statusForm'); form.action = `/admin/reservas/${reservationId}/estado`; document.getElementById('newStatus').value = currentStatus; modal.style.display='flex'; }
function closeStatusModal(){ document.getElementById('statusModal').style.display='none'; }
window.onclick=function(e){ const modal=document.getElementById('statusModal'); if(e.target==modal) closeStatusModal(); }
</script>
@endpush

@endsection
