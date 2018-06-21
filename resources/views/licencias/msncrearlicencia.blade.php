@extends('plantillas.general')
@section('contenido')
    <!-- Page content start -->
    <div class="page-contentbar">

        <!-- START PAGE CONTENT -->
        <div id="page-right-content">

            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="header-title m-t-0 m-b-20">Licencia Creada!</h4>

                        <p>La licencia ha sido ingresada con éxito</p>

                        <a href="{{route("crearlicencia")}}">Ingresar nueva licencia </a>
                    </div>
                </div> <!-- end row -->
            </div>
            <!-- end container -->
        </div>
    </div>
    <!-- End #page-right-content -->
    <!-- end .page-contentbar -->
@endsection