@extends('layouts.app')

@section('title','Realizar Reserva')

@section('content')
<section class="reservation-section" style="padding:60px 0;">
    <div class="container">
        <div class="reservation-header" data-aos="fade-up">
            <h1>Reserva tu Experiencia</h1>
            <p>Completa el formulario para reservar tu aventura en Sorata</p>
        </div>

        <div class="reservation-container two-col" style="margin-top:24px;">
            <div class="experience-summary" data-aos="fade-right">
                @if(isset($experience))
                    <img src="{{ $experience->imagen ?? 'https://images.unsplash.com/photo-1483728642387-6c3bdd6c93e5?w=600' }}" alt="{{ $experience->nombre }}" loading="lazy">
                    <h3>{{ $experience->nombre }}</h3>
                    <p><strong>Comunidad:</strong> {{ $experience->comunidad->nombre ?? '' }}</p>
                    <p><strong>Tipo:</strong> {{ $experience->tipo_actividad ?? '' }}</p>
                    <div class="summary-price"><span>Precio por persona:</span> <strong>{{ $experience->precio_bs ?? $experience->price }} Bs.</strong></div>
                @else
                    <p>Selecciona la experiencia que deseas reservar.</p>
                @endif
            </div>

            <div class="reservation-form-container" data-aos="fade-left">
                <form action="{{ route('reservations.store') }}" method="POST" id="reservationForm">
                    @csrf
                    @if(isset($experience))
                        <input type="hidden" name="experience_id" value="{{ $experience->experiencia_id ?? $experience->id }}">
                    @endif

                    <div class="form-group">
                        <label for="date" class="required">Fecha de la Experiencia</label>
                        <input type="date" id="date" name="date" min="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="adults" class="required">Adultos</label>
                            <input type="number" id="adults" name="adults" value="1" min="1" max="20" required>
                        </div>
                        <div class="form-group">
                            <label for="children">Niños (0-12)</label>
                            <input type="number" id="children" name="children" value="0" min="0" max="20">
                        </div>
                    </div>

                    <div class="total-price-display">Precio Total: <strong id="totalPrice">0 Bs.</strong></div>

                    <h4 class="form-section-title">Tus Datos de Contacto</h4>
                    <div class="form-group">
                        <label for="name" class="required">Nombre Completo</label>
                        <input type="text" id="name" name="name" maxlength="100" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email" class="required">Correo Electrónico</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="required">Teléfono/WhatsApp</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="comments">Comentarios o Requerimientos</label>
                        <textarea id="comments" name="comments" rows="4" maxlength="1000"></textarea>
                    </div>

                    <div class="form-group checkbox-group">
                        <label class="checkbox-container">
                            <input type="checkbox" name="terms" id="terms" required>
                            <span class="checkmark"></span>
                            Acepto los términos y condiciones
                        </label>
                    </div>

                    <div class="form-actions">
                        <a href="{{ url()->previous() }}" class="btn btn-outline">Cancelar</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="btn-text">Confirmar Reserva</span>
                            <span class="btn-loading" style="display:none"><span class="spinner"></span> Procesando...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/reservations.js') }}"></script>
@endpush
