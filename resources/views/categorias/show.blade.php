@extends('layouts.admin')  
@section ('contenido')
<div class="row justify-content-center align-items-center">
	<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
		<h3>Ver Categoría</h3>
		<div class="progress" style="height: 2px;"></div>
	</div>
</div>
</br>
<div class="row">
	<div class="form-group col-md-3">
		<label for="nombre" class="form-check-label">Nombre (*)</label>
		<input type="text" name="nombre" id="nombre" class="form-control"  value="{{$cat->nombre}}" readonly>
	</div>
	<div class="form-group col-md-3">
		<label for="descripcion" class="form-check-label">Nombre (*)</label>
		<input type="text" name="descripcion" id="descripcion" class="form-control"  value="{{$cat->descripcion}}" readonly>
	</div>
</div>

<legend></legend>
<div class="row justify-content-center align-items-center">
	<div class="col-md-2">
		<a href="{{ route('categorias.index') }}" class="btn btn-primary btn-block btn-lg" title="Salir">Salir</a>
	</div>
</div>

@endsection