<!doctype html>
<html lang="es">
<head>
  <title>Categorías</title>
</head>
<body>
<p>
  {{-- Enlace a la vista "new" que renderiza el método create() --}}
  <a href="{{ route('categorias.create') }}">Nueva categoría</a>
</p>
  <ul>
    @foreach($categorias as $cat)
      <li>
        <strong>{{ $cat->nombre }}</strong>   
          — {{ $cat->descripcion }}
        <small>(ID: {{ $cat->id_categoria}})</small>
        {{-- Acciones --}}
        &nbsp;|&nbsp;
        @if(!$cat->deleted_at)
        <a href="{{ route('categorias.edit', $cat->id_categoria) }}">Editar</a>

        <form action="{{ route('categorias.destroy', $cat->id_categoria) }}"
              method="POST" style="display:inline">
          @csrf
          @method('DELETE')
          <button onclick="return confirm('¿Eliminar esta categoría?')">
            Eliminar
          </button>
        </form>
        @else
         <form action="{{ route('categorias.restaurar', $cat->id_categoria) }}"
              method="POST" style="display:inline">
          @csrf
          <button onclick="return confirm('¿restaurar la categoria?')">
            Restaurar
          </button>
        </form>
        @endif
      </li>
    @endforeach
  </ul>

</body>
</html>
