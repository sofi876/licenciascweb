@extends('plantillas.general')

@section('styles')
    <link href="{{asset('plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('plugins/datatables/dataTables.colVis.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('plugins/datatables/fixedColumns.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('contenido')
    <div class="container">
        <!-- <div class="row" align="center"><h2>Consulta de Licencias</h2></div> -->
        <br>
        <div class="row">
            <div class="col-sm-12">
                <h4 class="header-title m-t-0 m-b-20">Consulta de Denuncias</h4>
            </div>
        </div>
        <br>

        <div id="ocultofechas" class="row" style="display:block">
            {{Form::open(['class'=>'form-horizontal', 'id'=>'consultarxfechas', 'target'=>"_blank",'role'=>'form','method'=>'POST'])}}
            <div  class="form-group">
                <label class="col-sm-3 control-label">Desde</label>
                <div class="col-sm-7">
                    {{Form::date('fecha1', \Carbon\Carbon::now(),['class'=>'form-control', "required", "tabindex"=>"3",'id'=>'fecha1'])}}
                </div>
                <label class="col-sm-3 control-label">Hasta</label>
                <div class="col-sm-7">
                    {{Form::date('fecha2', \Carbon\Carbon::now(),['class'=>'form-control', "required", "tabindex"=>"4",'id'=>'fecha2'])}}
                </div>
            </div>
            <p align="center"><button type="button" id="CrearB" class="btn btn-custom waves-effect waves-light" onclick="consultarfechas()">Buscar</button></p>
            {{Form::close()}}
        </div>
        <div id="tablaoculta" name="tablaoculta" style="display: none;">
            <div class="row">
                <div class="col-sm-12">

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/responsive.bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.colVis.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.fixedColumns.min.js')}}"></script>

    <script>
        var table;
        $(function () {
            $("#ocultofechas").submit(function (e) {
                e.preventDefault();
                consultarfechas();
            });
        });
        function consultarfechas() {
            var fecha1=$('#fecha1').val();
            var fecha2=$('#fecha2').val();
            $('#tablaoculta').load('{{route('consultarxFecha')}}',{_token: '{{csrf_token()}}',fecha1:fecha1,fecha2:fecha2});
            document.getElementById("tablaoculta").style.display = "block";
        }
    </script>
@endsection