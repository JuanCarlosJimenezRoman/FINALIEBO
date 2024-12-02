@extends('adminlte::page')
<!-- Extiende la plantilla de AdminLTE para proporcionar estructura y estilos básicos de panel de administración -->

@section('title', 'Dashboard')
<!-- Define el título de la página como "Dashboard" -->

@section('content_header')
    <h1>Usuarios</h1>
    <!-- Encabezado de la página que muestra "Usuarios" -->
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Usuario') }}
                        </span>
                        <div class="float-right">
                            <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                {{ __('Create New') }}
                            </a>
                            <!-- Botón para agregar un nuevo usuario, redirige a la vista de creación -->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <!-- Muestra un mensaje de éxito si existe en la sesión -->
                        <div class="alert fade_success .fade">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-hover display responsive nowrap" width="100%"
                            id="tblUsers">
                            <thead class="thead">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                        <!-- Tabla de usuarios utilizando DataTables para mostrar datos dinámicamente -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="DataTables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Incluye archivos CSS de DataTables y un archivo personalizado -->
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="DataTables/datatables.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new DataTable('#tblUsers', {
                responsive: true,
                fixedHeader: true,
                ajax: {
                    url: '{{ route('users.list') }}',
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'email' },
                    {
                        // Columna de acciones con botones de edición y eliminación
                        data: null,
                        render: function(data, type, row) {
                            return '<a class="btn btn-sm btn-primary" href="/usuarios/' + row.id + '/edit">Editar</a>' +
                                '<button class="btn btn-sm btn-danger" onclick="deleteUser(' + row.id + ')">Eliminar</button>';
                        }
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
                },
                order: [
                    [0, 'desc']
                ]
                // Ordena la tabla por ID en orden descendente
            });
        });

        // Función para eliminar un usuario
        function deleteUser(userId) {
            Swal.fire({
                title: "Eliminar",
                text: "¿Estás seguro de que quieres eliminar este cliente?",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/usuarios/' + userId, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            return response.text();
                        })
                        .then(data => {
                            // Recarga la tabla para actualizar la lista después de eliminar un usuario
                            $('#tblUsers').DataTable().ajax.reload();
                        })
                        .catch(error => {
                            // Maneja errores en la eliminación
                            console.error('Error al eliminar:', error);
                        });
                }
            });
        }
    </script>
@stop
