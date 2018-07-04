<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="wizard/img/apple-icon.png">
    <link rel="icon" type="image/png" href="wizard/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Editar Licencia</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!--     Fonts and icons     -->
    <link href="{{asset('http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css')}}" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{asset('wizard/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('wizard/css/gsdk-bootstrap-wizard.css')}}" rel="stylesheet" />
    {!!Html::style('plugins/sweet-alert2/animate.css')!!}

    <link href="{{asset('plugins/sweet-alert2/sweetalert2.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset('plugins/switchery/switchery.min.css')}}">


</head>
<body>
<div >
    <!--   Big container   -->
    <div class="container">
        <div class="row">
            <div >
                <!--      Wizard container        -->
                <div class="wizard-container">
                    <div class="card wizard-card" data-color="azzure" id="wizard">
                    {{Form::model($licencia,['route'=>['funcionEditarLicencia', $licencia->cod_licencia], 'class'=>'form-horizontal', 'id'=>'editarlicencia'])}} <!-- -->

                        <!--<form action="" method=""> -->
                        <!--        You can switch ' data-color="azzure" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->

                        <div class="wizard-header">
                            <h3>
                                <b>Editar Licencia</b> <br>
                                <small>Puede ver y modificar los datos que se muestran a continuación:</small>
                            </h3>
                        </div>
                        <div class="wizard-navigation">
                            <ul>
                                <li><a href="#paso1" data-toggle="tab">1. Datos de la licencia</a></li>
                                <li><a href="#paso2" data-toggle="tab">2. Solicitante</a></li>
                                <li><a href="#paso3" data-toggle="tab">3. Predio</a></li>
                                <li><a href="#paso4" data-toggle="tab">4. Características</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane" id="paso1">
                                <div class="row">
                                    <!-- <div class="col-sm-12">
                                         <h4 class="info-text"></h4>
                                     </div>-->
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Número de licencia:</label>
                                        <div class="col-sm-7">
                                        {{Form::text('num_licencia', null ,['class'=>'form-control', "required", "tabindex"=>"1",'id'=>'num_licencia'])}} <!-- "data-parsley-type"=>"number"] -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Fecha de radicación</label>
                                        <div class="col-sm-7">
                                            {{Form::date('fecha_radicacion', $licencia->fecha_radicacion,['class'=>'form-control', "required", "tabindex"=>"2",'id'=>'fecha_radicacion'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Fecha de de expedición</label>
                                        <div class="col-sm-7">
                                            {{Form::date('fecha_expedicion', $licencia->fecha_expedicion,['class'=>'form-control', "required", "tabindex"=>"3",'id'=>'fecha_expedicion'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Fecha de ejecutoria</label>
                                        <div class="col-sm-7">
                                            {{Form::date('fecha_ejecutoria', $licencia->fecha_ejecutoria,['class'=>'form-control', "required", "tabindex"=>"4",'id'=>'fecha_ejecutoria'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Fecha de vencimiento</label>
                                        <div class="col-sm-7">
                                            {{Form::date('fecha_vence', $licencia->fecha_vence,['class'=>'form-control', "required", "tabindex"=>"5",'id'=>'fecha_vence'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Estado</label>
                                        <div class="col-sm-7">
                                            {{Form::select('cod_estado', $estados,null,['class'=>'form-control', "required", "tabindex"=>"6",'id'=>'cod_estado'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Antecedentes</label>
                                        <div class="col-sm-7">
                                            {{Form::text('antecedentes', null ,['class'=>'form-control', "required", "tabindex"=>"7",'id'=>'antecedentes'])}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="paso2">
                                <div class="row">
                                    <!-- <div class="col-sm-12">
                                         <h4 class="info-text"></h4>
                                     </div>-->
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Documento:</label>
                                        <div class="col-sm-7">
                                        {{Form::text('documento', null ,['class'=>'form-control', "required", "tabindex"=>"1",'id'=>'documento'])}} <!-- "data-parsley-type"=>"number"] -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nombres:</label>
                                        <div class="col-sm-7">
                                        {{Form::text('nombres', null ,['class'=>'form-control', "required", "tabindex"=>"2",'id'=>'nombres'])}} <!-- "data-parsley-type"=>"number"] -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Apellidos:</label>
                                        <div class="col-sm-7">
                                        {{Form::text('apellidos', null ,['class'=>'form-control', "required", "tabindex"=>"3",'id'=>'apellidos'])}} <!-- "data-parsley-type"=>"number"] -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tipo de persona</label>
                                        <div class="col-sm-7">
                                            {{Form::select('cod_tipo_persona', $tipospersona,null,['class'=>'form-control', "required", "tabindex"=>"4",'id'=>'cod_tipo_persona'])}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="paso3">
                                <div class="row">
                                    <!-- <div class="col-sm-12">
                                         <h4 class="info-text"></h4>
                                     </div>-->
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Dirección:</label>
                                        <div class="col-sm-7">
                                        {{Form::text('direccion', null ,['class'=>'form-control', "required", "tabindex"=>"1",'id'=>'direccion'])}} <!-- "data-parsley-type"=>"number"] -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Barrio:</label>
                                        <div class="col-sm-7">
                                        {{Form::text('barrio', null,['class'=>'form-control', "required", "tabindex"=>"2",'id'=>'barrio'])}} <!-- "data-parsley-type"=>"number"] -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Manzana:</label>
                                        <div class="col-sm-7">
                                        {{Form::text('manzana', null ,['class'=>'form-control', "required", "tabindex"=>"3",'id'=>'manzana'])}} <!-- "data-parsley-type"=>"number"] -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Lote:</label>
                                        <div class="col-sm-7">
                                        {{Form::text('lote', null ,['class'=>'form-control', "required", "tabindex"=>"4",'id'=>'lote'])}} <!-- "data-parsley-type"=>"number"] -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Estrato:</label>
                                        <div class="col-sm-7">
                                        {{Form::number('estrato', null ,['class'=>'form-control', "required", "tabindex"=>"5",'id'=>'estrato','min'=>'0','max'=>'6'])}} <!-- "data-parsley-type"=>"number"] -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cédula Catastral:</label>
                                        <div class="col-sm-7">
                                        {{Form::text('cedula_catastral', null ,['class'=>'form-control', "required", "tabindex"=>"6",'id'=>'cedula_catastral'])}} <!-- "data-parsley-type"=>"number"] -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="paso4">
                                <div class="row">
                                    <!-- <div class="col-sm-12">
                                         <h4 class="info-text"></h4>
                                     </div>-->
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Descripción del proyecto:</label>
                                        <div class="col-sm-7">
                                        {{Form::text('des_proyecto', null ,['class'=>'form-control', "required", "tabindex"=>"1",'id'=>'numero_licencia'])}} <!-- "data-parsley-type"=>"number"] -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tipo de Licencia</label>
                                        <div class="col-sm-7">
                                            {{Form::select('cod_tipo_licencia', $tiposlicencia,null,['class'=>'form-control', "required", "tabindex"=>"2",'id'=>'cod_tipo_licencia'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Modalidad</label>
                                        <div class="col-sm-7">
                                            {{Form::select('cod_modalidad', $modalidades,null,['class'=>'form-control', "required", "tabindex"=>"3",'id'=>'cod_modalidad'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Objeto</label>
                                        <div class="col-sm-7">
                                            {{Form::select('cod_objeto', $objetos,null,['class'=>'form-control', "required", "tabindex"=>"4",'id'=>'cod_objeto'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tipo de uso</label>
                                        <div class="col-sm-7">
                                            {{Form::select('cod_tipo_uso', $tiposuso,null,['class'=>'form-control', "required", "tabindex"=>"5",'id'=>'cod_tipo_uso'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Número de pisos</label>
                                        <div class="col-sm-7">
                                            {{Form::number('num_pisos', null ,['class'=>'form-control', "required", "tabindex"=>"6",'id'=>'num_pisos','min'=>'1'])}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-fill btn-info btn-wd btn-sm' name='next' value='Siguiente' />
                                <input type='submit' class='btn btn-finish btn-fill btn-info btn-wd btn-sm' name='finish' value='Guardar' />
                            </div>
                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Anterior' />
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div> <!-- wizard container -->
            </div>
        </div> <!-- row -->
    </div> <!--  big container -->

</div>
</body>

<!--   Core JS Files   -->
<script src="{{asset('wizard/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('wizard/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('wizard/js/jquery.bootstrap.wizard.js')}}" type="text/javascript"></script>
<script src="{{asset('plugins/sweet-alert2/sweetalert2.min.js')}}"></script>

<script src="{{asset('plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>

<!--  Plugin for the Wizard -->
<script src="{{asset('wizard/js/gsdk-bootstrap-wizard.js')}}"></script>

<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
<script src="{{asset('wizard/js/jquery.validate.min.js')}}"></script>
<script>
    $(function () {
        $("#editarlicencia").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                type: "POST",
                context: document.body,
                url: "{!!route('funcionEditarLicencia',['id'=>$licencia->cod_licencia])!!}",
                //url: '{ { route("funcionEditarLicencia")}}',
                data: form.serialize(),
                /*beforeSend: function () {
                    cargando();
                },*/
                success: function (result) {
                    //alert(result.mensaje);
                    if (result.estado) {
                        swal(
                            {
                                title: 'Bien!!',
                                text: result.mensaje,
                                type: 'success',
                                confirmButtonColor: '#4fa7f3'
                            }
                        ).then(function(){
                            location.reload();
                        });
                    } else {
                        swal(
                            'Error!!',
                            result.mensaje,
                            'error'
                        )
                    }
                },
                error: function (xhr, status) {
                }
                // código a ejecutar sin importar si la petición falló o no
                /*complete: function (xhr, status) {
                    fincarga();
                }*/
            });
        });
    });

</script>

</html>
