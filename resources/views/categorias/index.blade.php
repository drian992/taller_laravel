@extends('layouts.admin')
@section('contenido')

<!-- row => fila del sistema de grillas Bootstrap
     justify-content-center => centra horizontalmente los contenidos
     align-items-center => centra verticalmente -->
<div class="row justify-content-center align-items-center">
  <!-- col-12 => ocupa todo el ancho en pantallas pequeñas
       col-md-11 => ocupa 11/12 del ancho en pantallas medianas o mayores -->
  <div class="col-12 col-md-11">
    <h3>Listado de Categorías</h3>
  </div>
</div>

<div class="row justify-content-center align-items-center">
  <div class="col-md-2">
    <!-- btn => estilo de botón Bootstrap
         btn-success => verde (acción positiva)
         btn-block => ocupa todo el ancho de la columna
         btn-lg => tamaño grande -->
    <a href="{{ route('categorias.create') }}" 
       class="btn btn-success btn-block btn-lg" 
       title="Nuevo">
      Nuevo
    </a>
  </div>
</div>

<br> 

<div class="row justify-content-center align-items-center">
  <div class="col-12 col-md-11">

    <!-- Includes de Blade para mensajes de éxito y errores -->
    @include('compartido.mensajes') 
    @include('compartido.errores')  

    <!-- table-responsive => hace que la tabla sea "scrollable" en pantallas pequeñas -->
    <div class="table-responsive">
      
      <!-- table => tabla con estilos básicos
           table-striped => filas alternadas con fondo gris
           table-bordered => agrega bordes a todas las celdas
           table-hover => resalta la fila al pasar el mouse -->
      <table class="table table-striped table-bordered table-hover" id="example">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categorias as $cat)
            <tr>
              <td>{{ $cat->id_categoria }}</td>
              <td>{{ $cat->nombre }}</td>
              <td>{{ $cat->descripcion }}</td>
              <td align="center">
               
                <form method="POST" action="{{ route('categorias.destroy', $cat->id_categoria) }}" style="display:inline;">
                  @csrf
                  @method('DELETE')

                  <!-- btn-info => azul claro (información) -->
                  <a class="btn btn-info" 
                     href="{{ route('categorias.show', $cat->id_categoria) }}" 
                     title="Ver más">
                    <i class="fa fa-eye"></i>
                  </a>

                  <!-- btn-warning => amarillo (advertencia / editar) -->
                  <a class="btn btn-warning" 
                     href="{{ route('categorias.edit', $cat->id_categoria) }}" 
                     title="Editar">
                    <i class="fa fa-pencil"></i>
                  </a>

                  <!-- btn-danger => rojo (acción destructiva como eliminar) -->
                  <button class="btn btn-danger" 
                          onclick="return confirm('¿Está seguro de eliminar la categoría?');" 
                          title="Eliminar">
                    <i class="fa fa-remove"></i>
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>

@endsection

@push('scripts')
<script>
  // DataTables (plugin JS para mejorar tablas: búsqueda, paginación, exportación)
  $('#example').DataTable({
    dom: 'Bfrtip',
    buttons: ['excel'],
  });
</script>
@endpush
