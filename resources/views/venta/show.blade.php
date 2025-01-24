@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1 style="color: var(--color-primary); font-weight: bold;">Ventas</h1>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">
">
    <div class="col-sm-12">
        <div class="card shadow-sm" style="border: 2px solid var(--color-primary);">
            <div class="card-header" style="background-color: var(--color-primary); color: var(--color-white);">
                <h3 class="card-title">Listado de Ventas</h3>
            </div>
            <div class="card-body" style="background-color: var(--color-gray-light);">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tblVentas" style="border: 1px solid var(--color-primary);">
                        <thead style="background-color: var(--color-primary); color: var(--color-white);">
                            <tr>
                                <th>Id</th>
                                <th>Monto</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom-theme.css') }}">
@stop

@section('js')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tblVentas').DataTable({
                responsive: true,
                fixedHeader: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('sales.list') }}',
                columns: [
                    { data: 'id' },
                    { data: 'total' },
                    {
                        data: 'cliente.name',
                        defaultContent: 'Sin cliente'
                    },
                    {
                        data: 'created_at',
                        render: function(data) {
                            return new Date(data).toLocaleString();
                        }
                    },
                    {
                        data: 'estado',
                        render: function(data, type, row) {
                            const badgeClass = data === 'pendiente' ? 'badge-warning' :
                                               data === 'aprobado' ? 'badge-success' : 'badge-danger';
                            const badgeColor = data === 'pendiente' ? 'var(--color-secondary)' :
                                               data === 'aprobado' ? 'var(--color-primary)' : 'var(--color-accent)';
                            return `<span class="badge ${badgeClass}" style="background-color: ${badgeColor}; color: var(--color-white);">${data}</span>`;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-success btn-sm" style="background-color: var(--color-primary); color: var(--color-white);" onclick="cambiarEstado(${row.id}, 'aprobado')">Aprobar</button>
                                <button class="btn btn-danger btn-sm" style="background-color: var(--color-accent); color: var(--color-white);" onclick="cambiarEstado(${row.id}, 'cancelado')">Cancelar</button>
                                <a href="/ventas/${row.id}/detalles" class="btn btn-primary btn-sm" style="background-color: var(--color-secondary); color: var(--color-white);">Detalles</a>
                            `;
                        }
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
                },
                order: [[0, 'desc']]
            });
        });

        function cambiarEstado(id, estado) {
            Swal.fire({
                title: `¿Estás seguro de cambiar el estado a ${estado}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, cambiar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/ventas/${id}/estado`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ estado: estado })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Error HTTP: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire('¡Actualizado!', 'El estado ha sido actualizado.', 'success');
                            $('#tblVentas').DataTable().ajax.reload();
                        } else {
                            Swal.fire('Error', data.error || 'No se pudo actualizar el estado.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Ocurrió un error en la solicitud.', 'error');
                    });
                }
            });
        }
    </script>
@stop
