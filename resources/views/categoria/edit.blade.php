@extends('adminlte::page')

@section('title', 'Editar Categoría') <!-- Define un título más descriptivo -->

@section('content_header')
    <h1>Editar Categoría</h1> <!-- Encabezado principal de la sección -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Mensajes de éxito -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Muestra mensajes de error si los hay -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Tarjeta para la edición de categoría -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Actualizar Categoría</h3> <!-- Título de la tarjeta -->
                </div>
                <div class="card-body">
                    <!-- Formulario para actualizar la categoría -->
                    <form method="POST" action="{{ route('categorias.update', $categoria->id) }}" role="form">
                        @csrf <!-- Token CSRF para proteger contra ataques -->
                        @method('PATCH') <!-- Método PATCH para actualizaciones -->

                        <!-- Incluye el formulario desde 'form.blade.php' -->
                        @include('categoria.form')
                    </form>
                </div>
                <div class="card-footer">
                    <!-- Botón para regresar al listado de categorías -->
                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@stop
