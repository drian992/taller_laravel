@extends('layouts.admin')  
@section ('contenido')

<!-- row => fila del sistema de grillas de Bootstrap
     justify-content-center => centra horizontalmente el contenido dentro de la fila
     align-items-center => centra verticalmente los elementos dentro de la fila -->
<div class="row justify-content-center align-items-center">
    <!-- col-lg-11 col-md-11 col-sm-11 col-xs-11 => 
         la columna ocupa 11/12 partes del ancho en todos los tamaños de pantalla -->
    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
        <h3>Nueva Categoría</h3>
    </div>
</div>
<div class="row">
  <div class="col-md-10">

    <!-- Includes de Blade para mensajes de éxito y errores -->
    @include('compartido.errores')
</div>
</div>
</br>

<!-- Formulario para crear nueva categoría -->
<form method="post" action="{{ route('categorias.store') }}" enctype=multipart/form-data>
    @csrf
   
    <!-- row => agrupa los campos en una fila -->
    <div class="row">
        <!-- form-group => separa cada campo del formulario con márgenes
             col-md-3 => ocupa 3/12 columnas en pantallas medianas hacia arriba -->
        <div class="form-group col-md-3">
            <!-- form-check-label => clase de Bootstrap que estiliza etiquetas de formulario -->
            <label for="nombre" class="form-check-label">Nombre (*)</label>
            <!-- form-control => aplica estilos consistentes al input-->
            <input type="text" name="nombre" id="nombre" value="{{old('nombre')}}" required class="form-control" >
        </div>

        <div class="form-group col-md-3">
            <label for="descripcion" class="form-check-label">Descripcion (*)</label>
            <input type="text" name="descripcion" id="descripcion" value="{{old('descripcion')}}" class="form-control">
        </div>
    </div>


    <!-- row justify-content-center align-items-center => 
         crea una fila y centra horizontal y verticalmente los botones -->
    <div class="row justify-content-center align-items-center">
        <div class="col-md-2">
            <!-- btn => botón base de Bootstrap
                 btn-success => color verde
                 btn-block => ocupa todo el ancho de la columna
                 btn-lg => tamaño grande -->
            <button class="btn btn-success btn-block btn-lg">Guardar</button>
        </div>
        <div class="col-md-2">
            <!-- btn-primary => color azul
                 title="Salir" => muestra tooltip al pasar el mouse -->
            <a href="{{ route('categorias.index') }}" class="btn btn-primary btn-block btn-lg" title="Salir">Salir</a>
        </div>
    </div>
</form>

@endsection

@push('scripts')
    <script>
        //Aquí podrías agregar código JavaScript específico para esta vista
    </script>
@endpush
