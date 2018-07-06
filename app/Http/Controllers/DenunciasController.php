<?php

namespace App\Http\Controllers;

use App\EstadosDenuncia;
use Illuminate\Http\Request;
use App\Denuncias;
use App\LicenciaConstruccion;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class DenunciasController extends Controller
{
    //
    public function verFiltroDenuncias()
    {
        return view('denuncias.filtrardenuncias');
    }
    public function consultarxFecha(Request $request)
    {
        $fecha1=$request->fecha1;
        $fecha2=$request->fecha2;
        $denuncias = Denuncias::whereBetween('fecha', [$fecha1, $fecha2])
            ->get();
        if (count($denuncias) > 0) {
            //dd($licencias);
             return view('denuncias.parcialconsultardenuncias', compact(['fecha1', 'fecha2']));
        } else {
            return "<p align='center'>No se encontraron resultados</p>";
        }
    }
    public function gridConsultarDenunciasFiltro(Request $request)
    {
            $fecha1=$request->fecha1;
            $fecha2=$request->fecha2;
            $denuncias = Denuncias::whereBetween('fecha', [$fecha1, $fecha2])
            ->get();
        return Datatables::of($denuncias)
            ->addColumn('estado_name', function ($denuncias) {
                $estado_name = EstadosDenuncia::where("cod_estado_denuncia", $denuncias->cod_estado_denuncia)->first();
                return $estado_name->des_estado_denuncia;
            })
            ->addColumn('action', function ($denuncias) {
                $acciones = "";
                $acciones .= '<div class="btn-group">'; //target="_blank"
                //$acciones .= '<a data-modal href="' . route('editarDenuncia', $denuncias->cod_denuncia) . '" target="_blank" type="button" class="btn btn-custom btn-xs">Ver</a>';
                $acciones .= '</div>';
                return $acciones;
                //
            })
            ->make(true);
    }
}
