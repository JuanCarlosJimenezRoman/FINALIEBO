@extends('adminlte::page') <!-- Extiende la plantilla AdminLTE -->

@section('title', 'Crear Cliente') <!-- Define el título de la página -->

@section('content_header')
    <h1 style="color: var(--color-primary); font-weight: bold;">Crear Cliente</h1> <!-- Encabezado principal -->
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Mostrar mensajes de error si existen -->
            @includeif('partials.errors')

            <!-- Tarjeta contenedora del formulario -->
            <div class="card shadow-sm border-2" style="border-color: var(--color-primary); border-radius: 8px;">
                <div class="card-header bg-primary text-white" style="border-radius: 8px 8px 0 0;">
                    <h5 class="mb-0" style="font-family: 'Arial', sans-serif;">Formulario de Creación de Cliente</h5>
                </div>
                <div class="card-body">
                    <!-- Formulario para crear un nuevo cliente -->
                    <form method="POST" action="{{ route('clientes.store') }}" role="form">
                        @csrf <!-- Token CSRF para proteger el formulario -->

                        <!-- Campos del formulario -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre completo" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese el correo electrónico" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Ingrese el número de teléfono" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <textarea name="direccion" id="direccion" class="form-control" rows="3" placeholder="Ingrese la dirección completa" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="plante_educativo" class="form-label">Plantel Educativo</label>
                            <input type="text" name="plante_educativo" id="plante_educativo" class="form-control" placeholder="Ingrese el plantel educativo" required>
                        </div>
                        <div class="mb-3">
                            <label for="region" class="form-label">Región</label>
                            <input type="text" name="region" id="region" class="form-control" placeholder="Ingrese la región" required>
                        </div>

                        <!-- Botones de acción -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('clientes.index') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar Cliente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <!-- Estilo personalizado -->
    <style>
        :root {
            --color-primary: #285C4D;
            --color-secondary: #B38E5D;
            --color-white: #ffffff;
        }

        .bg-primary {
            background-color: var(--color-primary) !important;
        }

        .btn-success {
            background-color: var(--color-secondary) !important;
            color: var(--color-white);
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            color: var(--color-white);
            border: none;
        }

        .btn-success:hover,
        .btn-danger:hover {
            opacity: 0.8;
        }
    </style>
@stop

@section('js')
    <!-- Scripts adicionales -->
    <script>
        console.log('Formulario cargado correctamente.');
    </script>
@stop
