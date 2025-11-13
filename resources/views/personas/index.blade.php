@extends('layouts.admin')

@section('title', 'Personas registradas')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Personas registradas</h1>
    </div>

    @include('compartido.mensajes')

    <div class="card mb-4">
        <div class="card-header">Listado activo</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Dirección</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($personas as $persona)
                            <tr>
                                <td>{{ $persona->nombre }}</td>
                                <td>{{ $persona->dni }}</td>
                                <td>{{ $persona->telefono }}</td>
                                <td>{{ $persona->email }}</td>
                                <td>{{ $persona->direccion }}</td>
                                <td class="text-right">
                                    <a href="{{ route('personas.edit', $persona) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                    <form action="{{ route('personas.destroy', $persona) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Enviar a la papelera este registro?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No hay registros disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($personas->hasPages())
            <div class="card-footer">{{ $personas->links() }}</div>
        @endif
    </div>

    <div class="card">
        <div class="card-header">Papelera</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Correo</th>
                            <th>Eliminado</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($personasEliminadas as $persona)
                            <tr>
                                <td>{{ $persona->nombre }}</td>
                                <td>{{ $persona->dni }}</td>
                                <td>{{ $persona->email }}</td>
                                <td>{{ optional($persona->deleted_at)->format('d/m/Y H:i') }}</td>
                                <td class="text-right">
                                    <form action="{{ route('personas.restaurar', $persona->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success">Restaurar</button>
                                    </form>
                                    <form action="{{ route('personas.eliminar-definitivo', $persona->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Esta acción no se puede deshacer. ¿Eliminar definitivamente?')">Eliminar definitivamente</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No hay registros en la papelera.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
