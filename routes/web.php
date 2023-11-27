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

Route::resource('citas', 'CitasController',['except'=>['create','edit']])->names([
    'store' => 'citas.store',
    'index'=>'citas.index'
]);
Route::get('citas-pendientes', 'CitasController@citas_pendientes')->name('citas.pendientes');
Route::get('citas-change-estado/{id}/{valor}', 'CitasController@cambio_estado')->name('cita.update');
Route::get('citas-rechazadas', 'CitasController@citas_rechazadas')->name('citas.rechazadas');
Route::get('prueba_total', 'CitasController@limite_citas');

Route::get('usuarios/{documento}', 'UsuariosController@buscarDocumento')->name('buscar.documento');
Route::get('/', "CitasController@crear_cita");
Route::get('registro', function () {
    return view('dash.registro');
});
Route::get('login', function () {
    return view('dash.login');
});
Route::get('dashboard',"ServiciosController@datasnuestras")->name("dashboard");

Route::post('logins',"UsuariosController@login")->name("login");
Route::post('post_user',"UsuariosController@post_user")->name("post_user");
