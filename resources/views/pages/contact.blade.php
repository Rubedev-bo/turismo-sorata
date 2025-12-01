@extends('layouts.app')

@section('title','Contacto - Sorata Adventures')

@section('content')
    <section class="page-top" style="padding:80px 0;">
        <div class="container">
            <h1>Contacto</h1>
            <p>Envíanos tu consulta y te responderemos pronto.</p>
        </div>
    </section>

    <section class="contact-form" style="padding:60px 0;">
        <div class="container">
            <form action="{{ route('contact.store') }}" method="POST" novalidate>
                @csrf
                <div class="grid-2">
                    <div>
                        <label>Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" required maxlength="100">
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="grid-2">
                    <div>
                        <label>Teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono') }}" required>
                    </div>
                    <div>
                        <label>Tour de interés</label>
                        <select name="tour">
                            <option value="Camino del Illampu">Camino del Illampu</option>
                            <option value="Valle de los Cóndores">Valle de los Cóndores</option>
                            <option value="Lagunas Glaciares">Lagunas Glaciares</option>
                        </select>
                    </div>
                </div>
                <div class="grid-2">
                    <div>
                        <label>Fecha preferida</label>
                        <input type="date" name="fecha_preferida" value="{{ old('fecha_preferida') }}">
                    </div>
                    <div>
                        <label>Número de personas</label>
                        <input type="number" name="personas" value="{{ old('personas',1) }}" min="1" max="20">
                    </div>
                </div>
                <div>
                    <label>Mensaje</label>
                    <textarea name="mensaje" maxlength="1000">{{ old('mensaje') }}</textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Enviar Consulta</button>
                </div>
            </form>
        </div>
    </section>

@endsection
