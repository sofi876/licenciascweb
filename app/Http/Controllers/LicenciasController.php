<?php

namespace App\Http\Controllers;
use App\LicenciaConstruccion;
use App\Solicitante;
use App\Predio;
use App\Caracteristicas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
}
