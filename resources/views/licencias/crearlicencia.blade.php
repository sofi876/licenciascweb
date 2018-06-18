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
                                    <small>Ingrese los datos que se indican:</small>
                                </h3>
                            </div>
                            <div class="wizard-navigation">
                                <ul>
                                    <li><a href="#paso1" data-toggle="tab">1. Datos de la licencia</a></li>
                                    <li><a href="#paso2" data-toggle="tab">2. Solicitante</a></li>
                                    <li><a href="#paso3" data-toggle="tab">3. Predio</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane" id="paso1">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="info-text"> Let's start with the basic details</h4>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Número de licencia:</label>
                                            <div class="col-sm-7">
                                            {{Form::text('numero_licencia', null ,['class'=>'form-control', "required", "tabindex"=>"1",'id'=>'numero_licencia'])}} <!-- "data-parsley-type"=>"number"] -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Fecha de radicación</label>
                                            <div class="col-sm-7">
                                                {{Form::date('name', \Carbon\Carbon::now(),['class'=>'form-control', "required", "tabindex"=>"1",'id'=>'numero_contrato'])}}
                                            </div>
                                        </div>
                                        <div class="col-sm-5 col-sm-offset-1">
                                            <div class="form-group">
                                                <label>What city is your boat in?</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Where is your boat located?">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Boat Type</label>
                                                <select class="form-control">
                                                    <option disabled="" selected="">- boat type -</option>
                                                    <option>Power</option>
                                                    <option>Sail</option>
                                                    <option>Paddle</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 col-sm-offset-1">
                                            <div class="form-group">
                                                <label>Year Manufacture</label>
                                                <select class="form-control">
                                                    <option disabled="" selected="">- year -</option>

                                                    <option>2013</option>
                                                    <option>2014</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Daily Price</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control">
                                                    <span class="input-group-addon">$</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="paso2">
                                    <h4 class="info-text">Do you include a captain? </h4>
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Renters you approve will be able to take this boat">
                                                    <input type="radio" name="job" value="Design">
                                                    <div class="icon">
                                                        <i class="fa fa-life-ring"></i>
                                                    </div>
                                                    <h6>No Captain</h6>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Select this option if you or a certified captain will be included.">
                                                    <input type="radio" name="job" value="Code">
                                                    <div class="icon">
                                                        <i class="fa fa-male"></i>
                                                    </div>
                                                    <h6>Includes Captain</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="paso3">
                                    <div class="row">
                                        <h4 class="info-text"> Drop us a small description </h4>
                                        <div class="col-sm-6 col-sm-offset-1">
                                            <div class="form-group">
                                                <label>Boat description</label>
                                                <textarea class="form-control" placeholder="" rows="9">
                                            </textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Example</label>
                                                <p class="description">"The boat really nice name is recognized as being a really awesome boat. We use it every sunday when we go fishing and we catch a lot. It has some kind of magic shield around it."</p>
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
