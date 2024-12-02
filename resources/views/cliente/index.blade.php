@extends('adminlte::page')  <!-- Extiende la plantilla AdminLTE para la estructura de la página -->

@section('title', 'Inicio')  <!-- Define el título de la página como "Inicio" -->

@section('content_header')
    <h1>Clientes</h1>  <!-- Encabezado principal de la sección de "Clientes" -->
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <!-- Título de la tarjeta -->
                        <span id="card_title">
                            {{ __('Cliente') }}
                        </span>
                        <div class="float-right">
                            <!-- Botón para crear un nuevo cliente, enlaza a la vista de creación -->
                            <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                {{ __('Create New') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Mensaje de éxito tras realizar una acción, como la creación o eliminación -->
                    @if ($message = Session::get('success'))
                        <div class="alert fade_success .fade">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <!-- Tabla para mostrar los clientes con DataTables, configurada como responsiva y con opciones de búsqueda -->
                        <table class="table table-striped table-hover display responsive nowrap" width="100%"
                            id="tblClients">
                            <thead class="thead">
                                <tr>
                                    <th>Id</th>  <!-- Columna para el ID del cliente -->
                                    <th>Nombre</th>  <!-- Columna para el nombre del cliente -->
                                    <th>Teléfono</th>  <!-- Columna para el teléfono del cliente -->
                                    <th>Dirección</th>  <!-- Columna para la dirección del cliente -->
                                    <th></th>  <!-- Columna vacía para los botones de acciones (editar y eliminar) -->
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <!-- Estilos CSS específicos para DataTables y personalizados -->
    <link href="DataTables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('js')
    <!-- Scripts para SweetAlert2 y DataTables -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="DataTables/datatables.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inicializa la tabla de clientes con DataTables
            new DataTable('#tblClients', {
                responsive: true,
                fixedHeader: true,
                ajax: {
                    url: '{{ route('clients.list') }}',  // Ruta que proporciona los datos para la tabla
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'id' },  // Columna que muestra el ID del cliente
                    { data: 'nombre' },  // Columna que muestra el nombre del cliente
                    { data: 'telefono' },  // Columna que muestra el teléfono del cliente
                    { data: 'direccion' },  // Columna que muestra la dirección del cliente
                    {
                        // Columna para los botones de acciones (editar y eliminar)
                        data: null,
                        render: function(data, type, row) {
                            // Botones para editar y eliminar el cliente
                            return '<a class="btn btn-sm btn-primary" href="/clientes/' +
                                row.id + '/edit">Editar</a>' +
                                '<button class="btn btn-sm btn-danger" onclick="deleteClient(' +
                                row.id + ')">Eliminar</button>';
                        }
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',  // Traducción de DataTables al español
                },
                order: [ [0, 'desc'] ]  // Ordena la tabla de clientes por ID en orden descendente
            });
        });

        // Función para eliminar un cliente
        function deleteClient(clientId) {
            Swal.fire({
                title: "Eliminar",
                text: "¿Estás seguro de que quieres eliminar este cliente?",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Sí, bórralo!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realiza una solicitud DELETE para eliminar el cliente
                    fetch('/clientes/' + clientId, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                        })
                        .then(response => response.text())
                        .then(data => {
                            // Recarga la tabla después de eliminar el cliente
                            $('#tblClients').DataTable().ajax.reload();
                        })
                        .catch(error => {
                            console.error('Error al eliminar el cliente:', error);  // Manejo de errores
                        });
                }
            });
        }
    </script>
@stop
