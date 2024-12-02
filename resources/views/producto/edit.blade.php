@extends('adminlte::page')
<!-- Extiende la plantilla AdminLTE para dar formato a la página -->

@section('title', 'Dashboard')
<!-- Define el título de la página como "Dashboard" -->

@section('content_header')
    <h1>Libros</h1>
    <!-- Encabezado de la página que muestra "Dashboard" -->
@stop

@section('content')
    <div class="">
        <div class="col-md-12">
            <!-- Contenedor de Bootstrap con una columna que ocupa todo el ancho (12 columnas) -->

            @includeif('partials.errors')
            <!-- Incluye el archivo 'partials.errors' si existe, para mostrar mensajes de error en caso de validación fallida -->

            <div class="card card-default">
                <div class="card-header">
                    <!-- Título de la tarjeta que indica que se está actualizando un producto existente -->
                    <span class="card-title">{{ __('Update') }} Lirbos</span>
                </div>
                <div class="card-body">
                    <!-- Formulario para enviar datos actualizados del producto al controlador -->
                    <form method="POST" action="{{ route('productos.update', $producto->id) }}" role="form"
                        enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        <!-- Método PATCH para indicar al servidor que es una actualización de recurso existente -->

                        @csrf
                        <!-- Token CSRF para proteger el formulario contra ataques de falsificación de solicitudes -->

                        @include('producto.form')
                        <!-- Incluye el archivo 'producto.form' para mantener los campos del formulario organizados y reutilizables -->
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
        <!-- Mensaje en la consola para verificar que el JavaScript se está cargando correctamente -->
    </script>
@stop
