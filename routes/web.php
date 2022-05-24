<?php

use App\Http\Livewire\Facturas;
use App\Http\Livewire\Permisos;
use App\Http\Livewire\Roles;
use App\Http\Livewire\Suministros;
use App\Http\Livewire\Usuarios;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Grupo de rutas del rol admin.
    Route::group([
        'middleware' => ['role:admin'],
        'prefix' => 'admin',
        'as' => 'admin.'
        ], function() {

        Route::get('/usuarios', Usuarios::class)->name('usuarios');
        Route::get('/roles', Roles::class)->name('roles');
        Route::get('/permisos', Permisos::class)->name('permisos');
        Route::get('/suministros', Suministros::class)->name('suministros');
        Route::get('/facturas', Facturas::class)->name('facturas');

    });

});
