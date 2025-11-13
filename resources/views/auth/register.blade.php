@extends('layouts.admin')

@php
    $adminContext = auth()->check() && auth()->user()->isAdmin;
@endphp

@section('title', $adminContext ? 'Registrar usuario' : 'Registrarse')

@section('contenido')
    {{-- // minimal change. --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">{{ $adminContext ? 'Registrar usuario' : 'Crear cuenta' }}</h1>
            @include('compartido.errores')
            <form method="POST" action="{{ $adminContext ? route('admin.users.store') : route('register') }}">
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
                        <label for="telefono">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" class="form-control" value="{{ old('telefono') }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="direccion">Dirección</label>
                        <input type="text" id="direccion" name="direccion" class="form-control" value="{{ old('direccion') }}" required>
                    </div>
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
                <button type="submit" class="btn btn-primary">{{ $adminContext ? 'Registrar usuario' : 'Registrarme' }}</button>
            </form>
        </div>
    </div>
@endsection
