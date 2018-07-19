<?php

namespace App\Http\Controllers;
use App\AuditoriaLicencia;
use App\EstadosLicencia;
use App\LicenciaConstruccion;
use App\NotificacionLicencia;
use App\Solicitante;
use App\Predio;
use App\Caracteristicas;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Excel;
use App\DetalleModalidad;
use App\TipoLicencia;
use App\Mail\NotificarLicencia;
use Illuminate\Support\Facades\Mail;

//use PHPExcel_Worksheet_Drawing;

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

            $caracteristica = new Caracteristicas();
            $caracteristica->cod_licencia = $next;
            $caracteristica->des_proyecto = $request->des_proyecto;
            $caracteristica->cod_tipo_licencia = $request->cod_tipo_licencia;
            //$caracteristica->cod_modalidad = $request->cod_modalidad;
            $caracteristica->cod_objeto = $request->cod_objeto;
            $caracteristica->cod_tipo_uso = $request->cod_tipo_uso;
            $caracteristica->num_pisos = $request->num_pisos;
            $caracteristica->save();

            //registrar modalidades
            $eltipo= TipoLicencia::select('varias_modalidades')->where('cod_tipo_licencia',$request->cod_tipo_licencia)->first();
            if($eltipo->varias_modalidades == "1")
            {
                $lista_mod=$request->select_modalidad;
                $txt2="";
                foreach ($lista_mod as $mod){
                    //$txt2.="-".$reg;
                    $detalle = New DetalleModalidad();
                    $detalle->cod_licencia = $next;
                    $detalle->cod_modalidad = $mod;
                    $detalle->save();
                }
            }
            else{
                $detalle = New DetalleModalidad();
                $detalle->cod_licencia = $next;
                $detalle->cod_modalidad = $request->select_modalidad;
                $detalle->save();
            }

            //Registrar Trazabilidad
            $auditoria = new AuditoriaLicencia();
            $auditoria->tipo = "Creación";
            $auditoria->fecha = Carbon::now();
            $auditoria->cod_usuario = Auth::User()->id;
            $auditoria->cod_licencia = $next;
            $auditoria->save();

            //save
            \DB::commit();
            $result['estado'] = true;
            $result['mensaje'] = 'La licencia ha sido creada satisfactoriamente';
            //Enviar Email Notificación
            $receivers = User::where('notificar_licencia','1')->get();//pluck('email')->
            foreach ($receivers as $destino)
            {
                Mail::to($destino->email)->send(new NotificarLicencia($licencia));
                $notificaciond = new NotificacionLicencia();
                $notificaciond->enviado = "1";
                $notificaciond->cod_licencia = $licencia->cod_licencia;
                $notificaciond->cod_usuario = $destino->id;
                $notificaciond->fecha = Carbon::now();
                $notificaciond->save();
            }
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
            }
            if($filtro=="2"){
                    $tipo_fecha=$request->tipo_fecha;
                    $fecha1=$request->fecha1;
                    $fecha2=$request->fecha2;
                    $licencias = LicenciaConstruccion::select(['cod_licencia','num_licencia','fecha_radicacion','fecha_expedicion','fecha_ejecutoria','fecha_vence','cod_estado','antecedentes'])
                        ->whereBetween($tipo_fecha, [$fecha1, $fecha2])
                        ->get();
           }
           if($filtro=="3"){
                        $estado=$request->estado;
                        $licencias = LicenciaConstruccion::select(['cod_licencia','num_licencia','fecha_radicacion','fecha_expedicion','fecha_ejecutoria','fecha_vence','cod_estado','antecedentes'])
                            ->where('cod_estado', $estado)
                            ->get();
           }
           if($filtro=="4") {
                            $cedula = $request->cedula;
                            $licencias = LicenciaConstruccion::select(['licencia_construccion.cod_licencia', 'licencia_construccion.num_licencia', 'licencia_construccion.fecha_radicacion', 'licencia_construccion.fecha_expedicion', 'licencia_construccion.fecha_ejecutoria', 'licencia_construccion.fecha_vence', 'licencia_construccion.cod_estado', 'licencia_construccion.antecedentes'])
                                ->join('datos_solicitante', 'licencia_construccion.cod_licencia', 'datos_solicitante.cod_licencia')
                                ->where('datos_solicitante.documento', $cedula)
                                ->get();
           }
           if(count($licencias)>0){
                $lista_licencias = array();
                               //return view('licencias.parcialconsultarlicencias', compact(['cedula','filtro']));
               foreach ($licencias as $licencia) {
                   $lista_licencias[] = $licencia->cod_licencia;
               }
               //dd($lista_licencias);
               return view('licencias.parcialconsultarlicencias', compact(['filtro', 'numlicencia', 'tipo_fecha', 'fecha1', 'fecha2', 'estado', 'cedula', 'licencias', 'lista_licencias']));
           }
           else {
                 return "<p align='center'>No se encontraron resultados</p>";
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
            ->select(['licencia_construccion.*', 'datos_solicitante.documento', 'datos_solicitante.nombres', 'datos_solicitante.apellidos', 'datos_solicitante.cod_tipo_persona', 'informacion_predio.viaprincipal', 'informacion_predio.barrio', 'informacion_predio.numerovia', 'informacion_predio.numero1', 'informacion_predio.numero2', 'informacion_predio.complemento', 'informacion_predio.matricula', 'informacion_predio.estrato', 'informacion_predio.cedula_catastral', 'informacion_predio.cod_informacion', 'caracteristicas_licencia.des_proyecto', 'caracteristicas_licencia.cod_tipo_licencia', 'caracteristicas_licencia.cod_modalidad', 'caracteristicas_licencia.cod_objeto', 'caracteristicas_licencia.cod_tipo_uso', 'caracteristicas_licencia.num_pisos'])
            ->first();
        $predios = Predio::select(['cod_licencia','barrio','estrato','cedula_catastral','cod_informacion','viaprincipal','numerovia','numero1','numero2','complemento','matricula'])
            ->where('cod_licencia',$licencia->cod_licencia)
            ->get();
        $det_modalidades = DetalleModalidad::where('cod_licencia',$licencia->cod_licencia)->get();
        $lista_mod=$det_modalidades->pluck('cod_modalidad')->toArray();
        //$lista_mod_name=DB::table('modalidad')->pluck('des_modalidad', 'cod_modalidad')->whereIn('cod_modalidad', $lista_mod)->toArray();

        $estados = DB::table('estado_licencia')->pluck('des_estado_licencia', 'cod_estado');
        $tipospersona = DB::table('tipo_persona')->pluck('des_persona', 'cod_tipo_persona');
        $tiposlicencia = DB::table('tipo_licencia')->pluck('des_licencia', 'cod_tipo_licencia');
        $modalidades = DB::table('modalidad')->pluck('des_modalidad', 'cod_modalidad');
        $objetos = DB::table('objeto_tramite')->pluck('des_objeto', 'cod_objeto');
        $tiposuso = DB::table('tipo_uso')->pluck('des_uso', 'cod_tipo_uso');
        return view('licencias.editarlicencia', compact(['licencia','estados','tipospersona','tiposlicencia','modalidades','objetos','tiposuso','predios','lista_mod']));
    }
    public function funcionEditarLicencia(Request $request, $id)
    {
        $result = [];
        $vector= [];
        $txt="";
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

            /*$predio = Predio::where('cod_licencia',$licencia->cod_licencia)->first();
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
            $predio->save();*/

            $caracteristica = Caracteristicas::where('cod_licencia',$licencia->cod_licencia)->first();
            $caracteristica->des_proyecto = $request->des_proyecto;
            $caracteristica->cod_tipo_licencia = $request->cod_tipo_licencia;
            //$caracteristica->cod_modalidad = $request->cod_modalidad;
            $caracteristica->cod_objeto = $request->cod_objeto;
            $caracteristica->cod_tipo_uso = $request->cod_tipo_uso;
            $caracteristica->num_pisos = $request->num_pisos;
            $caracteristica->save();

            //eliminar las modalidades anteriores
            DetalleModalidad::where('cod_licencia',$licencia->cod_licencia)->delete();
            //registrar modalidades
            $eltipo= TipoLicencia::select('varias_modalidades')->where('cod_tipo_licencia',$request->cod_tipo_licencia)->first();
            if($eltipo->varias_modalidades == "1")
            {
                $lista_mod=$request->select_modalidad;
                $txt2="";
                foreach ($lista_mod as $mod){
                    //$txt2.="-".$reg;
                    $detalle = New DetalleModalidad();
                    $detalle->cod_licencia = $licencia->cod_licencia;
                    $detalle->cod_modalidad = $mod;
                    $detalle->save();
                }
            }
            else{
                $detalle = New DetalleModalidad();
                $detalle->cod_licencia = $licencia->cod_licencia;
                $detalle->cod_modalidad = $request->select_modalidad;
                $detalle->save();
            }


            /*foreach ($request->cod_modalidad as $det) {
                $txt.="-".$det;
            }
            dd($txt);*/

            //Registrar Trazabilidad
            $auditoria = new AuditoriaLicencia();
            $auditoria->tipo = "Modificación";
            $auditoria->fecha = Carbon::now();
            $auditoria->cod_usuario = Auth::User()->id;
            $auditoria->cod_licencia = $licencia->cod_licencia;
            $auditoria->save();

            \DB::commit();
            $result['estado'] = true;
            $result['mensaje'] = 'La licencia ha sido actualizada satisfactoriamente';
        } catch (\Exception $exception) {
            $result['estado'] = false;
            $result['mensaje'] = 'Los datos de la licencia no pudieron ser actualizados.' . $exception->getMessage();
            //return redirect()->back()->with("error","Los datos de la licencia no pudieron ser actualizados.");
            \DB::rollBack();
        }
        return $result;

    }
    public function generarReporteExcel(Request $request)
    {
        $licencias = LicenciaConstruccion::join('datos_solicitante', 'licencia_construccion.cod_licencia', 'datos_solicitante.cod_licencia')
            ->join('caracteristicas_licencia', 'licencia_construccion.cod_licencia', 'caracteristicas_licencia.cod_licencia')
            ->join('estado_licencia', 'licencia_construccion.cod_estado', 'estado_licencia.cod_estado')
            ->join('tipo_persona', 'datos_solicitante.cod_tipo_persona', 'tipo_persona.cod_tipo_persona')
            ->join('tipo_licencia', 'caracteristicas_licencia.cod_tipo_licencia', 'tipo_licencia.cod_tipo_licencia')
            ->join('objeto_tramite', 'caracteristicas_licencia.cod_objeto', 'objeto_tramite.cod_objeto')
            ->join('tipo_uso', 'caracteristicas_licencia.cod_tipo_uso', 'tipo_uso.cod_tipo_uso')
            ->wherein('licencia_construccion.cod_licencia',$request->lista_licencias)
            ->select(['licencia_construccion.*', 'datos_solicitante.documento', 'datos_solicitante.nombres', 'datos_solicitante.apellidos',
                'datos_solicitante.cod_tipo_persona',
                'caracteristicas_licencia.des_proyecto', 'caracteristicas_licencia.cod_tipo_licencia', 'caracteristicas_licencia.cod_modalidad',
                'caracteristicas_licencia.cod_objeto', 'caracteristicas_licencia.cod_tipo_uso', 'caracteristicas_licencia.num_pisos',
                'estado_licencia.des_estado_licencia','tipo_persona.des_persona','tipo_licencia.des_licencia',
                'objeto_tramite.des_objeto','tipo_uso.des_uso'])
            ->orderby('licencia_construccion.num_licencia', 'asc')
            ->get();

        //$licencias_datos = [];
        $licencias_datos=array();
        foreach ($licencias as $licencia) {
            $cod_licencia=$licencia->cod_licencia;
            $modalidades = DetalleModalidad::join('modalidad','detalle_modalidades.cod_modalidad', 'modalidad.cod_modalidad')
            ->where('detalle_modalidades.cod_licencia', $cod_licencia)
                ->select('modalidad.des_modalidad')
                ->get();
            $txt_modalidad = "";
            foreach ($modalidades as $modalidad) {
                if($txt_modalidad!="")
                    $txt_modalidad.=", ";
                $txt_modalidad .= $modalidad->des_modalidad;
            }
            $predios = Predio::where('cod_licencia', $cod_licencia)
                ->get();
            $txt_predio = "";
            $cant_predio = 0;
            foreach ($predios as $predio) {
                if($txt_predio!="")
                    $txt_predio.= PHP_EOL;
                $txt_predio .= $predio->viaprincipal." ".$predio->numerovia." # ".$predio->numero1. " - ".$predio->numero2." ".$predio->complemento."; Barrio: ".$predio->barrio."; Estrato: ".$predio->estrato."; Matricula inmobiliaria: ".$predio->matricula."; Cédula catastral: ".$predio->cedula_catastral.".";
                $cant_predio++;
            }
            $licencias_datos[]=array('num_licencia' => $licencia->num_licencia,
                'fecha_radicacion' => $licencia->fecha_radicacion,
                'fecha_expedicion' => $licencia->fecha_expedicion,
                'fecha_ejecutoria' => $licencia->fecha_ejecutoria,
                'fecha_vence' => $licencia->fecha_vence,
                'des_estado_licencia' => $licencia->des_estado_licencia,
                'antecedentes' => $licencia->antecedentes,
                'documento' => $licencia->documento,
                'nombres' => $licencia->nombres,
                'apellidos' => $licencia->apellidos,
                'des_persona' => $licencia->des_persona,
                'des_proyecto' => $licencia->des_proyecto,
                'des_licencia' => $licencia->des_licencia,
                'des_modalidad' => $txt_modalidad,
                'des_objeto' => $licencia->des_objeto,
                'des_uso' => $licencia->des_uso,
                'num_pisos' => $licencia->num_pisos,
                'direccion' => $txt_predio,
                'cant_predio' => $cant_predio);
        } //finaliza foreach

        /*'barrio' => $licencia->barrio,
        'manzana' => $licencia->manzana,
        'lote' => $licencia->lote,
        'estrato' => $licencia->estrato,
        'cedula_catastral' => $licencia->cedula_catastral,*/
        //dd($licencias_datos);
        //consultar todos los predios, con cod_licencia asociados a la lista_licencias

        \Excel::create('ExcelLicencias', function ($excel) use ($request, $licencias, $licencias_datos) {
            if (sizeof($licencias) > 0) {
                $excel->sheet('Reporte', function ($sheet) use ($licencias, $licencias_datos) {
                    $hoy = Carbon::now();
                    /*$objDrawing = new PHPExcel_Worksheet_Drawing;
                    $objDrawing->setPath(public_path('images/logo.png')); //your image path
                    $objDrawing->setHeight(50);
                    $objDrawing->setCoordinates('A1');
                    $objDrawing->setWorksheet($sheet);
                    $objDrawing->setOffsetY(10);*/
                    $sheet->setWidth(array(
                        'A' => 18,
                        'B' => 18,
                        'C' => 18,
                        'D' => 18,
                        'E' => 18,
                        'F' => 14,
                        'G' => 14,
                        'H' => 14,
                        'I' => 14,
                        'J' => 14,
                        'K' => 16,
                        'L' => 20,
                        'M' => 20,
                        'N' => 20,
                        'O' => 12,
                        'P' => 12,
                        'Q' => 15,
                        'R' => 60,
                    ));
                    $sheet->row(2, array('REPORTE DE LICENCIAS DE CONSTRUCCIÓN'));
                    $sheet->row(2, function ($row) {
                        $row->setBackground('#4CAF50');
                    });
                    /*$sheet->cells('A1:A4', function ($cells) {
                        $cells->setBackground('#FFFFFF');
                    });*/
                    $sheet->row(3, array('Fecha:', $hoy));
                    $sheet->row(3, function ($row) {
                        $row->setBackground('#4CAF50');
                    });
                    $filainicial=5;
                    $fila = $filainicial;
                    $cant = 0;
                    $sheet->row(($fila), function ($row) {
                        $row->setBackground('#06AEF1');
                    });

                    $sheet->row(($fila), array('DATOS DE LA LICENCIA','','', '', '', '', '', 'SOLICITANTE', '', '', '', 'CARACTERÍSTICAS', '', '', '', '', '', 'PREDIO'));
                    $sheet->mergeCells('A'.($fila).':G'.($fila));
                    $sheet->mergeCells('H'.($fila).':K'.($fila));
                    $sheet->mergeCells('L'.($fila).':Q'.($fila));
                    //$sheet->mergeCells('R'.($fila).':W'.($fila));
                    //$sheet->getStyle("A".($fila).":Z".($fila))->getAlignment()->applyFromArray(array('horizontal' => 'center'));
                    $fila++;
                    $sheet->row($fila, array('Número de Licencia','Fecha de radicación','Fecha de expedición', 'Fecha de ejecutoría', 'Fecha de vencimiento', 'Estado', 'Antecedentes', 'Documento', 'Nombres', 'Apellidos', 'Tipo de persona', 'Descripción del proyecto', 'Tipo de Licencia', 'Modalidad(es)', 'Objeto', 'Tipo de uso', 'Número de pisos', 'Direccion(es)'));
                    $sheet->row($fila, function ($row) {
                        $row->setBackground('#f2f2f2');
                    });
                    $fila++;
                    foreach ($licencias_datos as $licencia) {
                        $cant++;
                        $sheet->row($fila, array($licencia['num_licencia'], $licencia['fecha_radicacion'], $licencia['fecha_expedicion'], $licencia['fecha_ejecutoria'], $licencia['fecha_vence'], $licencia['des_estado_licencia'], $licencia['antecedentes'], $licencia['documento'], $licencia['nombres'], $licencia['apellidos'], $licencia['des_persona'], $licencia['des_proyecto'], $licencia['des_licencia'], $licencia['des_modalidad'], $licencia['des_objeto'], $licencia['des_uso'], $licencia['num_pisos'], $licencia['direccion']));
                        $altura = (float)(15) * (float)($licencia['cant_predio']);
                        $sheet->setHeight($fila, $altura);
                        //$sheet->setHeight($altura);
                        $fila++;

                    } //finaliza foreach
                    $filafinal = $fila - 1;
                    $sheet->setBorder('A'.$filainicial.':R'.$filafinal, 'thin');

                    //$sheet->setValignment('center');


                });        //CIERRA PESTAÑA
            } //finaliza if
        })->export('xls');

    }
    public function viewHistorial($id)
    {
        $licencia = LicenciaConstruccion::where('cod_licencia',$id)->first();
        return view('licencias.historiallicencia', compact('licencia'));
    }
    public function gridHistorial(Request $request)
    {
        $registros = AuditoriaLicencia::where('cod_licencia',$request->codlicencia)->orderby('fecha', 'DESC')->get();

        return Datatables::of($registros)
            ->addColumn('usuario', function ($registros) {
                $usuario = User::where("id", $registros->cod_usuario)->first();
                return $usuario->name." (".$usuario->email.")";
            })
            ->make(true);
    }
    public function wsConsultarLicencia($id)
    {
        $result = [];
        $licencia = LicenciaConstruccion::join('informacion_predio', 'licencia_construccion.cod_licencia', 'informacion_predio.cod_licencia')
            ->join('datos_solicitante', 'licencia_construccion.cod_licencia', 'datos_solicitante.cod_licencia')
            ->join('caracteristicas_licencia', 'licencia_construccion.cod_licencia', 'caracteristicas_licencia.cod_licencia')
            ->where('licencia_construccion.num_licencia',$id)
            ->select(['licencia_construccion.*', 'datos_solicitante.documento', 'datos_solicitante.nombres', 'datos_solicitante.apellidos', 'datos_solicitante.cod_tipo_persona', 'informacion_predio.viaprincipal', 'informacion_predio.barrio', 'informacion_predio.numerovia', 'informacion_predio.numero1', 'informacion_predio.numero2', 'informacion_predio.complemento', 'informacion_predio.matricula', 'informacion_predio.estrato', 'informacion_predio.cedula_catastral', 'informacion_predio.cod_informacion', 'caracteristicas_licencia.des_proyecto', 'caracteristicas_licencia.cod_tipo_licencia', 'caracteristicas_licencia.cod_modalidad', 'caracteristicas_licencia.cod_objeto', 'caracteristicas_licencia.cod_tipo_uso', 'caracteristicas_licencia.num_pisos'])
            ->first();
        if(!$licencia == null) {
            $predios = Predio::select(['cod_licencia', 'barrio', 'estrato', 'cedula_catastral', 'cod_informacion', 'viaprincipal', 'numerovia', 'numero1', 'numero2', 'complemento', 'matricula'])
                ->where('cod_licencia', $licencia->cod_licencia)
                ->get();
            $txt_predios = "";
            foreach ($predios as $predio) {
                if ($txt_predios != "")
                    $txt_predios .= "|";
                $txt_predios .= $predio->viaprincipal . " " . $predio->numerovia . " # " . $predio->numero1 . " - " . $predio->numero2 . " " . $predio->complemento . ";" . $predio->barrio . ";" . $predio->matricula;
            }
            $det_modalidades = DetalleModalidad::join('modalidad', 'detalle_modalidades.cod_modalidad', 'modalidad.cod_modalidad')
                ->where('detalle_modalidades.cod_licencia', $licencia->cod_licencia)
                ->select('modalidad.des_modalidad')
                ->get();
            $txt_modalidades = "";
            foreach ($det_modalidades as $det_modalidade) {
                if ($txt_modalidades != "")
                    $txt_modalidades .= "|";
                $txt_modalidades .= $det_modalidade->des_modalidad;
            }
            $estado = DB::table('estado_licencia')->where('cod_estado', $licencia->cod_estado)->first();
            $tipolicencia = DB::table('tipo_licencia')->where('cod_tipo_licencia', $licencia->cod_tipo_licencia)->first();

            $result['num_licencia'] = $licencia->num_licencia;
            $result['fecha_ejecutoria'] = $licencia->fecha_ejecutoria;
            $result['fecha_vencimiento'] = $licencia->fecha_vence;
            $result['estado'] = $estado->des_estado_licencia;
            $result['tipo_licencia'] = $tipolicencia->des_licencia;
            $result['modalidades'] = $txt_modalidades;
            $result['predios'] = $txt_predios;
        }
        else
            $result['resultado'] = "No existe la licencia";
        return $result;
    }
}
