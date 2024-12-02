@extends('adminlte::page')  <!-- Extiende la plantilla AdminLTE para la estructura de la página -->

@section('title', 'Dashboard')  <!-- Define el título de la página como "Dashboard" -->

@section('content_header')
    <h1>Inicio</h1>  <!-- Encabezado principal de la sección del dashboard -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Incluye el archivo de errores si existe, para mostrar mensajes de validación o errores al usuario -->
            @includeif('partials.errors')

            <!-- Tarjeta contenedora del formulario de creación de cliente -->
            <div class="card card-default">
                <div class="card-header">
                    <!-- Título de la tarjeta que indica que se está creando un nuevo cliente -->
                    <span class="card-title">{{ __('Create') }} Clientes</span>
                </div>
                <div class="card-body">
                    <!-- Formulario para enviar los datos del nuevo cliente al controlador para almacenarlos -->
                    <form method="POST" action="{{ route('clientes.store') }}" role="form">
                        <!-- Token CSRF para proteger el formulario contra ataques de falsificación de solicitudes -->
                        @csrf

                        <!-- Incluye el contenido del formulario desde el archivo 'cliente.form' -->
                        @include('cliente.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
