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
Route::get('datatable_es', 'IdiomaDataTableController@espanol')->name('datatable_es');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/welcome', 'HomeController@inicio')->name('welcome');
    Route::get('/CambiarPassword', 'HomeController@viewCambiarPassword')->name('mostrarcambiarpassword');
    route::post('/CambiarPasswordf', 'HomeController@funcionCambiarPassword')->name('cambiarPassword');

    /*INICIA GESTION DE USUARIOS */
    route::get('/CrearUsuario', 'usuariosController@verCrearUsuario')->name('crearUsuario');
    route::post('Usuarios/crear', 'usuariosController@funcionCrearUsuario')->name('funcionCrearUsuario');
    Route::get('usuarios/lista', 'usuariosController@consultarUsuarios')->name('consultarUsuarios');
    Route::get('usuarios/listaf', 'usuariosController@gridConsultarUsuarios')->name('gridConsultarUsuarios');
    route::get('/EditarUsuario/{id}', 'usuariosController@verEditarUsuario')->name('editarUsuario');
    route::post('Usuarios/editar/{id}', 'usuariosController@funcionEditarUsuario')->name('funcionEditarUsuario');
    /* FINALIZA GESTIÓN DE USUARIOS*/

    /* INICIA LICENCIAS */
    route::get('crearlicencia', 'LicenciasController@viewCrearLicencia')->name('crearlicencia');
    route::get('framecrearlicencia', 'LicenciasController@frameCrearLicencia')->name('framecrearlicencia');
    route::post('licencias/crear', 'LicenciasController@funcionCrearLicencia')->name('funcioncrearlicencia');

    Route::get('licencias/lista', 'LicenciasController@verConsultarLicencias')->name('consultarLicencias');
    Route::get('licencias/filtro','LicenciasController@verConsultarLicenciasFiltro')->name('consultarLicenciasFiltro');
    //Route::post('tarjetas/bono/consultarporempresa','TarjetasBonoController@ConsultaxEmpresa')->name('bono.consultaxempresap');
    Route::post('licencias/filtroxlicencia','LicenciasController@consultarxlicencia')->name('consultarxLicencia');
    Route::get('licencias/listaf', 'LicenciasController@gridConsultarLicencias')->name('gridConsultarLicencias');
    Route::post('licencias/listafiltro', 'LicenciasController@gridConsultarLicenciasFiltro')->name('gridConsultarLicenciasFiltro');

    route::get('editarlicencia/{id}', 'LicenciasController@viewEditarLicencia')->name('editarlicencia');
    route::get('frameeditarlicencia/{id}', 'LicenciasController@frameEditarLicencia')->name('frameeditarlicencia');
    route::post('Licencias/editar/{id}', 'LicenciasController@funcionEditarLicencia')->name('funcionEditarLicencia');

    Route::get('Licencias/reporte/exportarexcel','LicenciasController@generarReporteExcel')->name('excelLicencias');

    Route::get('getmodalidades', function (\Illuminate\Http\Request $request){
        return \DB::table('modalidad')->where('cod_tipo_licencia',$request->data)->get();
    })->name('modalidades');
    Route::get('getmultiple', function (\Illuminate\Http\Request $request){
        $result = [];
        $eltipo= \DB::table('tipo_licencia')->select('varias_modalidades')->where('cod_tipo_licencia',$request->data)->first();
        $result['esmultiple'] = $eltipo->varias_modalidades;
        return $result;
    })->name('multiples');

    /*FINALIZA LICENCIAS */

    /* INICIA  DENUNCIAS */
    Route::get('denuncias/filtro','DenunciasController@verFiltroDenuncias')->name('consultarDenunciasFiltro');
    Route::post('denuncias/filtroxfecha','DenunciasController@consultarxFecha')->name('consultarxFecha');
    Route::post('denuncias/listafiltro', 'DenunciasController@gridConsultarDenunciasFiltro')->name('gridConsultarDenunciasFiltro');

    Route::get('denuncias/ver/{id}', 'DenunciasController@viewEditarDenuncia')->name('editarDenuncia');
    Route::post('denuncias/editar/{id}', 'DenunciasController@funcionEditarDenuncia')->name('funcionEditarDenuncia');
    /*FINALIZA DENUNCIAS*/
    /* INICIA  TRAZABILIDAD LICENCIA */
    Route::get('Licencias/trazabilidad/{id}', 'LicenciasController@viewHistorial')->name('consultarHistorial');
    Route::post('Licencias/trazabilidad/lista', 'LicenciasController@gridHistorial')->name('gridConsultarHistorial');
    /* FIN TRAZABILIDAD LICENCIA */

    /* INICIA  PREDIOS */
    Route::get('denuncias/predios/gestionar/{id}', 'PrediosController@viewGestionarPredios')->name('gestionarPredios');
    Route::post('denuncias/predios/lista', 'PrediosController@gridConsultarPredios')->name('gridConsultarPredios');
    Route::post('denuncias/predios/adicionar/{id}', 'PrediosController@funcionAdicionarPredio')->name('funcionAdicionarPredio');
    Route::get('denuncias/predios/adicionar/{id}', 'PrediosController@funcionEliminarPredio')->name('funcionEliminarPredio');
    /*FINALIZA PREDIOS*/

});
/*INICIA WS*/
Route::get('wslicencia/{id}',"LicenciasController@wsConsultarLicencia")->name('WSConsultarLicencia');
Route::post('wscreardenuncia/crear','DenunciasController@wsCrearDenuncia');//->name('WSCrearDenuncia')
/*FINALIZA WS*/
