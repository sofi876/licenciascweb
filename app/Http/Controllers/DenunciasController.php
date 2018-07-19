<?php

namespace App\Http\Controllers;

use App\EstadosDenuncia;
use App\Mail\NotificarDenuncia;
use App\User;
use Illuminate\Http\Request;
use App\Denuncias;
use App\LicenciaConstruccion;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\NotificacionDenuncia;

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
    public function wsCrearDenuncia(Request $request)
    {
        $result = [];

       //  \DB::beginTransaction();
        try {
            $validator = \Validator::make($request->all(), [
                'imagen' => 'required',
                'georeferencia' => 'required',
                'des_denuncia' => 'required',
            ]);

            $denuncia = new Denuncias();

            $licencia = LicenciaConstruccion::where('num_licencia',$request->num_licencia)->first();
            if(!$licencia == null)
                $denuncia->cod_licencia = $licencia->cod_licencia;

            $denuncia->imagen = $request->imagen;
            $denuncia->georeferencia = $request->georeferencia;
            $denuncia->des_denuncia = $request->des_denuncia." (número de licencia: ".$request->num_licencia.")";
            $denuncia->cod_estado_denuncia = "1";
            $denuncia->nueva = "1";
            $denuncia->fecha = Carbon::now();
            $denuncia->save();

            //Enviar Email
            $receivers = User::where('notificar_denuncia','1')->get();//pluck('email')->
            foreach ($receivers as $destino)
            {
                Mail::to($destino->email)->send(new NotificarDenuncia($denuncia));
                $notificaciond = new NotificacionDenuncia();
                $notificaciond->enviado = "1";
                $notificaciond->cod_denuncia = $denuncia->cod_denuncia;
                $notificaciond->cod_usuario = $destino->id;
                $notificaciond->fecha = Carbon::now();
                $notificaciond->save();
            }

            \DB::commit();
            $result['estado'] = true;
            $result['mensaje'] = 'La denuncia ha sido registrada satisfactoriamente';

        } catch (\Exception $exception) {
            $result['estado'] = false;
            $result['mensaje'] = 'No fue posible registrar la denuncia ' . $exception->getMessage();//. $exception->getMessage()
            \DB::rollBack();

        }
        return ['resultado' => $result];
        //return $result;

    }
}
