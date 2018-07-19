@extends('plantillas.general')
@section('contenido')
<!-- Page content start -->
<div class="page-contentbar">
    <!-- START PAGE CONTENT -->
    <div id="page-right-content">

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="header-title m-t-0 m-b-20">Bienvenido <font color="#006400">{{Auth::User()->name}} </font>al sistema de publicación de Licencias de Construcción</h4>

                    <h4>Su perfil es de : <font color="#006400">
                            @if((Auth::User()->tipo) == "1")
                                {{$name_tipo = "Administrador"}}
                            @endif
                            @if((Auth::User()->tipo) == "2")
                                {{$name_tipo = "Funcionario"}}
                            @endif
                            @if((Auth::User()->tipo) == "3")
                                {{$name_tipo = "Consultas"}}
                            @endif
                        </font></h4>
                    Aquí podrá realizar las siguientes funciones:<br><br>
                    * <b>Administrador</b><br>
                    <ul>
                        <li>Registrar una licencia de construcción</li>
                        <li>Consultar y editar la información de una licencia de construcción</li>
                        <li>Crear, consultar y editar Usuarios del aplicativo</li>
                        <li>Consultar y responder Denuncias</li>
                    </ul><br>
                    * <b>Funcionario</b><br>
                    <ul>
                        <li>Registrar una licencia de construcción</li>
                        <li>Consultar y editar la información de una licencia de construcción</li>
                        <li>Consultar y responder Denuncias</li>
                    </ul><br>
                    * <b>Consultas</b><br>
                    <ul>
                        <li>Consultar la información de una licencia de construcción</li>
                    </ul><br>
                    * <b>Denuncias</b><br>
                    <ul>
                        <li>Consultar la información de una licencia de construcción</li>
                        <li>Consultar y responder Denuncias</li>
                    </ul>
                </div>
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>
</div>
    <!-- End #page-right-content -->
<!-- end .page-contentbar -->
@endsection