<?php

namespace App\Http\Controllers;
use App\EstadosLicencia;
use App\LicenciaConstruccion;
use App\Solicitante;
use App\Predio;
use App\Caracteristicas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

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

        $estados = DB::table('estado_licencia')->pluck('des_estado_licencia', 'cod_estado');
        $tipospersona = DB::table('tipo_persona')->pluck('des_persona', 'cod_tipo_persona');
        $tiposlicencia = DB::table('tipo_licencia')->pluck('des_licencia', 'cod_tipo_licencia');
        $modalidades = DB::table('modalidad')->pluck('des_modalidad', 'cod_modalidad');
        $objetos = DB::table('objeto_tramite')->pluck('des_objeto', 'cod_objeto');
        $tiposuso = DB::table('tipo_uso')->pluck('des_uso', 'cod_tipo_uso');
        return view('licencias.crearlicencia', compact(['estados','tipospersona','tiposlicencia','modalidades','objetos','tiposuso']));
    }
    public function funcionCrearLicencia(Request $request)
    {
        $result = [];
        \DB::beginTransaction();
        try {

            $validator = \Validator::make($request->all(), [
                'num_licencia' => 'required|unique:licencia_construccion|max:11',
            ]);

            //seleccionar max id de la licencia, y poner +1
            //$next = (DB::table('licencia_construccion')->max('cod_licencia'))+1;
            $next = (LicenciaConstruccion::max('cod_licencia'))+1;
            $licencia = new LicenciaConstruccion();
            $licencia->cod_licencia = $next;
            $licencia->num_licencia = $request->num_licencia;
            $licencia->fecha_radicacion = $request->fradicacion;
            $licencia->fecha_expedicion = $request->fexpedicion;
            $licencia->fecha_ejecutoria = $request->fejecutoria;
            $licencia->fecha_vence = $request->fvence;
            $licencia->cod_estado = $request->cod_estado;
            $licencia->antecedentes = $request->antecedentes;
            $licencia->save();

            $solicitante = new Solicitante();
            $solicitante->cod_licencia = $next;
            $solicitante->documento = $request->documento;
            $solicitante->nombres = $request->nombres;
            $solicitante->apellidos = $request->apellidos;
            $solicitante->cod_tipo_persona = $request->cod_tipo_persona;
            $solicitante->save();

            $predio = new Predio();
            $predio->cod_licencia = $next;
            $predio->direccion = $request->direccion;
            $predio->barrio = $request->barrio;
            $predio->manzana = $request->manzana;
            $predio->lote = $request->lote;
            $predio->estrato = $request->estrato;
            $predio->cedula_catastral = $request->cedula_catastral;
            $predio->save();

            $caracteristica = new Caracteristicas();
            $caracteristica->cod_licencia = $next;
            $caracteristica->des_proyecto = $request->des_proyecto;
            $caracteristica->cod_tipo_licencia = $request->cod_tipo_licencia;
            $caracteristica->cod_modalidad = $request->cod_modalidad;
            $caracteristica->cod_objeto = $request->cod_objeto;
            $caracteristica->cod_tipo_uso = $request->cod_tipo_uso;
            $caracteristica->num_pisos = $request->num_pisos;
            $caracteristica->save();
            /*DB::table('licencia_construccion')->insert(
                ['cod_licencia' => $next,'num_licencia' => $request->numero_licencia, 'fecha_radicacion' => $request->fradicacion, 'fecha_expedicion' => $request->fexpedicion, 'fecha_ejecutoria' => $request->fejecutoria, 'fecha_vence' => $request->fvence, 'cod_estado' => $request->cod_estado, 'antecedentes' => $request->antecedentes]
            );*/

            //save
            \DB::commit();
            $result['estado'] = true;
            $result['mensaje'] = 'La licencia ha sido creada satisfactoriamente';
        } catch (\Exception $exception) {
            $result['estado'] = false;
            $result['mensaje'] = 'No fue posible crear la licencia ' . $exception->getMessage();//. $exception->getMessage()
            \DB::rollBack();
        }
        return $result;

    }
    public function verConsultarLicencias()
    {
        $licencias = LicenciaConstruccion::all();
        return view('licencias.consultarlicencias', compact('licencias'));
    }
    public function gridConsultarLicencias()
    {
        $licencias = LicenciaConstruccion::select(['cod_licencia','num_licencia','fecha_radicacion','fecha_expedicion','fecha_ejecutoria','fecha_vence','cod_estado','antecedentes'])->get();
        return Datatables::of($licencias)
            ->addColumn('estado', function ($licencias) {
                $estadol = EstadosLicencia::where("cod_estado", $licencias->cod_estado)->first();
                return $estadol->des_estado_licencia;
            })
            ->addColumn('action', function ($licencias) {
                $acciones = "";
                $acciones .= '<div class="btn-group">';
                $acciones .= '<a data-modal href="' . route('editarlicencia', $licencias->cod_licencia) . '" type="button" class="btn btn-custom btn-xs">Ver</a>';
                $acciones .= '</div>';
                return $acciones;
                //
            })
            ->make(true);
    }
    public function verConsultarLicenciasFiltro()
    {
       // $licencias = LicenciaConstruccion::all();
        //return view('licencias.filtrarconsultas', compact('licencias'));
        $estados = DB::table('estado_licencia')->pluck('des_estado_licencia', 'cod_estado');
        return view('licencias.filtrarconsultas', compact('estados'));
    }
    public function consultarxlicencia(Request $request)
    {

        $filtro = $request->filtro;
        $numlicencia = "";
        $tipo_fecha = "";
        $fecha1 = "";
        $fecha2 = "";
        $estado = "";
        $cedula = "";


        if($filtro=="1" || $filtro == "2" || $filtro =="3" || $filtro == "4") {

            if($filtro=="1"){
                $numlicencia=$request->numlicencia;
                $licencias = LicenciaConstruccion::select(['cod_licencia','num_licencia','fecha_radicacion','fecha_expedicion','fecha_ejecutoria','fecha_vence','cod_estado','antecedentes'])
                    ->where('num_licencia',$numlicencia)
                    ->get();
                if(count($licencias)>0){
                    //dd($licencias);
                    //return view('licencias.parcialconsultarlicencias', compact(['numlicencia', 'filtro']));//
                    return view('licencias.parcialconsultarlicencias', compact(['filtro', 'numlicencia', 'tipo_fecha', 'fecha1', 'fecha2', 'estado', 'cedula']));
                }
                else {
                    return "<p align='center'>No se encontraron resultados</p>";
                }
            }
            else{
                if($filtro=="2"){
                    $tipo_fecha=$request->tipo_fecha;
                    $fecha1=$request->fecha1;
                    $fecha2=$request->fecha2;
                    //$fecha1=Carbon::createFromFormat("Y/m/d", $request->fecha1);
                    //$fecha2=Carbon::createFromFormat("Y/m/d", $request->fecha2);
                    $licencias = LicenciaConstruccion::select(['cod_licencia','num_licencia','fecha_radicacion','fecha_expedicion','fecha_ejecutoria','fecha_vence','cod_estado','antecedentes'])
                        ->whereBetween($tipo_fecha, [$fecha1, $fecha2])
                        ->get();
                    if(count($licencias)>0){
                        //return view('licencias.parcialconsultarlicencias', compact(['tipo_fecha','filtro','fecha1','fecha2']));
                        return view('licencias.parcialconsultarlicencias', compact(['filtro', 'numlicencia', 'tipo_fecha', 'fecha1', 'fecha2', 'estado', 'cedula']));
                    }
                    else {
                        return "<p align='center'>No se encontraron resultados</p>";
                    }
                }
                else{
                    if($filtro=="3"){
                        $estado=$request->estado;
                        $licencias = LicenciaConstruccion::select(['cod_licencia','num_licencia','fecha_radicacion','fecha_expedicion','fecha_ejecutoria','fecha_vence','cod_estado','antecedentes'])
                            ->where('cod_estado', $estado)
                            ->get();
                        //dd($licencias);
                        if(count($licencias)>0){
                            //return view('licencias.parcialconsultarlicencias', compact(['estado','filtro']));
                            return view('licencias.parcialconsultarlicencias', compact(['filtro', 'numlicencia', 'tipo_fecha', 'fecha1', 'fecha2', 'estado', 'cedula']));
                        }
                        else {
                            return "<p align='center'>No se encontraron resultados</p>";
                        }
                    }
                    else{
                        if($filtro=="4"){
                            $cedula=$request->cedula;
                            $licencias = LicenciaConstruccion::select(['licencia_construccion.cod_licencia','licencia_construccion.num_licencia','licencia_construccion.fecha_radicacion','licencia_construccion.fecha_expedicion','licencia_construccion.fecha_ejecutoria','licencia_construccion.fecha_vence','licencia_construccion.cod_estado','licencia_construccion.antecedentes'])
                                ->join('datos_solicitante', 'licencia_construccion.cod_licencia', 'datos_solicitante.cod_licencia')
                                ->where('datos_solicitante.documento', $cedula)
                                ->get();
                            if(count($licencias)>0){
                                //return view('licencias.parcialconsultarlicencias', compact(['cedula','filtro']));
                                return view('licencias.parcialconsultarlicencias', compact(['filtro', 'numlicencia', 'tipo_fecha', 'fecha1', 'fecha2', 'estado', 'cedula']));
                            }
                            else {
                                return "<p align='center'>No se encontraron resultados</p>";
                            }
                        }
                        else {
                            return "<p align='center'>Error: Seleccione un tipo de búsqueda</p>";
                        }
                    }
                }
            }
        }
        else {
            return "<p align='center'>Error: Seleccione un tipo de búsqueda</p>";
        }
    }
    public function gridConsultarLicenciasFiltro(Request $request)
    {
        //dd($request->filtro);
        //$licencias = LicenciaConstruccion::select(['cod_licencia','num_licencia','fecha_radicacion','fecha_expedicion','fecha_ejecutoria','fecha_vence','cod_estado','antecedentes'])->get();

        if($request->filtro == "1")
        {
            $numlicencia=$request->numlicencia;
            $licencias = LicenciaConstruccion::select(['cod_licencia','num_licencia','fecha_radicacion','fecha_expedicion','fecha_ejecutoria','fecha_vence','cod_estado','antecedentes'])
                ->where('num_licencia',$numlicencia)
                ->get();
        }
        if($request->filtro == "2")
        {
            $tipo_fecha=$request->tipo_fecha;
            $fecha1=$request->fecha1;
            $fecha2=$request->fecha2;
            //$fecha1=Carbon::createFromFormat("Y/m/d", $request->fecha1);
            //$fecha2=Carbon::createFromFormat("Y/m/d", $request->fecha2);
            $licencias = LicenciaConstruccion::select(['cod_licencia','num_licencia','fecha_radicacion','fecha_expedicion','fecha_ejecutoria','fecha_vence','cod_estado','antecedentes'])
                ->whereBetween($tipo_fecha, [$fecha1, $fecha2])
                ->get();
        }
        if($request->filtro == "3")
        {
            $estado=$request->estado;
            $licencias = LicenciaConstruccion::select(['cod_licencia','num_licencia','fecha_radicacion','fecha_expedicion','fecha_ejecutoria','fecha_vence','cod_estado','antecedentes'])
                ->where('cod_estado', $estado)
                ->get();
        }
        if($request->filtro == "4")
        {
            $cedula=$request->cedula;
            $licencias = LicenciaConstruccion::select(['licencia_construccion.cod_licencia','licencia_construccion.num_licencia','licencia_construccion.fecha_radicacion','licencia_construccion.fecha_expedicion','licencia_construccion.fecha_ejecutoria','licencia_construccion.fecha_vence','licencia_construccion.cod_estado','licencia_construccion.antecedentes'])
                ->join('datos_solicitante', 'licencia_construccion.cod_licencia', 'datos_solicitante.cod_licencia')
                ->where('datos_solicitante.documento', $cedula)
                ->get();
        }
        return Datatables::of($licencias)
            ->addColumn('estado', function ($licencias) {
                $estadol = EstadosLicencia::where("cod_estado", $licencias->cod_estado)->first();
                return $estadol->des_estado_licencia;
            })
            ->addColumn('action', function ($licencias) {
                $acciones = "";
                $acciones .= '<div class="btn-group">'; //target="_blank"
                $acciones .= '<a data-modal href="' . route('editarlicencia', $licencias->cod_licencia) . '" target="_blank" type="button" class="btn btn-custom btn-xs">Ver</a>';
                $acciones .= '</div>';
                return $acciones;
                //
            })
            ->make(true);
    }
    public function viewEditarLicencia($id)
    {
        $licencia = LicenciaConstruccion::where('cod_licencia',$id)->first();
        return view('licencias.vieweditarlicencia', compact('licencia'));
    }
    public function frameEditarLicencia($id)
    {
        $licencia = LicenciaConstruccion::join('informacion_predio', 'licencia_construccion.cod_licencia', 'informacion_predio.cod_licencia')
            ->join('datos_solicitante', 'licencia_construccion.cod_licencia', 'datos_solicitante.cod_licencia')
            ->join('caracteristicas_licencia', 'licencia_construccion.cod_licencia', 'caracteristicas_licencia.cod_licencia')
            ->where('licencia_construccion.cod_licencia',$id)
            ->select(['licencia_construccion.*', 'datos_solicitante.documento', 'datos_solicitante.nombres', 'datos_solicitante.apellidos', 'datos_solicitante.cod_tipo_persona', 'informacion_predio.direccion', 'informacion_predio.barrio', 'informacion_predio.manzana', 'informacion_predio.lote', 'informacion_predio.estrato', 'informacion_predio.cedula_catastral', 'informacion_predio.cod_informacion', 'caracteristicas_licencia.des_proyecto', 'caracteristicas_licencia.cod_tipo_licencia', 'caracteristicas_licencia.cod_modalidad', 'caracteristicas_licencia.cod_objeto', 'caracteristicas_licencia.cod_tipo_uso', 'caracteristicas_licencia.num_pisos'])
            ->first();

        $estados = DB::table('estado_licencia')->pluck('des_estado_licencia', 'cod_estado');
        $tipospersona = DB::table('tipo_persona')->pluck('des_persona', 'cod_tipo_persona');
        $tiposlicencia = DB::table('tipo_licencia')->pluck('des_licencia', 'cod_tipo_licencia');
        $modalidades = DB::table('modalidad')->pluck('des_modalidad', 'cod_modalidad');
        $objetos = DB::table('objeto_tramite')->pluck('des_objeto', 'cod_objeto');
        $tiposuso = DB::table('tipo_uso')->pluck('des_uso', 'cod_tipo_uso');
        return view('licencias.editarlicencia', compact(['licencia','estados','tipospersona','tiposlicencia','modalidades','objetos','tiposuso']));
    }
    public function funcionEditarLicencia(Request $request, $id)
    {
        $result = [];
        \DB::beginTransaction();
        try {
            $validator = \Validator::make($request->all(), [
                'num_licencia' => 'required|unique:licencia_construccion|max:11',
            ]);
            $licencia = LicenciaConstruccion::where('cod_licencia',$id)->first();
            $licencia->num_licencia = $request->num_licencia;
            $licencia->fecha_radicacion = $request->fecha_radicacion;
            $licencia->fecha_expedicion = $request->fecha_expedicion;
            $licencia->fecha_ejecutoria = $request->fecha_ejecutoria;
            $licencia->fecha_vence = $request->fecha_vence;
            $licencia->cod_estado = $request->cod_estado;
            $licencia->antecedentes = $request->antecedentes;
            $licencia->save();

            $solicitante = Solicitante::where('cod_licencia',$licencia->cod_licencia)->first();
            $solicitante->documento = $request->documento;
            $solicitante->nombres = $request->nombres;
            $solicitante->apellidos = $request->apellidos;
            $solicitante->cod_tipo_persona = $request->cod_tipo_persona;
            $solicitante->save();

            $predio = Predio::where('cod_licencia',$licencia->cod_licencia)->first();
            $predio->direccion = $request->direccion;
            $predio->barrio = $request->barrio;
            $predio->manzana = $request->manzana;
            $predio->lote = $request->lote;
            $predio->estrato = $request->estrato;
            $predio->cedula_catastral = $request->cedula_catastral;
            $predio->save();

            $caracteristica = Caracteristicas::where('cod_licencia',$licencia->cod_licencia)->first();
            $caracteristica->des_proyecto = $request->des_proyecto;
            $caracteristica->cod_tipo_licencia = $request->cod_tipo_licencia;
            $caracteristica->cod_modalidad = $request->cod_modalidad;
            $caracteristica->cod_objeto = $request->cod_objeto;
            $caracteristica->cod_tipo_uso = $request->cod_tipo_uso;
            $caracteristica->num_pisos = $request->num_pisos;
            $caracteristica->save();

            \DB::commit();
            $result['estado'] = true;
            $result['mensaje'] = 'La licencia ha sido actualizada satisfactoriamente';
        } catch (\Exception $exception) {
            return redirect()->back()->with("error","Los datos de la licencia no pudieron ser actualizados.");
            \DB::rollBack();
        }
        return $result;

    }
}
