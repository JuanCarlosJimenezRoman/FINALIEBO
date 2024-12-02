@extends('adminlte::page')
<!-- Extiende la plantilla de AdminLTE para aplicar el diseño y estilos del panel administrativo -->

@section('title', 'Dashboard')
<!-- Define el título de la página como "Inicio" -->

@section('content_header')
    <h1>Ventas</h1>
    <!-- Encabezado de la página que muestra "Ventas" -->
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('ventas') }}
                        </span>
                        <!-- Título de la tarjeta para indicar que se está viendo la lista de ventas -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover display responsive nowrap" width="100%"
                            id="tblVentas">
                            <thead class="thead">
                                <tr>
                                    <th>Id</th>
                                    <th>Monto</th>
                                    <th>Cliente</th>
                                    <th>Fecha/Hora</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                        <!-- Tabla de ventas usando DataTables para mostrar datos de forma interactiva y dinámica -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Incluye estilos personalizados y CSS de DataTables para la tabla -->
@endsection

@section('js')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new DataTable('#tblVentas', {
                responsive: true,
                fixedHeader: true,
                ajax: {
                    url: '{{ route('sales.list') }}',
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'id' },
                    { data: 'total' },
                    { data: 'nombre' },
                    { data: 'created_at' },
                    {
                        // Columna de acciones con un botón para ver el ticket de la venta
                        data: null,
                        render: function(data, type, row) {
                            return '<a class="btn btn-sm btn-primary" target="_blank" href="/venta/' +
                                row.id + '/ticket">Ticket</a>';
                        }
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
                    // Traduce DataTables al español
                },
                order: [
                    [0, 'desc']
                ]
                // Ordena la tabla de forma descendente por ID
            });
        });
    </script>
@stop
