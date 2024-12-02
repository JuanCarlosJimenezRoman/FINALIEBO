@extends('adminlte::page')

@section('title', 'Dashboard')  <!-- Define el título de la página como "Dashboard" -->

@section('content_header')
    <h1>Categorias</h1>  <!-- Encabezado principal de la sección de categorías -->
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <!-- Título de la tarjeta -->
                        <span id="card_title">
                            {{ __('Categoria') }}
                        </span>
                        <div class="float-right">
                            <!-- Botón para crear una nueva categoría, que enlaza a la vista de creación -->
                            <a href="{{ route('categorias.create') }}" class="btn btn-primary btn-sm float-right"
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
                        <!-- Tabla para mostrar las categorías con estilo responsivo y soporte para exportación y búsquedas -->
                        <table class="table table-striped table-hover display responsive nowrap" width="100%"
                            id="tblCategories">
                            <thead class="thead">
                                <tr>
                                    <th>Id</th>  <!-- Columna para ID de la categoría -->
                                    <th>Nombre</th>  <!-- Columna para el nombre de la categoría -->
                                    <th></th>  <!-- Columna vacía para botones de acciones -->
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
    <!-- Estilos CSS para DataTables y estilos personalizados -->
    <link href="DataTables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('js')
    <!-- Scripts necesarios: SweetAlert2 y DataTables -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="DataTables/datatables.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inicializa la tabla de categorías con DataTables
            new DataTable('#tblCategories', {
                responsive: true,
                fixedHeader: true,
                ajax: {
                    url: '{{ route('categories.list') }}',  // Ruta que provee los datos para la tabla
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'id' },  // Columna para mostrar el ID
                    { data: 'nombre' },  // Columna para mostrar el nombre
                    {
                        // Columna para los botones de editar y eliminar
                        data: null,
                        render: function(data, type, row) {
                            return '<a class="btn btn-sm btn-primary" href="/categorias/' +
                                row.id + '/edit">Editar</a>' +
                                '<button class="btn btn-sm btn-danger" onclick="deleteCategory(' +
                                row.id + ')">Eliminar</button>';
                        }
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',  // Traducción al español
                },
                order: [ [0, 'desc'] ]  // Ordena la tabla por el ID en orden descendente
            });
        });

        // Función para eliminar una categoría utilizando SweetAlert2 para confirmar
        function deleteCategory(clientId) {
            Swal.fire({
                title: "Eliminar",
                text: "¿Estás seguro de que quieres eliminar este categoria?",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Sí, bórralo!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realiza una solicitud DELETE al servidor para eliminar la categoría
                    fetch('/categorias/' + clientId, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                        })
                        .then(response => response.text())
                        .then(data => {
                            // Recarga la tabla después de eliminar la categoría
                            $('#tblCategories').DataTable().ajax.reload();
                        })
                        .catch(error => {
                            console.error('Error al eliminar el categoria:', error);  // Manejo de errores
                        });
                }
            });
        }
    </script>
@stop
