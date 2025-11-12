<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nueva categoría</title>
</head>
<body>

<h1>Nueva categoría</h1>

<form method="POST" action="{{ route('categorias.store') }}">
  @csrf

  <div>
    <label for="nombre">Nombre *</label><br>
    <input id="nombre" name="nombre" type="text" value="{{ old('nombre') }}" required>
  </div>

  <div style="margin-top:8px;">
    <label for="descripcion">Descripción</label><br>
    <input id="descripcion" name="descripcion" type="text" value="{{ old('descripcion') }}">
  </div>

  <div style="margin-top:12px;">
    <button type="submit">Guardar</button>
    <a href="{{ route('categorias.index') }}">Volver al listado</a>
  </div>
</form>

</body>
</html>