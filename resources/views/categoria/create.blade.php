@extends('adminlte::page')

@section('title', 'Crear Categoría') <!-- Define un título más descriptivo para la página -->

@section('content_header')
    <h1>Crear Nueva Categoría</h1> <!-- Encabezado principal de la sección -->

@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Muestra mensajes de éxito, error o validación -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Tarjeta contenedora del formulario -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Crear Categoría</h3>
                </div>
                <div class="card-body">
                    <!-- Formulario para crear una nueva categoría -->
                    <form method="POST" action="{{ route('categorias.store') }}" role="form">
                        @csrf <!-- Token CSRF para proteger contra ataques -->

                        <!-- Campo Nombre -->
                        <div class="form-group">
                            <label for="nombre">Nombre de la Categoría</label>
                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                                id="nombre" value="{{ old('nombre') }}" placeholder="Nombre de la Categoría">
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Campo Año -->
                        <div class="form-group">
                            <label for="anio">Año</label>
                            <input type="number" name="anio" id="anio" class="form-control" value="{{ old('anio') }}" required>
                        </div>

                        <!-- Campo Ciclo Escolar -->
                        <div class="form-group">
                            <label for="ciclo">Ciclo Escolar</label>
                            <select name="ciclo" id="ciclo" class="form-control" required>
                                <option value="">Seleccione</option>
                                <option value="A" {{ old('ciclo') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('ciclo') == 'B' ? 'selected' : '' }}>B</option>
                            </select>
                        </div>

                        <!-- Botón de guardar -->
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div class="card-footer">
                    <!-- Botón de regreso al listado de categorías -->
                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@stop
