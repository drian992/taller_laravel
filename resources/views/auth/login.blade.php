@extends('layouts.admin')

@section('title', 'Iniciar sesión')

@section('contenido')
    {{-- // minimal change. --}}
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="mb-4">Iniciar sesión</h1>
            @include('compartido.errores')
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
        </div>
    </div>
@endsection
