<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="wizard/img/apple-icon.png">
    <link rel="icon" type="image/png" href="wizard/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Crear Licencia</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!--     Fonts and icons     -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="wizard/css/bootstrap.min.css" rel="stylesheet" />
    <link href="wizard/css/gsdk-bootstrap-wizard.css" rel="stylesheet" />
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
                        {{Form::open(['route'=>['funcioncrearlicencia'], 'class'=>'form-horizontal', 'id'=>'crearlicencia'])}} <!-- -->
                        <!--<form action="" method=""> -->
                            <!--        You can switch ' data-color="azzure" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->

                            <div class="wizard-header">
                                <h3>
                                    <b>Crear Licencia</b> <br>
                                    <small>Ingrese los datos que se solicitan:</small>
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
                                                {{Form::date('fradicacion', \Carbon\Carbon::now(),['class'=>'form-control', "required", "tabindex"=>"2",'id'=>'fradicacion'])}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Fecha de de expedición</label>
                                            <div class="col-sm-7">
                                                {{Form::date('fexpedicion', \Carbon\Carbon::now(),['class'=>'form-control', "required", "tabindex"=>"3",'id'=>'fexpedicion'])}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Fecha de ejecutoria</label>
                                            <div class="col-sm-7">
                                                {{Form::date('fejecutoria', \Carbon\Carbon::now(),['class'=>'form-control', "required", "tabindex"=>"4",'id'=>'fejecutoria'])}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Fecha de vencimiento</label>
                                            <div class="col-sm-7">
                                                {{Form::date('fvence', \Carbon\Carbon::now(),['class'=>'form-control', "required", "tabindex"=>"5",'id'=>'fvence'])}}
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
                                                {{Form::text('antecedentes', null ,['class'=>'form-control', "tabindex"=>"7",'id'=>'antecedentes'])}}
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
                                            <div class="col-sm-2">
                                                <select class="form-control obtener" id="viaprincipal" tabindex="1" name="viaprincipal">
                                                    <option value="AP">AUTOPISTA</option>
                                                    <option value="AV">AVENIDA</option>
                                                    <option value="AC">AVENIDA CALLE</option>
                                                    <option value="AK">AVENIDA CARRERA</option>
                                                    <option value="CL" selected="selected">CALLE</option>
                                                    <option value="CRA">CARRERA</option>
                                                    <option value="CIRC">CIRCUNVALAR</option>
                                                    <option value="DG">DIAGONAL</option>
                                                    <option value="MANZ">MANZANA</option>
                                                    <option value="TV">TRANSVERSAL</option>
                                                    <option value="VIA">VIA</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" id="numerovia" name="numerovia" tabindex="2" class="form-control obtener"
                                                       data-parsley-type="alphanum" maxlength="5" required>
                                            </div>
                                            <label class="col-sm-1 control-label">#</label>
                                            <div class="col-sm-1">
                                                <input type="text" id="numero1" name="numero1" tabindex="3" class="form-control obtener"
                                                       data-parsley-type="alphanum" maxlength="5" required>
                                            </div>
                                            <label class="col-sm-1 control-label">-</label>
                                            <div class="col-sm-1">
                                                <input type="text" id="numero2" name="numero2" tabindex="4" class="form-control obtener"
                                                       data-parsley-type="number"  maxlength="5" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Complemento:</label>
                                            <div class="col-sm-7">
                                                <input type="text" id="complemento" name="complemento" tabindex="5" class="form-control obtener"
                                                       data-parsley-pattern="^[a-zA-Z0-9]+(\s*[a-zA-Z0-9]*)*[a-zA-Z0-9]+$"  maxlength="60">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Barrio:</label>
                                            <div class="col-sm-7">
                                            {{Form::text('barrio', null,['class'=>'form-control', "required", "tabindex"=>"6",'id'=>'barrio'])}} <!-- "data-parsley-type"=>"number"] -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Estrato:</label>
                                            <div class="col-sm-7">
                                            {{Form::number('estrato', null ,['class'=>'form-control', "required", "tabindex"=>"7",'id'=>'estrato','min'=>'0','max'=>'6'])}} <!-- "data-parsley-type"=>"number"] -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Cédula Catastral:</label>
                                            <div class="col-sm-7">
                                            {{Form::text('cedula_catastral', null ,['class'=>'form-control', "tabindex"=>"8",'id'=>'cedula_catastral'])}} <!-- "data-parsley-type"=>"number"] -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Matricula Inmobiliaria:</label>
                                            <div class="col-sm-7">
                                            {{Form::text('matricula', null ,['class'=>'form-control', "required", "tabindex"=>"9",'id'=>'matricula'])}} <!-- "data-parsley-type"=>"number"] -->
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
                                                <select name="select_modalidad" id="select_modalidad" tabindex="3" class="form-control" required>
                                                    <option>Seleccione...</option>
                                                </select>
                                                <!--{ {Form::select('cod_modalidad', $modalidades,null,['class'=>'form-control', "required", "tabindex"=>"3",'id'=>'cod_modalidad'])}} -->
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
<script src="wizard/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="wizard/js/bootstrap.min.js" type="text/javascript"></script>
<script src="wizard/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
<script src="{{asset('plugins/sweet-alert2/sweetalert2.min.js')}}"></script>

<script src="{{asset('plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>


<!--  Plugin for the Wizard -->
<script src="wizard/js/gsdk-bootstrap-wizard.js"></script>

<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
<script src="wizard/js/jquery.validate.min.js"></script>
<script>
    $(function () {
        $("#crearlicencia").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route("funcioncrearlicencia")}}',
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
    setTimeout(getModalidades, '300');
    setTimeout(getMultiple, '300');
    $("#cod_tipo_licencia").change(function () {
        getModalidades();
        getMultiple();
    });
    function getModalidades() {
        var tipo = $("#cod_tipo_licencia").val();
        $.get('{{route('modalidades')}}', {data: tipo}, function (result) {
            $('#select_modalidad').html("");
            $.each(result, function (i, value) {
                $('#select_modalidad').append($('<option>').text(value.des_modalidad).attr('value', value.cod_modalidad));
            });
        })
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
