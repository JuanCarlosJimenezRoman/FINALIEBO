@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 style="color: var(--color-primary); font-weight: bold;">Inicio</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Info boxes -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="info-box shadow-sm" style="border: 2px solid var(--color-primary);">
                    <span class="info-box-icon" style="background-color: var(--color-primary); color: var(--color-white);">
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="color: var(--color-primary);">Clientes</span>
                        <span class="info-box-number" style="color: var(--color-accent);">{{ $totales['clients'] }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="info-box shadow-sm" style="border: 2px solid var(--color-primary);">
                    <span class="info-box-icon" style="background-color: var(--color-secondary); color: var(--color-white);">
                        <i class="fas fa-list"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="color: var(--color-primary);">Productos</span>
                        <span class="info-box-number" style="color: var(--color-accent);">{{ $totales['products'] }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="info-box shadow-sm" style="border: 2px solid var(--color-primary);">
                    <span class="info-box-icon" style="background-color: var(--color-accent); color: var(--color-white);">
                        <i class="fas fa-tags"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="color: var(--color-primary);">Categorías</span>
                        <span class="info-box-number" style="color: var(--color-accent);">{{ $totales['categories'] }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="info-box shadow-sm" style="border: 2px solid var(--color-primary);">
                    <span class="info-box-icon" style="background-color: var(--color-secondary); color: var(--color-white);">
                        <i class="fas fa-cash-register"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="color: var(--color-primary);">Ventas</span>
                        <span class="info-box-number" style="color: var(--color-accent);">{{ $totales['sales'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Gráfico: Ventas por semana -->
            <div class="col-lg-6 col-md-12">
                <div class="card shadow-sm" style="border: 2px solid var(--color-primary);">
                    <div class="card-header" style="background-color: var(--color-primary); color: var(--color-white);">
                        <h3 class="card-title">VENTAS POR SEMANA</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus" style="color: var(--color-white);"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times" style="color: var(--color-white);"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="ventasPorSemana" width="804" height="375"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráfico: Ventas por mes -->
            <div class="col-lg-6 col-md-12">
                <div class="card shadow-sm" style="border: 2px solid var(--color-primary);">
                    <div class="card-header" style="background-color: var(--color-primary); color: var(--color-white);">
                        <h3 class="card-title">VENTAS POR MES</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus" style="color: var(--color-white);"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times" style="color: var(--color-white);"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="ventasPorMes" width="804" height="375"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        ventasSemana();
        // Configura los colores para los gráficos
        var chartColors = {
            primary: 'rgba(40, 92, 77, 0.7)', // Color principal
            secondary: 'rgba(179, 142, 93, 0.7)', // Color secundario
            accent: 'rgba(157, 36, 73, 0.7)' // Color acento
        };

        // Gráfico: Ventas por mes
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
                            backgroundColor: chartColors.primary,
                            borderWidth: 1
                        };
                    })
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        }

        // Gráfico: Ventas por semana
        function ventasSemana() {
            var ctx = document.getElementById('ventasPorSemana').getContext('2d');
            var data = {!! json_encode($ventasPorSemana) !!};
            var labels = data.map(item => item.dia);
            var valores = data.map(item => item.total);

            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Ventas por día',
                        data: valores,
                        backgroundColor: chartColors.secondary,
                        borderColor: chartColors.secondary,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        }
    </script>
@stop
