<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket de Pedido</title>
    <style>
        @page {
            size: letter; /* Tamaño carta */
            margin: 1in; /* Márgenes de 1 pulgada */
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px; /* Tamaño de fuente ajustado */
            margin: 0;
            padding: 0;
        }

        .text-center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            font-size: 12px;
            text-align: left;
            padding: 5px;
            border: 1px solid #ddd; /* Bordes claros para la tabla */
        }

        th {
            font-weight: bold;
            background-color: #f5f5f5; /* Fondo gris claro para encabezados */
        }

        .footer {
            margin-top: 20px;
            text-align: center;
        }

        .total {
            font-size: 14px;
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <div>
        <div class="text-center">
            <h2 class="bold">{{ $company->nombre ?? 'INSTITUTO DE ESTUDIO DE BACHILLERATO DE OAXACA' }}</h2>
            <p>{{ $company->direccion ?? 'Dalias 321, Reforma, 68050 Oaxaca de Juárez, Oax.' }}</p>
            <p>Tel: {{ $company->telefono ?? '951 518 6601' }}</p>
            <p>{{ $company->direccion ?? 'Recibo de Diario de Aprendizaje' }}</p>
        </div>
        <div class="divider"></div>
        <p><strong>Fecha:</strong> {{ $fecha ?? 'Fecha no disponible' }}</p>
        <p><strong>Hora:</strong> {{ $hora ?? 'Hora no disponible' }}</p>
        <p><strong>Venta ID:</strong> #{{ $venta->id ?? 'ID no disponible' }}</p>
        <div class="divider"></div>
        <p><strong>Cliente:</strong> {{ $venta->cliente->name ?? 'Sin cliente' }}</p>
        <p><strong>Teléfono:</strong> {{ $venta->cliente->telefono ?? 'N/A' }}</p>
        <p><strong>Dirección:</strong> {{ $venta->cliente->direccion ?? 'N/A' }}</p>
        <p><strong>Plantel Educativo:</strong> {{ $venta->cliente->plante_educativo ?? 'N/A' }}</p>
<p><strong>Región:</strong> {{ $venta->cliente->region ?? 'N/A' }}</p>
        <div class="divider"></div>
        <table>
            <thead>
                <tr>
                    <th>Diario</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
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
        <p class="total">Total: ${{ number_format($venta->total ?? 0, 2) }}</p>
        <div class="footer">
            <p>¡Gracias por su compra!</p>
            <p>www.sitioweb.com</p>
        </div>
    </div>
</body>
</html>

