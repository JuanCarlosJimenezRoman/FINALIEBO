@extends('adminlte::page')
<!-- Extiende la plantilla de AdminLTE para proporcionar una estructura y estilos básicos -->

@section('title', 'Dashboard')
<!-- Define el título de la página como "Dashboard" -->

@section('content_header')
    <h1>Nuevo usuario</h1>
    <!-- Encabezado de la página que muestra "Nuevo usuario" -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Contenedor principal con una columna que ocupa todo el ancho (12 columnas) -->

            @includeif('partials.errors')
            <!-- Incluye la vista 'partials.errors' si existe, para mostrar mensajes de error de validación -->

            <div class="card card-default">
                <div class="card-header">
                    <!-- Título de la tarjeta que indica que se está creando un nuevo usuario -->
                    <span class="card-title">{{ __('Create') }} Usuario</span>
                </div>
                <div class="card-body">
                    <!-- Formulario para enviar los datos del nuevo usuario al controlador -->
                    <form method="POST" action="{{ route('usuarios.store') }}" role="form">
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
