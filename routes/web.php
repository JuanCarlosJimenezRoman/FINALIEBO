<?php

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
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [AuthenticatedSessionController::class, 'create'])
                ->name('login');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('productos', ProductoController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('usuarios', UsuarioController::class);

    Route::get('/listarProductos', [DatatableController::class, 'products'])->name('products.list');
    Route::get('/listarClientes', [DatatableController::class, 'clients'])->name('clients.list');
    Route::get('/listarUsuarios', [DatatableController::class, 'users'])->name('users.list');
    Route::get('/listarCategorias', [DatatableController::class, 'categories'])->name('categories.list');
    Route::get('/listarVentas', [DatatableController::class, 'sales'])->name('sales.list');

    Route::get('/compania', [CompaniaController::class, 'index'])->name('compania.index');
    Route::put('/compania/{compania}', [CompaniaController::class, 'update'])->name('compania.update');
    Route::put('/compania/{compania}', [CompaniaController::class, 'update'])->name('compania.update');
    Route::put('/compania', [CompaniaController::class, 'update']);

    Route::get('/venta', [VentaController::class, 'index'])->name('venta.index');
    Route::get('/venta/show', [VentaController::class, 'show'])->name('venta.show');
    Route::get('/venta/cliente', [VentaController::class, 'cliente'])->name('venta.cliente');
    Route::post('/venta', [VentaController::class, 'store'])->name('venta.store');
    Route::get('/venta/{id}/ticket', [VentaController::class, 'ticket'])->name('venta.ticket');

    Route::get('/admin/ventas', [AdminVentaController::class, 'index'])->name('venta.index');
    //Route::get('/ventas', [AdminVentaController::class, 'index'])->name('ventas.index'); // Vista principal
    Route::get('/ventas/list', [AdminVentaController::class, 'listarVentas'])->name('ventas.list'); // Endpoint para DataTables
    Route::post('/ventas/{id}/estado', [AdminVentaController::class, 'cambiarEstado'])->name('ventas.cambiarEstado'); // Cambiar estado
    Route::get('/ventas/{id}/detalles', [AdminVentaController::class, 'detalles'])->name('venta.detalles');
    Route::get('/listarClientes', [DatatableController::class, 'clients'])->name('clients.list');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/productosVenta', [CarritoController::class, 'index'])->name('productos.index');
    Route::post('/carrito/agregar/{producto}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::get('/carrito', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
    Route::post('/carrito/comprar', [CarritoController::class, 'finalizarCompra'])->name('carrito.comprar');
    Route::post('/carrito/remover/{producto}', [CarritoController::class, 'remover'])->name('carrito.remover');
Route::post('/carrito/comprar', [CarritoController::class, 'finalizarCompra'])->name('carrito.comprar');
Route::get('/venta', [CarritoController::class, 'index'])->name('productosVenta.index');
Route::get('/productosVenta', [CarritoController::class, 'index'])->name('productosVenta');
Route::get('/sales/list', [AdminVentaController::class, 'index'])->name('sales.list');
Route::post('/ventas/{id}/estado', [AdminVentaController::class, 'cambiarEstado'])->name('ventas.estado');
Route::get('/ventas', [AdminVentaController::class, 'index'])->name('venta.index');

// Ruta para editar la venta
Route::get('/ventas/{id}/editar', [VentaController::class, 'edit'])->name('ventas.editar');
Route::post('/ventas/{id}', [AdminVentaController::class, 'update'])->name('ventas.update');
// Ruta para imprimir recibo
Route::get('/ventas/{id}/ticket', [VentaController::class, 'ticket'])->name('ventas.ticket');

// Ruta para eliminar la venta
Route::delete('/ventas/{id}', [VentaController::class, 'destroy'])->name('ventas.eliminar');

});



require __DIR__ . '/auth.php';
