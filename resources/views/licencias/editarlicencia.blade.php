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
                                    <!-- <div class="form-group">
                                        <label class="col-sm-3 control-label">Número de licencia:</label>
                                        <div class="col-sm-7">
                                        { {Form::text('num_licencia', null ,['class'=>'form-control', "required", "tabindex"=>"1",'id'=>'num_licencia'])}}
                                        </div>
                                    </div> -->
                                    <?php
                                    $numeros = explode("-", $licencia->num_licencia);
                                    $num_licencia1 = $numeros[0];
                                    $num_licencia2 = $numeros[1];
                                    $num_licencia3 = $numeros[2];
                                    $num_licencia4 = $numeros[3];
                                    ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Número de licencia:</label>
                                        <div class="col-sm-1">
                                        {{Form::text('num_licencia1', '50001',['class'=>'form-control obtener', "required", "readonly","tabindex"=>"1",'id'=>'num_licencia1'])}}
                                        </div>
                                        <label class="col-sm-1 control-label">-</label>
                                        <div class="col-sm-1">
                                            {{Form::text('num_licencia2', $num_licencia2 ,['class'=>'form-control obtener', "required", "tabindex"=>"2",'id'=>'num_licencia2', 'maxlength' => 1, "data-parsley-type"=>"number"])}}
                                        </div>
                                        <label class="col-sm-1">-</label>
                                        <div class="col-sm-1">
                                            {{Form::text('num_licencia3', $num_licencia3 ,['class'=>'form-control obtener', "required", "tabindex"=>"3",'id'=>'num_licencia3','maxlength' => 2, "data-parsley-type"=>"number"])}}
                                        </div>
                                        <label class="col-sm-1">-</label>
                                        <div class="col-sm-1">
                                            {{Form::text('num_licencia4', $num_licencia4 ,['class'=>'form-control obtener', "required", "tabindex"=>"4",'id'=>'num_licencia4', 'maxlength' => 4, "data-parsley-type"=>"number"])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Fecha de radicación</label>
                                        <div class="col-sm-7">
                                            {{Form::date('fecha_radicacion', $licencia->fecha_radicacion,['class'=>'form-control', "required", "tabindex"=>"5",'id'=>'fecha_radicacion'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Fecha de de expedición</label>
                                        <div class="col-sm-7">
                                            {{Form::date('fecha_expedicion', $licencia->fecha_expedicion,['class'=>'form-control', "required", "tabindex"=>"6",'id'=>'fecha_expedicion'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Fecha de ejecutoria</label>
                                        <div class="col-sm-7">
                                            {{Form::date('fecha_ejecutoria', $licencia->fecha_ejecutoria,['class'=>'form-control', "required", "tabindex"=>"7",'id'=>'fecha_ejecutoria'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Fecha de vencimiento</label>
                                        <div class="col-sm-7">
                                            {{Form::date('fecha_vence', $licencia->fecha_vence,['class'=>'form-control', "required", "tabindex"=>"8",'id'=>'fecha_vence'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Estado</label>
                                        <div class="col-sm-7">
                                            {{Form::select('cod_estado', $estados,null,['class'=>'form-control', "required", "tabindex"=>"9",'id'=>'cod_estado'])}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Antecedentes</label>
                                        <div class="col-sm-7">
                                            {{Form::text('antecedentes', null ,['class'=>'form-control', "tabindex"=>"10",'id'=>'antecedentes'])}}
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
                                    <h3>Predios Asociados</h3>
                                    <table border="0" width="40%" align="center">
                                    <tr><td><input type="button" class="btn btn-success" value="Actualizar" onClick="location.reload();" /></td>
                                        <td><a href="{{route('gestionarPredios',$licencia->cod_licencia)}}" target="_blank"><input type="button" value="Gestionar Predios" class="btn btn-default"/></a></td></tr>
                                    </table><br>
                                    <!-- <div class="btn-block">  -->
                                    <?php $cont=1; ?>
                                    @foreach($predios as $predio)
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Dirección {{$cont}}:</label>
                                            <div class="col-sm-7">
                                            {{$predio->viaprincipal." ".$predio->numerovia." # ".$predio->numero1. " - ".$predio->numero2." ".$predio->complemento}}
                                            </div>
                                        </div>
                                        <?php $cont++; ?>
                                        @endforeach

                                </div>
                            </div>
                            <div class="tab-pane" id="paso4">
                                <div class="row">
                                    <!-- <div class="col-sm-12">
                                         <h4 class="info-text"></h4>
                                     </div>-->
                                    <div class="right">
                                        <table border="0" width="40%" align="center">
                                            <tr><td><a href="{{route('consultarHistorial',$licencia->cod_licencia)}}" target="_blank"><input type="button" value="Consultar Trazabilidad" class="btn btn-default"/></a></td></tr>
                                        </table>
                                    </div>
                                    <br>
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
                                             <select name="select_modalidad" id="select_modalidad" tabindex="3" class="form-control" required >
                                                <option>Seleccione...</option>
                                            </select>
                                        <!--{ {Form::select('cod_modalidad', $modalidades, $lista_mod,['class'=>'form-control', "required", "tabindex"=>"3",'id'=>'cod_modalidad'])}} -->
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
                                @if((Auth::User()->tipo) == "1" || (Auth::User()->tipo) == "2")
                                <input type='submit' class='btn btn-finish btn-fill btn-info btn-wd btn-sm' name='finish' value='Guardar' />
                                    @endif
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
<script src="{{asset('http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js')}}"></script>

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
    setTimeout(getMultiple, '300');
    setTimeout(getModalidades, '300');
    $("#cod_tipo_licencia").change(function () {
        getMultiple();
        getModalidades();
    });
    function getModalidades() {
        var tipo = $("#cod_tipo_licencia").val();
        var lista = <?php echo json_encode($lista_mod);?>;
        $.get('{{route('modalidades')}}', {data: tipo}, function (result) {
            $('#select_modalidad').html("");
            var entro=0;
            $.each(result, function (i, value) {
                entro=0;
                if(lista.includes(value.cod_modalidad) ){
                    entro=1;
                }
                if(entro == 1)
                {
                    $('#select_modalidad').append('<option selected="selected" value="'+value.cod_modalidad+'" >'+value.des_modalidad+'</option>');
                }
                else
                {
                    $('#select_modalidad').append('<option value="'+value.cod_modalidad+'" >'+value.des_modalidad+'</option>');
                }
            });
        });
    }
    function getMultiple() {
        //consultar si admite multiples
        var tipo = $("#cod_tipo_licencia").val();
        $.get('{{route('multiples')}}', {data: tipo}, function (result) {
            if (result.esmultiple == "1")
            {
                document.getElementById("select_modalidad").multiple = true;
                document.getElementById("select_modalidad").setAttribute('name', 'select_modalidad[]');
            }
            else {
                document.getElementById("select_modalidad").multiple = false;
                document.getElementById("select_modalidad").setAttribute('name', 'select_modalidad');
            }
        })

    }

</script>

</html>
