<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/welcome', 'HomeController@inicio')->name('welcome');
    Route::get('/CambiarPassword', 'HomeController@viewCambiarPassword')->name('mostrarcambiarpassword');
    route::post('/CambiarPassword', 'HomeController@funcionCambiarPassword')->name('cambiarPassword');

    /*INICIA GESTION DE USUARIOS */
    route::get('/CrearUsuario', 'usuariosController@verCrearUsuario')->name('crearUsuario');
    route::post('Usuarios/crear', 'usuariosController@funcionCrearUsuario')->name('funcionCrearUsuario');
    Route::get('usuarios/lista', 'usuariosController@consultarUsuarios')->name('consultarUsuarios');
    //Route::get('usuarios/lista', 'usuariosController@gridConsultarUsuarios')->name('gridConsultarUsuarios');
//Route::get('/logout', 'LoginController@logout')->name('logout');
    /* FINALIZA GESTIÓN DE USUARIOS*/

    /* INICIA CREACION LICENCIAS */
    route::get('crearlicencia', 'LicenciasController@viewCrearLicencia')->name('crearlicencia');
    route::get('framecrearlicencia', 'LicenciasController@frameCrearLicencia')->name('framecrearlicencia');
    route::post('licencias/crear', 'LicenciasController@funcionCrearLicencia')->name('funcioncrearlicencia');

    /*FINALIZA CREACION LICENCIAS */

});
