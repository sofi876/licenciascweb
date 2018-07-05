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
                    <h4 class="header-title m-t-0 m-b-20">Consulta de Licencias</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p>Seleccione el tipo de consulta:</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <!-- <h4 class="header-title m-t-0 m-b-20"> </h4>-->
                    <div style="width:100%">
                            <div class="rowpst">
                                <div class="columnpst" style="background-color:#2E64FE; text-align: center;">{{Form::radio('filtro', '1',true,['onclick'=>'mostrar(this)', 'value'=>'1'])}} <strong><font color="black"> Número de licencia</font></strong></div>
                                <div class="columnpst" style="background-color:#06AEF1; text-align: center;">{{Form::radio('filtro', '2', false, ['onclick'=>'mostrar(this)','value'=>'2'])}} <strong><font color="black">Rango de fechas</font></strong></div>
                                <div class="columnpst" style="background-color:#2E64FE; text-align: center;">{{Form::radio('filtro', '3', false, ['onclick'=>'mostrar(this)','value'=>'3'])}} <strong><font color="black">Estado</font></strong></div>
                                <div class="columnpst" style="background-color:#06AEF1; text-align: center;">{{Form::radio('filtro', '4', false, ['onclick'=>'mostrar(this)','value'=>'4'])}} <strong><font color="black">Cédula del solicitante</font></strong></div>
                            </div>
                        </div>
                </div>
            </div>
            <br><br>

            <div id="ocultolicencia" class="row" style="display:block">
            {{Form::open(['class'=>'form-horizontal', 'id'=>'consultarxlicencia', 'target'=>"_blank",'role'=>'form','method'=>'POST'])}}  <!-- 'route'=>['bono.consultaxcontratop'],-->
                <div  class="form-group">
                    <label class="col-sm-3 control-label">Número de licencia</label>
                    <div class="col-sm-7">
                        {{Form::text('numlicencia', null ,['class'=>'form-control', "required", "tabindex"=>"1",'id'=>'numlicencia'])}}
                    </div>
                    {{Form::hidden('filtro', '1',['id'=>'filtro'])}}
                </div>
                <p align="center"><button type="button" id="CrearB" class="btn btn-custom waves-effect waves-light" onclick="consultarlicencia()">Buscar</button></p>
                {{Form::close()}}
            </div>
            <div id="ocultofechas" class="row" style="display:none">
                {{Form::open(['class'=>'form-horizontal', 'id'=>'consultarxfechas', 'target'=>"_blank",'role'=>'form','method'=>'POST'])}}
                <div  class="form-group">
                    <label class="col-sm-3 control-label">Tipo de fecha de la licencia</label>
                    <div class="col-sm-7">
                        {{Form::select('tipo_fecha', ['fecha_radicacion' => 'Fecha de radicación', 'fecha_expedicion' => 'Fecha de Expedición', 'fecha_ejecutoria' => 'Fecha de Ejecutoría', 'fecha_vence' => 'Fecha de Vencimiento'], null,['class'=>'form-control', "required", "tabindex"=>"2",'id'=>'tipo_fecha'])}}
                    </div>
                    <label class="col-sm-3 control-label">Desde</label>
                    <div class="col-sm-7">
                        {{Form::date('fecha1', \Carbon\Carbon::now(),['class'=>'form-control', "required", "tabindex"=>"3",'id'=>'fecha1'])}}
                    </div>
                    <label class="col-sm-3 control-label">Hasta</label>
                    <div class="col-sm-7">
                        {{Form::date('fecha2', \Carbon\Carbon::now(),['class'=>'form-control', "required", "tabindex"=>"4",'id'=>'fecha2'])}}
                    </div>
                    {{Form::hidden('filtro2', '2',['id'=>'filtro2'])}}
                </div>
                <p align="center"><button type="button" id="CrearB" class="btn btn-custom waves-effect waves-light" onclick="consultarfechas()">Buscar</button></p>
                {{Form::close()}}
            </div>
            <div id="ocultoestado" class="row" style="display:none">
                {{Form::open(['class'=>'form-horizontal', 'id'=>'consultarxestado', 'target'=>"_blank",'role'=>'form','method'=>'POST'])}}
                <div  class="form-group">
                    <label class="col-sm-3 control-label">Estado de la licencia</label>
                    <div class="col-sm-7">
                        {{Form::select('estado', $estados,null,['class'=>'form-control', "required", "tabindex"=>"5",'id'=>'estado'])}}
                    </div>
                    {{Form::hidden('filtro3', '3',['id'=>'filtro3'])}}
                </div>
                <p align="center"><button type="button" id="CrearB" class="btn btn-custom waves-effect waves-light" onclick="consultarestado()">Buscar</button></p>
                {{Form::close()}}
            </div>
            <div id="ocultocedula" class="row" style="display:none">
                {{Form::open(['class'=>'form-horizontal', 'id'=>'consultarxcedula', 'target'=>"_blank",'role'=>'form','method'=>'POST'])}}
                <div  class="form-group">
                    <label class="col-sm-3 control-label">Número de cédula del solicitante de la licencia</label>
                    <div class="col-sm-7">
                        {{Form::text('cedula', null ,['class'=>'form-control', "required", "tabindex"=>"1",'id'=>'cedula'])}}
                    </div>
                    {{Form::hidden('filtro4', '4',['id'=>'filtro4'])}}
                </div>
                <p align="center"><button type="button" id="CrearB" class="btn btn-custom waves-effect waves-light" onclick="consultarcedula()">Buscar</button></p>
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
            $("#ocultolicencia").submit(function (e) {
                e.preventDefault();
                consultarlicencia();
            });
            $("#ocultofechas").submit(function (e) {
                e.preventDefault();
                consultarfechas();
            });
            $("#ocultoestado").submit(function (e) {
                e.preventDefault();
                consultarestado();
            });
            $("#ocultocedula").submit(function (e) {
                e.preventDefault();
                consultarcedula();
            });
        });
        function mostrar(elemento) {
            if(elemento.value=="1") {
                document.getElementById("ocultolicencia").style.display = "block";
                document.getElementById("ocultofechas").style.display = "none";
                document.getElementById("ocultoestado").style.display = "none";
                document.getElementById("ocultocedula").style.display = "none";

                document.getElementById("tablaoculta").style.display = "none";
            }
            else {
                if(elemento.value=="2") {
                    document.getElementById("ocultolicencia").style.display = "none";
                    document.getElementById("ocultofechas").style.display = "block";
                    document.getElementById("ocultoestado").style.display = "none";
                    document.getElementById("ocultocedula").style.display = "none";

                    document.getElementById("tablaoculta").style.display = "none";
                }
                else{
                    if(elemento.value=="3") {
                        document.getElementById("ocultolicencia").style.display = "none";
                        document.getElementById("ocultofechas").style.display = "none";
                        document.getElementById("ocultoestado").style.display = "block";
                        document.getElementById("ocultocedula").style.display = "none";

                        document.getElementById("tablaoculta").style.display = "none";
                    }
                    else{
                        document.getElementById("ocultolicencia").style.display = "none";
                        document.getElementById("ocultofechas").style.display = "none";
                        document.getElementById("ocultoestado").style.display = "none";
                        document.getElementById("ocultocedula").style.display = "block";

                        document.getElementById("tablaoculta").style.display = "none";
                    }
                }
            }
        }
        function consultarlicencia() {
            var numlicencia=$('#numlicencia').val();
            var filtro=$('#filtro').val();
            $('#tablaoculta').load('{{route('consultarxLicencia')}}',{numlicencia:numlicencia,_token: '{{csrf_token()}}',filtro:filtro});
            document.getElementById("tablaoculta").style.display = "block";
        }
        function consultarfechas() {
            var tipo_fecha=$('#tipo_fecha').val();
            var fecha1=$('#fecha1').val();
            var fecha2=$('#fecha2').val();
            var filtro=$('#filtro2').val();
            $('#tablaoculta').load('{{route('consultarxLicencia')}}',{_token: '{{csrf_token()}}',filtro:filtro,fecha1:fecha1,fecha2:fecha2,tipo_fecha:tipo_fecha});
            document.getElementById("tablaoculta").style.display = "block";
        }
        function consultarestado() {
            var estado=$('#estado').val();
            var filtro=$('#filtro3').val();
            $('#tablaoculta').load('{{route('consultarxLicencia')}}',{_token: '{{csrf_token()}}',filtro:filtro,estado:estado});
            document.getElementById("tablaoculta").style.display = "block";
        }
        function consultarcedula() {
            var cedula=$('#cedula').val();
            var filtro=$('#filtro4').val();
            $('#tablaoculta').load('{{route('consultarxLicencia')}}',{cedula:cedula,_token: '{{csrf_token()}}',filtro:filtro});
            document.getElementById("tablaoculta").style.display = "block";
        }
    </script>
@endsection