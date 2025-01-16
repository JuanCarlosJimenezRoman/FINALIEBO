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

                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="plante_educativo">Plante Educativo</label>
                            <input type="text" name="plante_educativo" id="plante_educativo" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="region">Región</label>
                            <input type="text" name="region" id="region" class="form-control">
                        </div>

                        <div class="mt-3 d-flex justify-content-between">
                            <a href="{{ route('clientes.index') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

