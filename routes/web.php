<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

Route::get('/publicaciones/filtrado', [PublicacionController::class, 'filtrado'])->name('publicaciones.filtrado');
Route::get('/publicaciones/crear', [PublicacionController::class, 'create'])->name('publicaciones.create');
Route::post('/publicaciones/crear', [PublicacionController::class, 'store'])->name('publicaciones.store');
Route::get('/publicaciones/{id}/comentario', [PublicacionController::class, 'show'])->name('publicaciones.show')->whereNumber('id');
Route::get('/publicaciones/{id}/editar', [PublicacionController::class, 'edit'])->name('publicaciones.edit')->whereNumber('id');
Route::put('/publicaciones/{id}/editar', [PublicacionController::class, 'update'])->name('publicaciones.update')->whereNumber('id');
Route::delete('/publicaciones/{id}/eliminar', [PublicacionController::class, 'destroy'])->name('publicaciones.destroy')->whereNumber('id');


Route::post('/publicaciones/{id}/comentarios/crear', [ComentarioController::class, 'store'])->name('comentarios.store')->whereNumber('id');
Route::get('/publicaciones/{id}/comentarios/ver', [ComentarioController::class, 'show'])->name('comentarios.show')->whereNumber('id');
Route::delete('/publicaciones/{id}/comentarios/eliminar', [ComentarioController::class, 'destroy'])->name('comentarios.destroy')->whereNumber('id');


Route::get('/publicaciones/categorias/admin', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/publicaciones/categorias/admin', [CategoriaController::class, 'create'])->name('categorias.create');
Route::post('/publicaciones/categorias/crear', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/publicaciones/categorias/ver', [CategoriaController::class, 'show'])->name('categorias.show');
Route::get('/publicaciones/{id}/categorias/editar', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/publicaciones/{id}/categorias/editar', [CategoriaController::class, 'update'])->name('categorias.update')->whereNumber('id');
Route::delete('/publicaciones/{id}/categorias/eliminar', [CategoriaController::class, 'destroy'])->name('categorias.destroy')->whereNumber('id');


require __DIR__.'/auth.php';
