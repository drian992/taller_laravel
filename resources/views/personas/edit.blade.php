@extends('layouts.admin')

@section('title', 'Editar persona')

@section('contenido')
    <h1 class="mb-4">Editar persona</h1>

    @include('compartido.errores')

    <form action="{{ route('personas.update', $persona) }}" method="POST" class="card">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', $persona->nombre) }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="dni">DNI</label>
                    <input type="text" id="dni" name="dni" class="form-control" value="{{ old('dni', $persona->dni) }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" class="form-control" value="{{ old('telefono', $persona->telefono) }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" class="form-control" value="{{ old('direccion', $persona->direccion) }}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $persona->email) }}" required>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('personas.index') }}" class="btn btn-outline-secondary">Volver</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
@endsection
