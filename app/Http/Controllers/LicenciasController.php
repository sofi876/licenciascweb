<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class LicenciasController extends Controller
{
    //
    //Abre el formulario para la ingresar una licencia
    public function viewCrearLicencia()
    {
        return view('licencias.crearlicencia');
    }
}
