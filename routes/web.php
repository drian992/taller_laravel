<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('categorias', CategoriasController::class);
//Route::resource('empleados', EmpleadosController::class);
//Route::resource('categorias', CategoriasController::class)->only(['index','create','store']);
Route::post('categorias/restaurar/{categoria}',       [CategoriasController::class, 'restaurar'])->name('categorias.restaurar');
/*Route::get('categorias',        [CategoriasController::class, 'index'])->name('categorias.index');
Route::get('categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');
Route::post('categorias',       [CategoriasController::class, 'store'])->name('categorias.store');
Route::get('categorias/{categoria}', [CategoriasController::class, 'show'])->name('categorias.show');
Route::get('categorias/{categoria}/edit', [CategoriasController::class, 'edit'])->name('categorias.edit');
Route::match(['put','patch'], 'categorias/{categoria}', [CategoriasController::class, 'update'])->name('categorias.update');
Route::delete('categorias/{categoria}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');*/
