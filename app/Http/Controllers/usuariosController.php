<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

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
            $usuario->notificar_licencia = $request->notificar_licencia;
            $usuario->notificar_denuncia = $request->notificar_denuncia;
            $usuario->activo = "1";
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
        $users = User::select(['id','name','email','tipo','notificar_licencia','notificar_denuncia','activo'])->get();
        return Datatables::of($users)
            ->addColumn('action', function ($users) {
                $acciones = "";
                $acciones .= '<div class="btn-group">';
                $acciones .= '<a data-modal href="' . route('editarUsuario', $users->id) . '" type="button" class="btn btn-custom btn-xs">Editar</a>';
                $acciones .= '</div>';
                return $acciones;
            })
            ->make(true);
    }
    public function verEditarUsuario($id)
    {
        $usuario = User::find($id);
        return view('usuarios.editar', compact('usuario'));
    }
    public function funcionEditarUsuario(Request $request, $id)
    {
        $result = [];
        \DB::beginTransaction();
        try {

            $validator = \Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
            ]);
            $usuario = User::find($id);
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->tipo = $request->tipo;
            $usuario->notificar_licencia = $request->notificar_licencia;
            $usuario->notificar_denuncia = $request->notificar_denuncia;
            $usuario->activo = $request->activo;
            $usuario->save();
            \DB::commit();
            return redirect()->back()->with("success","El usuario ha sido actualizado!");
        } catch (\Exception $exception) {
            return redirect()->back()->with("error","El usuario no pudo ser actualizado. El email debe ser unico.");
            \DB::rollBack();
        }
        return $result;

    }

}
