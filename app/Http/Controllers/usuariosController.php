<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class usuariosController extends Controller
{
    //
    public function verCrearUsuario()
    {
        return view('auth.register');
    }
    public function funcionCrearUsuario(Request $request)
    {
        $result = [];
        \DB::beginTransaction();
        try {
            $validator = \Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);
            $usuario = new User();

            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);
            $usuario->tipo = $request->tipo;
            $usuario->notificar = $request->notificar;
            $usuario->save();
            \DB::commit();
            return redirect()->back()->with("success","El usuario ha sido creado !");
        } catch (\Exception $exception) {
            return redirect()->back()->with("error","El usuario no pudo ser creado. Intente otro email.");

            \DB::rollBack();
        }
        return $result;
    }
    public function consultarUsuarios()
    {
        $usuarios = User::all();
        return view('usuarios.consultar', compact('usuarios'));
    }
    public function gridConsultarUsuarios()
    {
        $tarjetas = Tarjetas::join('tarjeta_servicios', 'tarjetas.numero_tarjeta', 'tarjeta_servicios.numero_tarjeta')
            ->join('detalle_produtos', 'tarjetas.numero_tarjeta', 'detalle_produtos.numero_tarjeta')
            ->where('tarjeta_servicios.servicio_codigo', Tarjetas::$CODIGO_SERVICIO_BONO)
            ->where('detalle_produtos.estado', '<>', TarjetaServicios::$ESTADO_ANULADA)
            ->where('detalle_produtos.contrato_emprs_id', '<>', null)
            ->select(['detalle_produtos.monto_inicial', 'detalle_produtos.contrato_emprs_id as idcontrato', 'detalle_produtos.id as deta_id', 'tarjetas.*', 'detalle_produtos.fecha_vencimiento as vencimiento', 'detalle_produtos.estado as estado'])
            ->get();
        return Datatables::of($tarjetas)
            ->addColumn('numcontrato', function ($tarjetas) {
                $contrato = Contratos_empr::where("id", $tarjetas->idcontrato)->first();
                return $contrato->n_contrato;
            })
            ->addColumn('action', function ($tarjetas) {
                $acciones = "";
                $acciones .= '<div class="btn-group">';
                $acciones .= '<a data-modal href="' . route('gestionarTarjeta', $tarjetas->deta_id) . '" type="button" class="btn btn-custom btn-xs">Gestionar</a>';
                if (Shinobi::can('editar.fecha.bono')) {
                    $acciones .= '<a data-modal href="' . route('bono.editar', $tarjetas->deta_id) . '" type="button" class="btn btn-custom btn-xs">Editar</a>';
                }
                if ($tarjetas->estado == Tarjetas::$ESTADO_TARJETA_INACTIVA) {
                    $acciones .= '<button type="button" class="btn btn-custom btn-xs" onclick="activar(' . $tarjetas->deta_id . ')">Activar</button>';
                }

                $acciones .= '</div>';
                return $acciones;
            })
            ->make(true);
    }
    public function editarUsuario(Request $request)
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
