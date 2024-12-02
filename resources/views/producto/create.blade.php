@extends('adminlte::page')
<!-- Extiende la plantilla de AdminLTE para dar formato a la página -->

@section('title', 'Dashboard')
<!-- Define el título de la página como "Dashboard" -->

@section('content_header')
    <h1>Libros</h1>
    <!-- Encabezado de la página que muestra "Dashboard" -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Incluye un contenedor de fila de Bootstrap con una columna que ocupa todo el ancho (12 columnas) -->

            @includeif('partials.errors')
            <!-- Incluye el archivo 'partials.errors' si existe, para mostrar errores de validación -->

            <div class="card card-default">
                <div class="card-header">
                    <!-- Título de la tarjeta, indicando que se está creando un nuevo producto -->
                    <span class="card-title">{{ __('Crear') }} Libros</span>
                </div>
                <div class="card-body">
                    <!-- Formulario para enviar datos del nuevo producto al controlador -->
                    <form method="POST" action="{{ route('productos.store') }}" role="form" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <!-- Token CSRF para proteger el formulario contra ataques de falsificación de solicitudes -->

                        @include('producto.form')
                        <!-- Incluye el archivo 'producto.form' para mantener los campos del formulario separados y organizados -->

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- Enlace a un archivo CSS personalizado para aplicar estilos adicionales en la página -->
@stop

@section('js')
    <script>
        console.log('Hi!');
        <!-- Mensaje de consola para verificar que el JavaScript se está cargando correctamente -->
    </script>
@stop
