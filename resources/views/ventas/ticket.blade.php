<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket de Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            width: 80mm;
            margin: 0 auto;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .bold {
            font-weight: bold;
        }
        .divider {
            border-top: 1px solid #000;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 5px 0;
        }
        .product-table td {
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <h3>{{ $company->nombre }}</h3>
        <p>{{ $company->direccion }}</p>
        <p>Tel: {{ $company->telefono }}</p>
    </div>
    <div class="divider"></div>
    <p><strong>Fecha:</strong> {{ $fecha }}</p>
    <p><strong>Hora:</strong> {{ $hora }}</p>
    <p><strong>Venta ID:</strong> #{{ $venta->id }}</p>
    <div class="divider"></div>
    <p><strong>Cliente:</strong> {{ $venta->cliente->name ?? 'Sin cliente' }}</p>
    <p><strong>Teléfono:</strong> {{ $venta->cliente->telefono ?? 'N/A' }}</p>
    <p><strong>Dirección:</strong> {{ $venta->cliente->direccion ?? 'N/A' }}</p>
    <div class="divider"></div>
    <table class="product-table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cant.</th>
                <th>P.U.</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->producto->producto ?? 'Producto eliminado' }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>${{ number_format($producto->cantidad * $producto->precio, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="divider"></div>
    <p class="text-right"><strong>Total: ${{ number_format($venta->total, 2) }}</strong></p>
    <p class="text-center">¡Gracias por su compra!</p>
</body>
</html>
