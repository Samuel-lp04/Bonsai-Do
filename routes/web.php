<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CarroController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;


Route::get('/', [\App\Http\Controllers\CarroController::class, 'index']);

Auth::routes();
Route::redirect('/home', '/catalogo');
    //CarroController
Route::get('/catalogo', [CarroController::class, 'index'])->name('catalogo');
Route::post('/carrito/add/{id}', [CarroController::class, 'add'])->name('carrito.add');
Route::get('/carrito', [CarroController::class, 'verCarrito'])->name('carrito.ver');
Route::get('/checkout', [CarroController::class, 'checkout'])->middleware('auth')->name('checkout');
Route::get('/mis-pedidos', [CarroController::class, 'misPedidos'])->middleware('auth')->name('mis-pedidos');
Route::post('/comprar', [CarroController::class, 'procesarCompra'])->middleware('auth')->name('comprar.procesar');
Route::post('/direcciones/nueva', [CarroController::class, 'guardarDireccion'])->middleware('auth')->name('direccion.guardar');
Route::post('carrito/update/{id}', [CarroController::class, 'updateCantidad'])->name('carrito.update');
Route::get('pedidos/{id}', [PedidoController::class, 'show'])->name('pedidos.show');

// Grupo de rutas para usuarios logueados
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/perfil', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/perfil/password', [App\Http\Controllers\ProfileController::class, 'password'])->name('profile.password');
    Route::delete('/perfil', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Grupo de rutas EXCLUSIVAS para Administradores
Route::middleware(['auth', \App\Http\Middleware\CheckAdmin::class])->group(function () {
    Route::resource('admin/productos', ProductoController::class);
    Route::get('admin/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
});

