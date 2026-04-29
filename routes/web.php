<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Todas las rutas que metas dentro de este grupo estarán protegidas por el portero automáticamente
Route::middleware([\App\Http\Middleware\CheckAdmin::class])->group(function () {
    
    Route::get('/admin/panel', function () {
        return "Panel principal de admin";
    });

    Route::get('/admin/crear-producto', function () {
        // Aquí iría el controlador de Daniel para crear bonsáis
        return "Página para añadir bonsáis";
    });

});
