@extends('plantillas.general')
@section('contenido')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header" align="center"><h1>Consultar Denuncia</h1></div>
                    <div class="row">
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
                        {{Form::open(['route'=>['funcionEditarDenuncia',$denuncia->cod_denuncia], 'class'=>'form-horizontal', 'id'=>'editardenuncia'])}}
                        @csrf

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Fecha:</label>
                                <div class="col-sm-7">
                                    {{$denuncia->fecha}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Descripción:</label>
                                <div class="col-sm-7">
                                    {{$denuncia->des_denuncia}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Número de licencia Asociado:</label>
                                <div class="col-sm-7">
                                {{$num_licencia}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Imagen:</label>
                                <div class="col-sm-7">
                                    <!-- tener en cuenta el tipo de formato de la foto jpg, png etc -->
                                    @if($denuncia->imagen != "")
                                        <!-- <img src="data:image/jpg;base64,{ {$denuncias->imagen}}" alt="foto" width=100px height=100px /> -->
                                    <img src="{{$denuncia->imagen}}" alt="foto"  height=300px /> <!-- width=300px -->
                                    @else
                                    < Sin imagen >
                                        @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Georeferencia:</label>
                                <div class="col-sm-7">
                                    {{$denuncia->georeferencia}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Estado:</label>
                                <div class="col-sm-7">
                                    {{Form::select('cod_estado_denuncia', $estados,$denuncia->cod_estado_denuncia,['class'=>'form-control', "required", "tabindex"=>"6",'id'=>'cod_estado_denuncia'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Observación:</label>
                                <div class="col-sm-7">
                                {{Form::textarea('observacion', $denuncia->observacion ,['class'=>'form-control', "tabindex"=>"1",'id'=>'observacion'])}} <!-- "data-parsley-type"=>"number"] -->
                                </div>
                            </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" class="btn btn-primary" value="Guardar" />
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
