<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Control de Acceso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{asset('images/logo_alcaldia.png')}}">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons CSS -->
    <link href="css/icons.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

</head>
<body>
<!-- HOME -->
<section style="background-image: url(images/fondo_login.jpg)">
    <div class="container" >
        <div class="row">
            <div class="col-sm-12">

                <div class="wrapper-page">
                    <div class="m-t-40 card-box">
                        <div class="text-center">
                            <h2 class="text-uppercase m-t-0 m-b-30">
                                    <span><img src="{{asset('images/logo_alcaldia.png')}}" alt="" width="100" height="80"></span>
                            </h2>

                        </div>
                        <div class="account-content">
                            <form class="form-horizontal" action="{{ route('login') }}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} m-b-20">
                                    <div class="col-xs-12">
                                        <label for="emailaddress">Usuario (email)</label>
                                        <input class="form-control" type="email" id="email" name="email" required="" value="{{ old('email') }}" placeholder="nombre@gmail.com">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} m-b-20">
                                    <div class="col-xs-12">

                                        <label for="password">Contraseña</label>
                                        <input class="form-control" type="password" required="" id="password" name="password" placeholder="Ingresa tu contraseña">
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group m-b-30">
                                    <div class="col-xs-12">
                                        <div class="checkbox checkbox-primary">
                                            <input id="checkbox5" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label for="checkbox5">
                                                Recordarme
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group account-btn text-center m-t-10">
                                    <div class="col-xs-12">
                                        <button class="btn btn-lg btn-custom btn-block" type="submit">Ingresar</button>
                                    </div>
                                </div>

                            </form>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <div class="row m-t-50">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">No tienes cuenta? <a href="{{ route('register') }}" class="text-dark m-l-5">Registrate</a></p>
                        </div>
                    </div>

                </div>
                <!-- end wrapper -->

            </div>
        </div>
    </div>
</section>
<!-- END HOME -->

<!-- js placed at the end of the document so the pages load faster -->
<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>

<!-- App Js -->
<script src="js/jquery.app.js"></script>

</body>
</html>
