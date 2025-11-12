@extends('layouts.admin')
@section('contenido')

<!-- row => fila del sistema de grillas de Bootstrap
     justify-content-center => centra horizontalmente el contenido dentro de la fila
     align-items-center => alinea verticalmente los elementos de la fila -->
<div class="row justify-content-center align-items-center">
  <!-- col-lg-11 col-md-11 col-sm-11 col-xs-11 =>
       la columna ocupa 11/12 partes en todos los tamaños de pantalla -->
  <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
    <h3>Editar Categoría</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-10">

    <!-- Includes de Blade para mensajes de éxito y errores -->
    @include('compartido.mensajes') 
    @include('compartido.errores') 
</div>
</div>
<br>

<!-- Formulario de edición de categoría -->
<form method="POST"
      action="{{ route('categorias.update', $cat->id_categoria) }}"
      enctype="multipart/form-data">
  @csrf
  @method('PUT') <!-- Indica a Laravel que el método real es PUT -->

  <!-- row => agrupa los campos en una fila -->
  <div class="row">
    <!-- form-group => añade márgenes y separación entre los campos -->
    <!-- col-md-3 => cada campo ocupa 3/12 columnas en pantallas medianas o más grandes -->
    <div class="form-group col-md-3">
      <!-- form-check-label => estilo Bootstrap para etiquetas de formulario -->
      <label for="nombre" class="form-check-label">Nombre (*)</label>
      <!-- form-control => da estilo uniforme al input -->
      <input type="text" name="nombre" id="nombre" class="form-control"
             value="{{ old('nombre', $cat->nombre) }}" >
    </div>

    <div class="form-group col-md-3">
      <label for="descripcion" class="form-check-label">Descripcion (*)</label>
      <input type="text" name="descripcion" id="descripcion" class="form-control"
             value="{{ old('descripcion', $cat->descripcion) }}" >
    </div>
  </div>

  <!-- row justify-content-center align-items-center =>
       fila que centra horizontal y verticalmente los botones -->
  <div class="row justify-content-center align-items-center">
    <div class="col-md-2">
      <!-- btn => clase base de Bootstrap para botones
           btn-success => verde (acción positiva)
           btn-block => ocupa todo el ancho de la columna
           btn-lg => tamaño grande -->
      <button class="btn btn-success btn-block btn-lg">Guardar</button>
    </div>
    <div class="col-md-2">
      <!-- btn-primary => azul (acción principal)
           title="Salir" => tooltip al pasar el mouse -->
      <a href="{{ route('categorias.index') }}" class="btn btn-primary btn-block btn-lg" title="Salir">Salir</a>
    </div>
  </div>
</form>

@endsection

@push('scripts')
<script>
  //Aquí se pueden agregar scripts específicos de esta vista -->
</script>
@endpush
