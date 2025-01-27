@extends('adminlte::page') <!-- Extiende la plantilla AdminLTE -->

@section('title', 'Crear Libro') <!-- Define un título descriptivo -->

@section('content_header')
    <!-- Encabezado principal con estilo consistente -->
    <h1 style="color: var(--color-primary); font-weight: bold;">Crear Nuevo Libro</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Mostrar mensajes de errores -->
            @includeif('partials.errors')

            <!-- Tarjeta del formulario -->
            <div class="card shadow-sm border-2" style="border-color: var(--color-primary); border-radius: 8px;">
                <div class="card-header bg-primary text-white" style="border-radius: 8px 8px 0 0;">
                    <h5 class="mb-0" style="font-family: 'Arial', sans-serif;">Formulario de Creación de Libro</h5>
                </div>
                <div class="card-body">
                    <!-- Formulario para crear un nuevo libro -->
                    <form method="POST" action="{{ route('productos.store') }}" role="form" enctype="multipart/form-data" autocomplete="off">
                        @csrf <!-- Token CSRF para proteger el formulario -->

                        <!-- Campo Título -->
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título del Libro</label>
                            <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror"
                                   value="{{ old('titulo') }}" placeholder="Ingrese el título del libro" required>
                            @error('titulo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Campo Autor -->
                        <div class="mb-3">
                            <label for="autor" class="form-label">Autor</label>
                            <input type="text" name="autor" id="autor" class="form-control @error('autor') is-invalid @enderror"
                                   value="{{ old('autor') }}" placeholder="Ingrese el autor del libro" required>
                            @error('autor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Campo ISBN -->
                        <div class="mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" name="isbn" id="isbn" class="form-control @error('isbn') is-invalid @enderror"
                                   value="{{ old('isbn') }}" placeholder="Ingrese el ISBN del libro" required>
                            @error('isbn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Campo Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                                      rows="3" placeholder="Ingrese una breve descripción del libro" required>{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Botones de acción -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('productos.index') }}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <style>
        .bg-primary {
            background-color: var(--color-primary) !important;
        }

        .btn-success {
            background-color: var(--color-secondary);
            color: var(--color-white);
        }

        .btn-danger {
            background-color: #dc3545;
            color: var(--color-white);
        }

        .btn-success:hover,
        .btn-danger:hover {
            opacity: 0.8;
        }

        h1 {
            font-family: 'Arial', sans-serif; /* Fuente consistente */
            font-weight: bold;
            color: var(--color-primary);
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Formulario de creación de libro cargado.');
    </script>
@stop
