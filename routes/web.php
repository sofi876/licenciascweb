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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/welcome', 'HomeController@inicio')->name('welcome');
//Route::get('/logout', 'LoginController@logout')->name('logout');

/* INICIA CREACION LICENCIAS */
route::get('crearlicencia', 'LicenciasController@viewCrearLicencia')->name('crearlicencia');
route::get('framecrearlicencia', 'LicenciasController@frameCrearLicencia')->name('framecrearlicencia');
/*route::post('bono.crearindividual', 'TarjetasBonoController@CrearTarjetaIndividual')->name('bono.crearindividual');
route::get('autoCompleNumContrato', 'TarjetasBonoController@autoCompleNumContrato')->name('autoCompleNumContrato');
route::get('getNombre', 'TarjetasBonoController@getNombre')->name('getNombre');
route::get('creartarjetasBonoBloque', 'TarjetasBonoController@viewCrearTarjetaBloque')->name('creartarjetasBonoBloque');
route::post('bono.crearbloque', 'TarjetasBonoController@CrearTarjetaBloque')->name('bono.crearbloque');*/
/*FINALIZA CREACION LICENCIAS */

