@extends('adminlte::page')

@section('title', 'Detalles de Venta')

@section('content_header')
    {{-- <h1>Detalles de Venta #{{ $venta->id }}</h1> --}}
    <h1>

    </h1>
@stop

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h3>Información General</h3>
    </div>
    <div class="card-body">
        <p><strong>Cliente:</strong> {{ $venta->cliente->name ?? 'Sin cliente' }}</p>
        <p><strong>Correo:</strong> {{ $venta->cliente->email ?? 'Sin correo' }}</p>
        <p><strong>Fecha de Registro:</strong> {{ $venta->cliente->created_at->format('d/m/Y H:i:s') }}</p>
        <p><strong>Fecha de Venta:</strong> {{ $venta->created_at->format('d/m/Y H:i:s') }}</p>
        <p><strong>Monto Total:</strong> ${{ number_format($venta->total, 2) }}</p>
        <p><strong>Estado:</strong>
            <span class="badge bg-{{ $venta->estado === 'pendiente' ? 'warning' : ($venta->estado === 'aprobado' ? 'success' : 'danger') }}">
                {{ ucfirst($venta->estado) }}
            </span>
        </p>
    </div>
</div>




@if($venta->estados ?? false)
<div class="card mb-4">
    <div class="card-header">
        <h3>Historial de Estado</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Estado</th>
                        <th>Fecha/Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venta->estados as $estado)
                        <tr>
                            <td>{{ ucfirst($estado->estado) }}</td>
                            <td>{{ $estado->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif


<div class="d-flex justify-content-end">
    {{-- <a href="{{ route('ventas.editar', $venta->id) }}" class="btn btn-warning me-2">Editar</a> --}}
    <a href="{{ route('ventas.ticket', $venta->id) }}" target="_blank" class="btn btn-primary me-2">Imprimir Recibo</a>
    <form action="{{ route('ventas.eliminar', $venta->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta venta?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
</div>
@stop
