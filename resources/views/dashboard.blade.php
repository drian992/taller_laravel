@extends('layouts.admin')

@section('title', 'Panel principal')

@section('contenido')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="h3 mb-3">Bienvenido al sistema</h1>
                    <p class="mb-4">
                        Ya puedes gestionar tus datos desde este panel sencillo. Si eres administrador, usa el menú superior para ir a la sección de personas y administrar los registros.
                    </p>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="fa fa-check text-success mr-2"></i>Los usuarios comunes pueden revisar su información principal aquí.</li>
                        <li class="mb-2"><i class="fa fa-check text-success mr-2"></i>El administrador dispone de enlaces directos para editar, eliminar o restaurar personas.</li>
                        <li><i class="fa fa-check text-success mr-2"></i>Utiliza el botón “Cerrar sesión” en la barra superior cuando termines.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
