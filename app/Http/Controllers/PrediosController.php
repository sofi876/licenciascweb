<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LicenciaConstruccion;
use App\Predio;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\AuditoriaLicencia;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PrediosController extends Controller
{
    public function viewGestionarPredios($id)
    {
        $licencia = LicenciaConstruccion::where('cod_licencia',$id)->first();
        //dd($licencia);
        return view('licencias.predios.gestionarpredios', compact('licencia'));
    }
    public function gridConsultarPredios(Request $request)
    {
        //dd($request->filtro);

        $predios = Predio::select(['cod_licencia','barrio','estrato','cedula_catastral','cod_informacion','viaprincipal','numerovia','numero1','numero2','complemento','matricula'])
            ->where('cod_licencia',$request->codlicencia)
            ->get();
        return Datatables::of($predios)
            ->addColumn('direccion', function ($predios) {
                $direccion = $predios->viaprincipal." ".$predios->numerovia." # ".$predios->numero1. " - ".$predios->numero2." ".$predios->complemento;
                return $direccion;
            })
            ->addColumn('action', function ($predios) {
                $acciones = "";
                $acciones .= '<div class="btn-group">'; //target="_blank"
                    $acciones .= '<a data-modal href="' . route('funcionEliminarPredio', [$predios->cod_informacion,$predios->cod_licencia]) . '"  onclick="return eliminarpredio()" type="button" class="btn btn-custom btn-xs">Eliminar</a>';
                $acciones .= '</div>';
                return $acciones;
                //
            })
            ->make(true);
    }
    public function funcionAdicionarPredio(Request $request, $id)
    {
        $result = [];
        \DB::beginTransaction();
        try {
            $validator = \Validator::make($request->all(), [
                'viaprincipal' => 'required',
                'numerovia' => 'required',
            ]);

            $predio = new Predio();
            $predio->cod_licencia = $id;
           //$predio->direccion = $request->direccion;
            $predio->viaprincipal = $request->viaprincipal;
            $predio->numerovia = $request->numerovia;
            $predio->numero1 = $request->numero1;
            $predio->numero2 = $request->numero2;
            $predio->complemento = $request->complemento;
            $predio->matricula = $request->matricula;
            $predio->barrio = $request->barrio;
            //$predio->manzana = $request->manzana;
            //$predio->lote = $request->lote;
            $predio->estrato = $request->estrato;
            $predio->cedula_catastral = $request->cedula_catastral;
            $predio->save();

            //Registrar Trazabilidad
            $auditoria = new AuditoriaLicencia();
            $auditoria->tipo = "Adicionar predio";
            $auditoria->fecha = Carbon::now();
            $auditoria->cod_usuario = Auth::User()->id;
            $auditoria->cod_licencia = $id;
            $auditoria->save();

            \DB::commit();
            $result['estado'] = true;
            $result['mensaje'] = 'El predio ha sido adicionado satisfactoriamente';
        } catch (\Exception $exception) {
            $result['estado'] = false;
            $result['mensaje'] = 'El predio no pudo ser adicionado.' . $exception->getMessage();
            //return redirect()->back()->with("error","Los datos de la licencia no pudieron ser actualizados.");
            \DB::rollBack();
        }
        return $result;

    }
    public function funcionEliminarPredio(Request $request, $id)//lega id de la licencia e id del predio a eliminar
    {
        try {
            $predio = Predio::find($id);
            $cantidad = Predio::where('cod_licencia',$predio->cod_licencia)->count();
            if($cantidad>1) {
                $predio->delete();
                //Registrar Trazabilidad
                $auditoria = new AuditoriaLicencia();
                $auditoria->tipo = "Eliminar predio";
                $auditoria->fecha = Carbon::now();
                $auditoria->cod_usuario = Auth::User()->id;
                $auditoria->cod_licencia = $predio->cod_licencia;
                $auditoria->save();
                return redirect()->back()->with("success", "El predio ha sido eliminado! ");
            }
            else
                return redirect()->back()->with("error","El predio no puede ser eliminado, porque es el único asociado a la licencia.");
        }
        catch (\Exception $exception) {
            return redirect()->back()->with("error","El predio no pudo ser eliminado.");
        }
    }
}
