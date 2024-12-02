@extends('adminlte::page')

@section('title', 'Dashboard')  <!-- Define el título de la página como "Dashboard" -->

@section('content_header')
    <h1>Inicio</h1>  <!-- Encabezado principal de la sección del dashboard -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Incluye el archivo de errores si existe, para mostrar mensajes de validación o errores al usuario -->
            @includeif('partials.errors')

            <!-- Tarjeta contenedora del formulario de creación de categoría -->
            <div class="card card-default">
                <div class="card-header">
                    <!-- Título de la tarjeta que indica que se está creando una nueva categoría -->
                    <span class="card-title">{{ __('Create') }} Categorias</span>
                </div>
                <div class="card-body">
                    <!-- Formulario para enviar la nueva categoría al controlador de almacenamiento -->
                    <form method="POST" action="{{ route('categorias.store') }}" role="form">
                        <!-- Token CSRF para proteger el formulario contra ataques de falsificación de solicitudes -->
                        @csrf

                        <!-- Incluye el contenido del formulario desde el archivo 'categoria.form' -->
                        @include('categoria.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
