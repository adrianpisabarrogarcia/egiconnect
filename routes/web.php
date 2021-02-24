<?php

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

//LOGIN, REGISTRO Y RECUPERACIÓN DE PASSWORD
//LOGIN
    //muestro
Route::get('/','ControladorLogin@index')->name('login.home');
    //accedo
Route::post('/','ControladorLogin@show')->name('login.enter');
//Route::post('/','ControladorLogin@show')->name('login.auth');

Route::view("/register", "/login/register")->name('registro');

//PASS
Route::view("/solicitarContrasena", "/login/cambiarContrasena")->name("solicitarContrasena");
Route::post("/recuperarContrasena", "perfilUsuarioController@recuperarContrasena")->name("recuperarContrasena");

