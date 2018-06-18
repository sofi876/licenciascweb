<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="wizard/img/apple-icon.png">
    <link rel="icon" type="image/png" href="wizard/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Crear Licencia</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!--     Fonts and icons     -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="wizard/css/bootstrap.min.css" rel="stylesheet" />
    <link href="wizard/css/gsdk-bootstrap-wizard.css" rel="stylesheet" />
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
                        <form action="" method="">
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
                                            {{Form::text('numero_licencia', null ,['class'=>'form-control', "required", "tabindex"=>"1",'id'=>'numero_licencia'])}} <!-- "data-parsley-type"=>"number"] -->
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
                                <div class="tab-pane" id="paso4">
                                    <div class="row">
                                        <!-- <div class="col-sm-12">
                                             <h4 class="info-text"></h4>
                                         </div>-->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Número de licencia:</label>
                                            <div class="col-sm-7">
                                            {{Form::text('numero_licencia', null ,['class'=>'form-control', "required", "tabindex"=>"1",'id'=>'numero_licencia'])}} <!-- "data-parsley-type"=>"number"] -->
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
                                                {{Form::select('cod_estado', $estados,null,['class'=>'form-control', "required", "tabindex"=>"6",'id'=>'estado'])}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Estado</label>
                                            <div class="col-sm-7">
                                                {{Form::text('antecedentes', null ,['class'=>'form-control', "required", "tabindex"=>"7",'id'=>'antecedentes'])}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="paso1">
                                    <div class="row">
                                        <!-- <div class="col-sm-12">
                                             <h4 class="info-text"></h4>
                                         </div>-->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Número de licencia:</label>
                                            <div class="col-sm-7">
                                            {{Form::text('numero_licencia', null ,['class'=>'form-control', "required", "tabindex"=>"1",'id'=>'numero_licencia'])}} <!-- "data-parsley-type"=>"number"] -->
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
                                                {{Form::select('cod_estado', $estados,null,['class'=>'form-control', "required", "tabindex"=>"6",'id'=>'estado'])}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Estado</label>
                                            <div class="col-sm-7">
                                                {{Form::text('antecedentes', null ,['class'=>'form-control', "required", "tabindex"=>"7",'id'=>'antecedentes'])}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-footer">
                                <div class="pull-right">
                                    <input type='button' class='btn btn-next btn-fill btn-info btn-wd btn-sm' name='next' value='Siguiente' />
                                    <input type='button' class='btn btn-finish btn-fill btn-info btn-wd btn-sm' name='finish' value='Guardar' />
                                </div>
                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Anterior' />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div> <!-- wizard container -->
            </div>
        </div> <!-- row -->
    </div> <!--  big container -->

    <div class="footer">
        <br>
    </div>


</div>

</body>

<!--   Core JS Files   -->
<script src="wizard/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="wizard/js/bootstrap.min.js" type="text/javascript"></script>
<script src="wizard/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<script src="wizard/js/gsdk-bootstrap-wizard.js"></script>

<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
<script src="wizard/js/jquery.validate.min.js"></script>

</html>
