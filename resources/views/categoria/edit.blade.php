@extends('adminlte::page')

@section('title', 'Dashboard')  <!-- Define el título de la página como "Dashboard" -->

@section('content_header')
    <h1>Inicio</h1>  <!-- Encabezado principal de la sección del dashboard -->
@stop

@section('content')
    <div class="">
        <div class="col-md-12">
            <!-- Incluye el archivo de errores si existe, para mostrar mensajes de validación o errores al usuario -->
            @includeif('partials.errors')

            <!-- Tarjeta contenedora del formulario de actualización de categoría -->
            <div class="card card-default">
                <div class="card-header">
                    <!-- Título de la tarjeta que indica que se está actualizando una categoría existente -->
                    <span class="card-title">{{ __('Update') }} Categoria</span>
                </div>
                <div class="card-body">
                    <!-- Formulario para actualizar la categoría existente -->
                    <form method="POST" action="{{ route('categorias.update', $categoria->id) }}" role="form"
                          enctype="multipart/form-data">
                        <!-- Especifica que este formulario utiliza el método PATCH, que es adecuado para actualizaciones -->
                        {{ method_field('PATCH') }}
                        <!-- Token CSRF para proteger el formulario contra ataques de falsificación de solicitudes -->
                        @csrf

                        <!-- Incluye el contenido del formulario desde el archivo 'categoria.form', que contiene los campos necesarios -->
                        @include('categoria.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
