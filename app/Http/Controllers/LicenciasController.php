<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LicenciasController extends Controller
{
    //
    //Abre el formulario para la ingresar una licencia
    public function viewCrearLicencia()
    {
        return view('licencias.viewcrearlicencia');
    }
    public function frameCrearLicencia()
    {
        /*$users = DB::table('estado_licencia')->get();

        return view('user.index', ['users' => $users]);*/
        $estados = DB::table('estado_licencia')->pluck('des_estado_licencia', 'cod_estado');
        $tipospersona = DB::table('tipo_persona')->pluck('des_persona', 'cod_tipo_persona');
        $tiposlicencia = DB::table('tipo_licencia')->pluck('des_licencia', 'cod_tipo_licencia');
        $modalidades = DB::table('modalidad')->pluck('des_modalidad', 'cod_modalidad');
        $objetos = DB::table('objeto_tramite')->pluck('des_objeto', 'cod_objeto');
        $tiposuso = DB::table('tipo_uso')->pluck('des_uso', 'cod_tipo_uso');
        return view('licencias.crearlicencia', compact(['estados','tipospersona','tiposlicencia','modalidades','objetos','tiposuso']));
    }
}
