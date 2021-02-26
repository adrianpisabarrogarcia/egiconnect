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
// REGISTRO
    //muestro
Route::view("/register", "/login/register")->name('registro');
    //envío datos
Route::post("/register", "ControladorLogin@store")->name('registro.enter');
//PASS
    //muestro
Route::view("/solicitarContrasena", "/login/cambiarContrasena")->name("solicitarContrasena");
    //envío datos
Route::post("/recuperarContrasena", "perfilUsuarioController@recuperarContrasena")->name("recuperarContrasena");
// CHAT ENVÍO MENSAJES AJAX
Route::post("/proyecto/chat", "proyectoController@chat")->name("insertarMensaje");



//VISTAS
Route::view("/index", "index")->name('index');
Route::get("/proyecto/{id}", "proyectoController@show")->name('proyecto');
Route::get("/perfil", "perfilUsuarioController@listarUsuario")->name('perfil');


//PROYECTO
Route::post("/crearProyecto", "proyectoController@crearProyecto")->name("crearProyecto");
Route::post("/unirseProyecto", "proyectoController@unirseProyecto")->name("unirseProyecto");

//PERFIL
Route::post("/actualizarPerfil", "perfilUsuarioController@actualizar")->name("actualizarPerfil");
Route::post("/cambiarContrasena", "perfilUsuarioController@cambiarContrasena")->name("cambiarContrasena");
