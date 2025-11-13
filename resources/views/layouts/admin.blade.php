<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <!-- viewport => hace que el sitio sea responsive en móviles -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Token CSRF de Laravel para proteger formularios -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- yield => permite que cada vista defina su título; si no lo define, se usa "MiApp" -->
  <title>@yield('title','MiApp')</title>

  <!-- Bootstrap CSS v4.6.2:
       - framework que da estilos listos para botones, formularios, grillas, etc. -->
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- FontAwesome:
       - librería de íconos (ej: fa-eye, fa-pencil, fa-remove, etc.). -->
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- @stack('styles') => permite que otras vistas agreguen CSS extra en esta sección -->
  @stack('styles')
</head>
<body>
  <!-- navbar => barra de navegación de Bootstrap -->
  <!-- navbar-expand-lg => se expande en pantallas grandes (LG) -->
  <!-- navbar-light => estilo de texto oscuro sobre fondo claro -->
  <!-- bg-light => fondo gris claro -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- navbar-brand => define el logotipo o nombre de la aplicación -->
    <a class="navbar-brand" href="{{ url('/') }}">MiApp</a>
    <div class="ml-auto">
      @auth
        {{-- // minimal change. --}}
        <span class="mr-3">Hola, {{ auth()->user()->nombre ?? auth()->user()->name }}</span>
        @if (auth()->user()->isAdmin)
          {{-- // minimal change. --}}
          <a class="btn btn-link" href="{{ route('personas.index') }}">Personas</a>
          <a class="btn btn-link" href="{{ route('categorias.index') }}">Categorías</a>
          <a class="btn btn-link" href="{{ route('admin.users.create') }}">Registrar usuario</a>
        @endif
        <form class="d-inline" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-outline-secondary btn-sm">Cerrar sesión</button>
        </form>
      @else
        {{-- // minimal change. --}}
        <a class="btn btn-link" href="{{ route('login') }}">Iniciar sesión</a>
        <a class="btn btn-primary" href="{{ route('register') }}">Registrarse</a>
      @endauth
    </div>
  </nav>

  <!-- container => centra el contenido y le da márgenes automáticos laterales -->
  <!-- py-4 => padding vertical (arriba y abajo) de 1.5rem (~24px) -->
  <div class="container py-4">
    @include('compartido.mensajes')
    <!-- yield('contenido') => espacio donde cada vista Blade inyecta su propio contenido -->
    @yield('contenido')
  </div>

  <!-- Dependencias JS -->
  <!-- jQuery => requerido por Bootstrap 4 -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Popper.js => requerido para tooltips, dropdowns y menús flotantes -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <!-- Bootstrap JS => activa componentes interactivos como modales, menús, tooltips -->
   <!-- stack('scripts') => permite que otras vistas agreguen scripts extra -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

 
  @stack('scripts')
</body>
</html>
