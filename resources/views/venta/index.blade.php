@extends('adminlte::page')
<!-- Extiende la plantilla de AdminLTE para aplicar el diseño y estilos del panel administrativo -->

@section('title', 'Dashboard')
<!-- Define el título de la página como "Dashboard" -->

@section('content_header')
    <h1>Venta</h1>
    <!-- Encabezado de la página que muestra "Venta" -->
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Nueva venta') }}
                        </span>
                        <div class="float-right">
                            <a href="{{ route('venta.show') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Listar ventas') }}
                            </a>
                            <!-- Botón para navegar a la lista de ventas -->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="buscarCliente">Buscar Cliente</label>
                            <input id="buscarCliente" class="form-control" type="text" placeholder="Buscar Cliente">
                            <input id="id_cliente" class="form-control" type="hidden">
                            <!-- Campo de búsqueda de cliente con autocompletado y campo oculto para guardar el ID del cliente -->
                        </div>

                        <div class="form-group col-md-4">
                            <label for="tel_cliente">Teléfono</label>
                            <input id="tel_cliente" class="form-control" type="text" disabled>
                            <!-- Campo para mostrar el teléfono del cliente, desactivado para evitar cambios -->
                        </div>

                        <div class="form-group col-md-4">
                            <label for="dir_cliente">Direccion</label>
                            <input id="dir_cliente" class="form-control" type="text" disabled>
                            <!-- Campo para mostrar la dirección del cliente, también desactivado -->
                        </div>
                    </div>

                    @livewire('product-list')
                    <!-- Componente Livewire para listar y seleccionar productos en la venta -->

                    <button class="btn btn-primary fixed-button" id="btnVenta" type="button">Generar</button>
                    <!-- Botón para generar la venta -->
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" />
    <!-- Estilos personalizados y de jQuery UI para autocompletado -->
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const btnVenta = document.querySelector('#btnVenta');
        document.addEventListener('DOMContentLoaded', function() {
            $("#buscarCliente").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('venta.cliente') }}",
                        dataType: "json",
                        data: { term: request.term },
                        success: function(data) {
                            if (data.length === 0) {
                                errorCliente.textContent = "No se encontraron resultados.";
                            }
                            response(data);
                        }
                    });
                },
                minLength: 2,
                // Número mínimo de caracteres antes de mostrar sugerencias de autocompletado
                select: function(event, ui) {
                    id_cliente.value = ui.item.id;
                    tel_cliente.value = ui.item.telefono;
                    dir_cliente.value = ui.item.direccion;
                    // Al seleccionar un cliente, se rellenan sus datos en los campos correspondientes
                }
            });

            btnVenta.addEventListener('click', function() {
                if (id_cliente.value == '') {
                    Swal.fire({
                        title: "Respuesta",
                        text: 'El cliente es requerido',
                        icon: 'warning'
                    });
                } else {
                    Swal.fire({
                        title: "Mensaje?",
                        text: "Esta seguro de procesar la venta!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, procesar!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('/venta', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    id_cliente: id_cliente.value
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                Swal.fire({
                                    title: "Respuesta",
                                    text: data.title,
                                    icon: data.icon
                                });
                                if (data.icon == 'success') {
                                    setTimeout(() => {
                                        window.open('/venta/' + data.ticket + '/ticket', '_blank');
                                        window.location.reload();
                                    }, 1500);
                                }
                            })
                            .catch(error => console.error('Error: ', error));
                            // Si la venta es exitosa, abre el ticket en una nueva ventana y recarga la página
                        }
                    });
                }
            });
        });
    </script>
@stop
