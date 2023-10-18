<?php

use App\Http\Controllers\ConversasController;
use App\Http\Controllers\MensagensController;
use App\Http\Controllers\UsuarioController;
use App\Http\Middleware\Autenticador;
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

Route::resource('/usuarios',UsuarioController::class);
Route::resource('/conversas',ConversasController::class)->middleware(Autenticador::class);
Route::resource('/mensagens',MensagensController::class)->middleware(Autenticador::class);
Route::get('/token',[UsuarioController::class,'token']);

Route::get('/login',[UsuarioController::class,'login'])->name('login');

Route::post('/login',[UsuarioController::class,'fazerlogin'])->name('fazerlogin');
Route::get('/logout',[UsuarioController::class,'logout'])->name('logout');




    Route::get('/', function () {
        return "ola";
    })->middleware(Autenticador::class);

// Route::get('/Conversas',::class)