<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarroController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //CarroController
Route::get('/catalogo', [CarroController::class, 'index'])->name('catalogo');
Route::post('/carrito/add/{id}', [CarroController::class, 'add'])->name('carrito.add');
Route::get('/carrito', [CarroController::class, 'verCarrito'])->name('carrito.ver');
Route::get('/checkout', [CarroController::class, 'checkout'])->middleware('auth')->name('checkout');