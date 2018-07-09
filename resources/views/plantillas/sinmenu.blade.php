<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Licencias de construcción</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Sistemas de registro de Licencias de construcción" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{asset('images/logo_alcaldia.png')}}">

    <!-- Bootstrap core CSS -->
{{Html::Style('css/bootstrap.min.css')}}

<!-- Icons CSS -->
    {{Html::Style('css/icons.css')}}
    <link href="{{asset('plugins/sweet-alert2/sweetalert2.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset('plugins/switchery/switchery.min.css')}}">

    <!-- Custom styles for this template -->
    {{Html::Style('css/style.css')}}

<!-- <link rel="stylesheet" href="{ {asset('css/stylemenu.css')}}"> -->

    @yield("styles")
</head>

<body>

<div id="page-wrapper">

    @yield('contenido')
</div>
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="pull-right hidden-xs">
                    <strong class="text-custom"><font color="#006400">Alcaldia de Villavicencio</font></strong><img src="{{url('images/logo_alcaldia.png')}}" width="70" height="50" alt="">
                </div>
                <div>
                    <strong>Licencias de Construcción  </strong> - Copyright &copy; 2018
                </div>
            </div>
        </div>
    </div>
</div> <!-- end footer -->

<!-- <div class="clearfix"></div>  ->


<!-- js placed at the end of the document so the pages load faster -->
{{Html::Script("js/jquery-2.1.4.min.js")}}
{{Html::Script("js/bootstrap.min.js")}}
{{Html::Script("js/jquery.slimscroll.min.js")}}

<script src="{{asset('plugins/sweet-alert2/sweetalert2.min.js')}}"></script>

<script src="{{asset('plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>

<!-- App Js -->
<!-- <script src="js/jquery.app.js"></script> -->
{{Html::Script("js/jquery.app.js")}}
@yield("scripts")

</body>
</html>