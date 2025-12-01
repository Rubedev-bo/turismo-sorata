@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Administrador</h1>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.createFirst.post') }}">
        @csrf
        <div>
            <label>Usuario</label>
            <input type="text" name="usuario" value="{{ old('usuario') }}" required>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Confirmar Password</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <button type="submit">Crear Administrador</button>
    </form>
</div>
@endsection
