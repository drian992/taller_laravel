@extends('layouts.admin')

@section('title', 'Registrarse')

@section('contenido')
    {{-- // minimal change. --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">Crear cuenta</h1>
            @include('compartido.errores')
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre completo</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dni">DNI</label>
                        <input type="text" id="dni" name="dni" class="form-control" value="{{ old('dni') }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fecha_nacimiento">Fecha de nacimiento</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="domicilio">Domicilio</label>
                        <input type="text" id="domicilio" name="domicilio" class="form-control" value="{{ old('domicilio') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" class="form-control" value="{{ old('telefono') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password_confirmation">Confirmar contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Registrarme</button>
            </form>
        </div>
    </div>
@endsection
