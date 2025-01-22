@extends('adminlte::page')
<!-- Extiende la plantilla de AdminLTE para dar formato a la página -->

@section('title', 'Dashboard')
<!-- Define el título de la página como "Dashboard" -->

@section('content_header')
    <h1>Libros</h1>
    <!-- Encabezado principal de la página que muestra "Productos" -->
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Libros') }}
                            <!-- Muestra el título de la sección como "Producto" -->
                        </span>
                        <div class="float-right">
                            <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                {{ __('Create New') }}
                            </a>
                            <!-- Botón para crear un nuevo producto, redirige a la vista de creación -->
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
                            id="tblProducts">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Codigo</th>
                                    <th>Libros</th>
                                    <th>Precio/compra</th>
                                    <th>Precio/venta</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                        <!-- Tabla de productos utilizando DataTables, se cargan datos por AJAX -->
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
            new DataTable('#tblProducts', {
                responsive: true,
                fixedHeader: true,
                ajax: {
                    url: '{{ route('products.list') }}',
                    dataSrc: 'data'
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'codigo'
                    },
                    {
                        data: 'producto'
                    },
                    {
                        data: 'precio_compra'
                    },
                    {
                        data: 'precio_venta'
                    },
                    {
                        data: 'foto',
                        render: function(data, type, row) {
                            return data ? '<img src="storage/uploads/' + data +
                                '" alt="Imagen del Producto" style="max-width: 100px; max-height: 100px;">' :
                                'Sin imagen';
                        },


                        // Columna de imagen. Muestra la imagen si existe; de lo contrario, indica "Sin imagen"
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            // Columna para botones de acciones (editar y eliminar)
                            return '<a class="btn btn-sm btn-primary" href="/productos/' + row.id +
                                '/edit">Editar</a>' +
                                '<button class="btn btn-sm btn-danger" onclick="deleteProduct(' +
                                row.id + ')">Eliminar</button>';
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

        // Función para eliminar un producto
        function deleteProduct(productId) {
            Swal.fire({
                title: "Eliminar",
                text: "¿Estás seguro de que quieres eliminar este producto?",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/productos/' + productId, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.text())
                        .then(data => {
                            $('#tblProducts').DataTable().ajax.reload();
                            // Recarga la tabla para actualizar la lista de productos después de eliminar uno
                        })
                        .catch(error => {
                            console.error('Error al eliminar el producto:', error);
                        });
                }
            });
        }
    </script>
@stop
