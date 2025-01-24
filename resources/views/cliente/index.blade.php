@extends('adminlte::page')  <!-- Extiende la plantilla AdminLTE para la estructura de la página -->

@section('title', 'Inicio')  <!-- Define el título de la página como "Inicio" -->

@section('content_header')
    <h1 style="color: var(--color-primary); font-weight: bold;">Clientes</h1>  <!-- Encabezado principal de la sección de "Clientes" -->
@stop

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm" style="border: 2px solid var(--color-primary);">
            <div class="card-header" style="background-color: var(--color-primary); color: var(--color-white);">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <!-- Título de la tarjeta -->
                    <span id="card_title">
                        {{ __('Clientes') }}
                    </span>
                    <div class="float-right">
                        <!-- Botón para crear un nuevo cliente -->
                        <a href="{{ route('clientes.create') }}" class="btn btn-sm btn-light" style="background-color: var(--color-secondary); color: var(--color-white);">
                            {{ __('Crear Nuevo') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body" style="background-color: var(--color-gray-light);">
                <!-- Mensaje de éxito -->
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                <div class="table-responsive">
                    <!-- Tabla para mostrar los clientes -->
                    <table class="table table-striped table-bordered" id="tblClients" style="width: 100%; border: 1px solid var(--color-primary);">
                        <thead style="background-color: var(--color-primary); color: var(--color-white);">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo Electrónico</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Plante Educativo</th>
                                <th>Región</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <!-- Estilos CSS específicos para DataTables -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <style>
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px; /* Ajustar espacio entre botones */
        }

        .btn-sm {
            border-radius: 5px;
            padding: 5px 10px;
        }
    </style>
@endsection

@section('js')
    <!-- Scripts para DataTables y SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inicializar DataTable
            $('#tblClients').DataTable({
                responsive: true,
                fixedHeader: true,
                ajax: '{{ route('clients.list') }}', // Ruta para obtener los datos del JSON
                columns: [
                    { data: 'id' }, // ID del cliente
                    { data: 'nombre' }, // Nombre del cliente
                    {
                        data: 'user.email', // Correo electrónico del usuario relacionado
                        defaultContent: 'Sin correo' // Mensaje por defecto si no hay correo
                    },
                    { data: 'telefono' }, // Teléfono del cliente
                    { data: 'direccion' }, // Dirección del cliente
                    { data: 'plante_educativo', defaultContent: 'No especificado' }, // Plante Educativo
                    { data: 'region', defaultContent: 'No especificado' }, // Región
                    { // Columna de acciones
                        data: null,
                        orderable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="action-buttons">
                                    <a href="/clientes/${row.id}/edit" class="btn btn-sm btn-primary">Editar</a>
                                    <button class="btn btn-sm btn-danger" onclick="deleteClient(${row.id})">Eliminar</button>
                                </div>
                            `;
                        }
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json', // Traducción al español
                },
                order: [[0, 'desc']] // Ordenar por ID descendente
            });
        });

        // Función para eliminar un cliente
        function deleteClient(clientId) {
            Swal.fire({
                title: "Eliminar",
                text: "¿Estás seguro de que quieres eliminar este cliente?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Sí, eliminar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/clientes/${clientId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire("Eliminado", "El cliente ha sido eliminado.", "success");
                            $('#tblClients').DataTable().ajax.reload();
                        } else {
                            Swal.fire("Error", "No se pudo eliminar el cliente.", "error");
                        }
                    })
                    .catch(error => {
                        Swal.fire("Error", "Hubo un problema al eliminar el cliente.", "error");
                        console.error(error);
                    });
                }
            });
        }
    </script>
@stop
