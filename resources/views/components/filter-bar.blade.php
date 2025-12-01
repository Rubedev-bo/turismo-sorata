@props(['comunidades' => null, 'experiences' => null])

<div class="filter-bar" data-aos="fade-down">
    <div class="filter-group">
        <label>Tipo de Actividad:</label>
        <div class="filter-buttons">
            <button class="filter-btn active" data-filter="all">Todas</button>
            <button class="filter-btn" data-filter="trekking">🥾 Trekking</button>
            <button class="filter-btn" data-filter="hospedaje">🏠 Hospedaje</button>
            <button class="filter-btn" data-filter="cultural">🎭 Cultural</button>
        </div>
    </div>
    <div class="filter-group">
        <label>Comunidad:</label>
        <select class="filter-select" id="communityFilter">
            <option value="all">Todas las comunidades</option>
            @if($comunidades)
                    @foreach($comunidades as $c)
                        <option value="{{ $c->comunidad_id ?? $c->id }}">{{ $c->nombre ?? $c->name }}</option>
                    @endforeach
                @endif
        </select>
    </div>
    <button class="filter-clear" id="clearFilters">Limpiar Filtros</button>
    <div class="filter-results"><span id="resultsCount">{{ $experiences ? $experiences->count() : 0 }}</span> experiencias encontradas</div>
</div>
