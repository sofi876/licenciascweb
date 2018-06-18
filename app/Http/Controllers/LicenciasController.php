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
        return view('licencias.crearlicencia', compact(['estados','tipospersona']));
    }
}
