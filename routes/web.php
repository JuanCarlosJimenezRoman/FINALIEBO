<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompaniaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\AdminVentaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas web para tu aplicación. Todas estarán
| asignadas al grupo de middleware "web".
|
*/

// Ruta principal para login
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// Grupo de rutas protegidas por middleware 'auth' y 'admin'
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');


    // Rutas del perfil de usuario
    Route::middleware(['auth'])->group(function () {
        // Rutas específicas para usuarios autenticados
        Route::get('/carrito', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
        Route::get('/venta/show', [VentaController::class, 'show'])->name('venta.show');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Recursos
    Route::resource('productos', ProductoController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('usuarios', UsuarioController::class);

    // Listados para DataTables
    Route::get('/listarProductos', [DatatableController::class, 'products'])->name('products.list');
    Route::get('/listarClientes', [DatatableController::class, 'clients'])->name('clients.list');
    Route::get('/listarUsuarios', [DatatableController::class, 'users'])->name('users.list');
    Route::get('/listarCategorias', [DatatableController::class, 'categories'])->name('categories.list');
    Route::get('/listarVentas', action: [DatatableController::class, 'sales'])->name('sales.list');
    Route::resource('categorias', CategoriaController::class);


    // Configuración de la compañía
    Route::prefix('compania')->group(function () {
        Route::get('/', [CompaniaController::class, 'index'])->name('compania.index');
        Route::put('/{compania}', [CompaniaController::class, 'update'])->name('compania.update');
    });

    // Ventas para administradores
    Route::prefix('admin/ventas')->group(function () {
        Route::get('/', [AdminVentaController::class, 'index'])->name('ventas.index');
        Route::get('/list', [AdminVentaController::class, 'listarVentas'])->name('ventas.list');
        Route::get('/{id}/estado', [AdminVentaController::class, 'cambiarEstado'])->name('ventas.cambiarEstado');
        Route::get('/{id}/detalles', [AdminVentaController::class, 'detalles'])->name('ventas.detalles');
    });
});

// Grupo de rutas para usuarios autenticados
Route::middleware(['auth'])->group(function () {
    // Carrito y ventas
    Route::get('/venta/show', [VentaController::class, 'show'])->name('venta.show');
    Route::get('/carrito', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
    Route::post('/carrito/agregar/{producto}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::post('/carrito/remover/{producto}', [CarritoController::class, 'remover'])->name('carrito.remover');
    Route::post('/carrito/comprar', [CarritoController::class, 'finalizarCompra'])->name('carrito.comprar');
    Route::get('/carrito/venta/show', [VentaController::class, 'show'])->name('venta.show');
    Route::get('/carrito/venta/{id}/detalles', [VentaController::class, 'detalles'])->name('venta.detalles');
    Route::get('/carrito/venta/{id}/ticket', [VentaController::class, 'ticket'])->name('venta.ticket');
    Route::delete('/carrito/venta/{id}', [VentaController::class, 'destroy'])->name('venta.eliminar');
    Route::get('/carrito/venta/{id}/editar', [VentaController::class, 'edit'])->name('venta.editar');
    Route::post('/carrito/venta/{id}', [VentaController::class, 'update'])->name('venta.update');
    Route::get('/carrito/venta/{id}/eliminar', [VentaController::class, 'destroy'])->name('venta.eliminar');
    Route::get('/carrito/venta/{id}/editar', [VentaController::class, 'edit'])->name('venta.editar');
    Route::post('/carrito/venta/{id}', [VentaController::class, 'update'])->name('venta.update');
    Route::get('/carrito/venta/{id}/eliminar', [VentaController::class, 'destroy'])->name('venta.eliminar');
    Route::get('/carrito/venta/{id}/editar', [VentaController::class, 'edit'])->name('venta.editar');
    Route::post('/carrito/venta/{id}', [VentaController::class, 'update'])->name('venta.update');
    Route::get('/carrito/venta/{id}/eliminar', [VentaController::class, 'destroy'])->name('venta.eliminar');
    Route::get('/carrito/venta/{id}/editar', [VentaController::class, 'edit'])->name('venta.editar');
    Route::get('/venta/cliente', [VentaController::class, 'buscarCliente'])->name('venta.cliente');
    Route::get('/venta/cliente', [VentaController::class, 'cliente'])->name('venta.cliente');
    Route::post('/', [VentaController::class, 'store'])->name('venta.store');

    Route::get('/ventas/{id}/ticket', [VentaController::class, 'ticket'])->name('ventas.ticket');
    Route::get('/ventas/{id}/detalles', [VentaController::class, 'detalles'])->name('venta.detalles');
    Route::delete('/ventas/{id}', [VentaController::class, 'destroy'])->name('ventas.eliminar');



    Route::prefix('carrito')->group(function () {
        Route::get('/', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
        Route::post('/agregar/{producto}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
        Route::post('/remover/{producto}', [CarritoController::class, 'remover'])->name('carrito.remover');
        Route::post('/comprar', [CarritoController::class, 'finalizarCompra'])->name('carrito.comprar');
        Route::get('/venta/show', [VentaController::class, 'show'])->name('venta.show');
        Route::get('/ventas/{id}/detalles', [VentaController::class, 'detalles'])->name('venta.detalles');
        Route::get('/ventas/{id}/ticket', [VentaController::class, 'ticket'])->name('ventas.ticket');
    });

    Route::prefix('venta')->group(function () {
        Route::get('/', [VentaController::class, 'index'])->name('venta.index');
        Route::get('/{id}/ticket', [VentaController::class, 'ticket'])->name('ventas.ticket');
        Route::delete('/{id}', [VentaController::class, 'destroy'])->name('ventas.eliminar');
        Route::get('/{id}/editar', [VentaController::class, 'edit'])->name('ventas.editar');
        Route::post('/{id}', [VentaController::class, 'update'])->name('ventas.update');
        Route::get('/ventas/{id}/ticket', [VentaController::class, 'ticket'])->name('ventas.ticket');
        Route::get('/{id}/detalles', [VentaController::class, 'detalles'])->name('venta.detalles');
        Route::get('/cliente', [VentaController::class, 'buscarCliente'])->name('venta.cliente');
        Route::get('/cliente', [VentaController::class, 'cliente'])->name('venta.cliente');
        Route::get('/venta/{id}/ticket', [VentaController::class, 'ticket'])->name('ventas.ticket');

    });
});

// Autenticación
require __DIR__ . '/auth.php';
