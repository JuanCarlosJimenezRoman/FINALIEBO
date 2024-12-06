@extends('adminlte::page')

@section('title', 'Productos en Venta')

@section('content')
<div class="container">
    <h1 class="text-center">Catálogo de Libros</h1>
    <div class="row">
        @forelse ($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $producto->foto ? asset('storage/' . $producto->foto) : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="{{ $producto->producto }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->producto }}</h5>
                        <p class="card-text">Precio: ${{ number_format($producto->precio_venta, 2) }}</p>
                        <p class="card-text">Stock: {{ $producto->stock }}</p>
                        <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="number" name="cantidad" value="1" min="1" max="{{ $producto->stock }}" class="form-control" placeholder="Cantidad">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Agregar al Carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">No hay productos disponibles.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
