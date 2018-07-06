@extends('plantillas.general')
@section('contenido')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" >
                    <h4><a href="{{route('consultarUsuarios')}}">Volver a lista de usuarios</a> </h4>
                    <div class="card-header" align="center"><h2>Editar Usuario</h2></div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                            {{Form::model($usuario,['route'=>['funcionEditarUsuario',$usuario->id], 'class'=>'form-horizontal', 'id'=>'editarusuario'])}}
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    {{Form::text('name', null ,['class'=>'form-control', "id"=>"name", "required", "tabindex"=>"1"])}}
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    {{Form::email('email', null ,['class'=>'form-control', "id"=>"email", "required", "tabindex"=>"2"])}}
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                                <div class="col-md-6">
                                    {{Form::select('tipo', ['1' => 'Administrador', '2' => 'Funcionario', '3' => 'Consultas'], null,['class'=>'form-control', "required", "tabindex"=>"3",'id'=>'tipo','value'=>old('tipo')])}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Notificar denuncias') }}</label>
                                <div class="col-md-6">
                                    {{Form::select('notificar', ['0' => 'No', '1' => 'Si'], null,['class'=>'form-control', "required", "tabindex"=>"4",'id'=>'notificar','value'=>old('tipo')])}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>
                                <div class="col-md-6">
                                    {{Form::select('activo', ['1' => 'Activo', '0' => 'Inactivo'], null,['class'=>'form-control', "required", "tabindex"=>"5",'id'=>'activo','value'=>old('activo')])}}
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Actualizar') }}
                                    </button>
                                </div>
                            </div>
                            {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
