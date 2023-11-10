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



Route::resource('servicios', 'ServiciosController',['except'=>['create','edit']])->names([
    'index' => 'servicios.index'
]);;
Route::resource('usuario', 'UsuariosController',['except'=>['create','edit']])->names([
    'store' => 'usuario.store',
    'index'=>'usuario.index'
]);
Route::get('usuarios/{documento}', 'UsuariosController@buscarDocumento')->name('buscar.documento');
Route::get('/', "CitasController@crear_cita");
Route::get('registro', function () {
    return view('dash.registro');
});
Route::get('login', function () {
    return view('dash.login');
});
Route::get('dashboard', function () {
    return view('dash.inicio');
})->name("dashboard");

Route::post('logins',"UsuariosController@login")->name("login");
Route::post('post_user',"UsuariosController@post_user")->name("post_user");
