<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Grupo de rutas para usuarios logueados
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/perfil', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/perfil/password', [App\Http\Controllers\ProfileController::class, 'password'])->name('profile.password');
    Route::delete('/perfil', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('admin/productos', ProductoController::class);
Route::get('admin/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
