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

Route::resource('profesionales', 'ProfesionalesController',['except'=>['create','edit']])->names([
    'store' => 'profesional.store',
    'index'=>'profesional.index'
]);

Route::resource('citas', 'CitasController',['except'=>['create','edit']])->names([
    'store' => 'citas.store',
    'index'=>'citas.index'
]);
Route::get('citas-pendientes/{id}', 'CitasController@citas_pendientes')->name('citas.pendientes');
Route::get('citas-change-estado/{id}/{valor}', 'CitasController@cambio_estado')->name('cita.update');
Route::get('citas-rechazadas', 'CitasController@citas_rechazadas')->name('citas.rechazadas');
Route::get('citas-espera', 'CitasController@citas_espera')->name('citas.espera');

Route::get('citas-canceladas', 'CitasController@citas_canceladas')->name('citas.canceladas');
Route::get('prueba_total', 'CitasController@limite_citas');

Route::get('usuarios/{documento}', 'UsuariosController@buscarDocumento')->name('buscar.documento');
Route::get('/', "CitasController@crear_cita");
Route::get('registro', function () {
    return view('dash.registro');
});
Route::get('login', function () {
    return view('dash.login');
})->name('logina');
Route::get('dashboard',"ServiciosController@datasnuestras")->name("dashboard");
Route::get('deleteservice/{id}',"ServiciosController@destroy")->name("servicio.eliminar");
Route::get('deleteuser/{id}',"UsuariosController@destroy")->name("usuario.eliminar");
Route::get('editar-usuario/{id}',"UsuariosController@edit")->name("usuario.editar");
Route::get('editar-servicio/{id}',"ServiciosController@edit")->name("servicio.editar");

Route::post('post_user',"UsuariosController@post_user")->name("post_user");
Route::get('create_admin',"UserController@index");
Route::post('update/{id}',"UsuariosController@update")->name("usuario.actualizar");
Route::post('update_service/{id}',"ServiciosController@update")->name("servicio.actualizar");

Route::post('logins',"UserController@login")->name("login");

Route::get('credenciales',"UserController@edit")->name("users.edit");
Route::post('cambio/{id}',"UserController@update")->name("users.actualizar");

Route::get('deleteprofesional/{id}',"ProfesionalesController@destroy")->name("profesional.eliminar");
Route::get('deletecita/{id}',"CitasController@destroy")->name("citausuario.eliminar");

Route::get('citadash',"CitasController@crear_cita_dash")->name("ccitadash");
Route::get('editarprofesional/{id}',"ProfesionalesController@edit")->name("profesional.editar");
Route::post('profesionalactualizar/{id}',"ProfesionalesController@update")->name("profesional.actualizar");
Route::get('horas_disponibles/{id_servicio}/{fecha_consulta}', "CitasController@horas_disponibles")->name("cita.hora_disponible");