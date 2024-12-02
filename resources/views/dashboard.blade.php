@extends('adminlte::page')
<!-- Extiende la plantilla de AdminLTE para aplicar el diseño y estilos del panel administrativo -->

@section('title', 'Dashboard')
<!-- Define el título de la página como "Dashboard" -->

@section('content_header')
    <h1>Inicio</h1>
    <!-- Encabezado de la página que muestra "Dashboard" -->
@stop

@section('content')
    <div class="row">
        <!-- Muestra los "info boxes" con estadísticas rápidas de clientes, productos, categorías y ventas -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Clientes</span>
                    <span class="info-box-number">{{ $totales['clients'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-primary"><i class="fas fa-list"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Productos</span>
                    <span class="info-box-number">{{ $totales['products'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-warning"><i class="fas fa-tags"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Categorias</span>
                    <span class="info-box-number">{{ $totales['categories'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-info"><i class="fas fa-cash-register"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Ventas</span>
                    <span class="info-box-number">{{ $totales['sales'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Gráficos de ventas por semana y por mes -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">VENTAS POR SEMANA</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="ventasPorSemana" width="804" height="375"></canvas>
                    </div>
                    <!-- Gráfico de barras de ventas por semana usando Chart.js -->
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">VENTAS POR MES</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="ventasPorMes" width="804" height="375"></canvas>
                    </div>
                    <!-- Gráfico de barras de ventas por mes usando Chart.js -->
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        ventasSemana()
        // Obtiene y grafica datos de ventas por mes
        var dataVenta = @json($ventas);
        if (dataVenta && Object.keys(dataVenta).length > 0) {
            var ctx = document.getElementById('ventasPorMes').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(dataVenta[Object.keys(dataVenta)[0]]),
                    datasets: Object.keys(dataVenta).map(function(year) {
                        return {
                            label: year,
                            data: Object.values(dataVenta[year]),
                            backgroundColor: 'rgb(75, 192, 192)',
                            borderWidth: 1
                        };
                    })
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Función para crear el gráfico de ventas por semana
        function ventasSemana() {
            var ctx = document.getElementById('ventasPorSemana').getContext('2d');
            var data = {!! json_encode($ventasPorSemana) !!}; // Datos de ventas semanales en JSON desde PHP
            var labels = data.map(function (item) {
                return item.dia;
            });

            var valores = data.map(function (item) {
                return item.total;
            });

            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Ventas por día',
                        data: valores,
                        backgroundColor: 'rgb(150, 100, 80)',
                        borderColor: 'rgb(150, 100, 80)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
@stop
