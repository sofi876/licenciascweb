<?php

namespace App\Http\Controllers;

use App\EstadosDenuncia;
use Illuminate\Http\Request;
use App\Denuncias;
use App\LicenciaConstruccion;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
                $acciones .= '<a data-modal href="' . route('editarDenuncia', $denuncias->cod_denuncia) . '" target="_blank" type="button" class="btn btn-custom btn-xs">Ver</a>';
                $acciones .= '</div>';
                return $acciones;
                //
            })
            ->make(true);
    }
    public function viewEditarDenuncia($id)
    {
        $denuncia = Denuncias::where('cod_denuncia',$id)->first();
        //ya se vio, entonces si era nueva se actualiza como nueva=0
        if($denuncia->nueva == "1"){
            $denuncia->nueva = "0";
            $denuncia->save();
        }

        $num_licencia="";
        if($denuncia->cod_licencia != "") {
            $licencia = LicenciaConstruccion::where('cod_licencia', $denuncia->cod_licencia)->first();
            $num_licencia = $licencia->num_licencia;
        }
        $estados = DB::table('estado_denuncia')->pluck('des_estado_denuncia', 'cod_estado_denuncia');
        return view('denuncias.atenderdenuncia', compact(['denuncia', 'estados', 'num_licencia']));
    }
    public function funcionEditarDenuncia(Request $request, $id)
    {
        $result = [];
        \DB::beginTransaction();
        try {
            $denuncia = Denuncias::where('cod_denuncia',$id)->first();
            $denuncia->observacion = $request->observacion;
            $denuncia->cod_estado_denuncia = $request->cod_estado_denuncia;
            $denuncia->save();

            \DB::commit();
            return redirect()->back()->with("success","La denuncia ha sido actualizada satisfactoriamente!");
        } catch (\Exception $exception) {
            return redirect()->back()->with("error","Los datos de la denuncia no pudieron ser actualizados.");
            \DB::rollBack();
        }
        return $result;

    }
}
