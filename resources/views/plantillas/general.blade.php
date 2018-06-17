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

    <!-- Custom styles for this template -->
    {{Html::Style('css/style.css')}}
    @yield("styles")
</head>


<body>

<div id="page-wrapper">

    <!-- Top Bar Start -->
    <div class="topbar" id="topnav">

        <!-- Top navbar -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <div class="">

                                <img src="{{url('images/logo_alcaldia2.png')}}" width="90" height="70" alt="logo"  />


                        </div>
                    </div>
                @include('plantillas.menusuperior')

                </div>
            </div> <!-- end container -->
        </div> <!-- end navbar -->
    </div>
    <!-- Top Bar End -->

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

<!-- App Js -->
<!-- <script src="js/jquery.app.js"></script> -->
{{Html::Script("js/jquery.app.js")}}
@yield("scripts")

</body>
</html>