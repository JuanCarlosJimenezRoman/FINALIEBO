@extends('adminlte::page')
<!-- Extiende la plantilla de AdminLTE para proporcionar una estructura y estilos básicos -->

@section('title', 'Dashboard')
<!-- Define el título de la página como "Inicio" -->

@section('content_header')
    <h1>Editar usuario</h1>
    <!-- Encabezado de la página que muestra "Editar usuario" -->
@stop

@section('content')
    <div class="">
        <div class="col-md-12">
            <!-- Contenedor principal con una columna que ocupa todo el ancho (12 columnas) -->

            @includeif('partials.errors')
            <!-- Incluye la vista 'partials.errors' si existe, para mostrar mensajes de error de validación -->

            <div class="card card-default">
                <div class="card-header">
                    <!-- Título de la tarjeta indicando que se está actualizando un usuario existente -->
                    <span class="card-title">{{ __('Update') }} Usuario</span>
                </div>
                <div class="card-body">
                    <!-- Formulario para enviar los datos actualizados del usuario al controlador -->
                    <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}" role="form"
                        enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        <!-- Método PATCH para indicar al servidor que es una actualización de un recurso existente -->

                        @csrf
                        <!-- Token CSRF para proteger el formulario contra ataques de falsificación de solicitudes -->

                        @include('usuario.form')
                        <!-- Incluye el archivo 'usuario.form' para mantener los campos del formulario organizados y reutilizables -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- Incluye un archivo CSS personalizado para aplicar estilos adicionales en la página -->
@stop

@section('js')
    <script>
        console.log('Hi!');
        <!-- Mensaje en la consola para verificar que el JavaScript se está cargando correctamente -->
    </script>
@stop
