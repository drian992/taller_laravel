<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\Auth\LoginController; // minimal change.
use App\Http\Controllers\Auth\RegisterController; // minimal change.
use App\Http\Controllers\PersonasController;
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

Route::middleware('guest')->group(function () {
    // minimal change.
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::post('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout'); // minimal change.

Route::middleware('auth')->group(function () {
    // minimal change.
    Route::view('/dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // minimal change.
    Route::resource('categorias', CategoriasController::class);
    Route::post('categorias/restaurar/{categoria}', [CategoriasController::class, 'restaurar'])->name('categorias.restaurar');
    Route::resource('personas', PersonasController::class)->except(['create', 'store', 'show']);
    Route::post('personas/{persona}/restaurar', [PersonasController::class, 'restaurar'])->name('personas.restaurar');
    Route::delete('personas/{persona}/eliminar-definitivo', [PersonasController::class, 'eliminarDefinitivo'])->name('personas.eliminar-definitivo');
    Route::get('usuarios/registrar', [RegisterController::class, 'showAdminRegistrationForm'])->name('admin.users.create');
    Route::post('usuarios/registrar', [RegisterController::class, 'registerFromAdmin'])->name('admin.users.store');
});
/*Route::get('categorias',        [CategoriasController::class, 'index'])->name('categorias.index');
Route::get('categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');
Route::post('categorias',       [CategoriasController::class, 'store'])->name('categorias.store');
Route::get('categorias/{categoria}', [CategoriasController::class, 'show'])->name('categorias.show');
Route::get('categorias/{categoria}/edit', [CategoriasController::class, 'edit'])->name('categorias.edit');
Route::match(['put','patch'], 'categorias/{categoria}', [CategoriasController::class, 'update'])->name('categorias.update');
Route::delete('categorias/{categoria}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');*/
