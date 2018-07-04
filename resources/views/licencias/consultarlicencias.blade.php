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
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header" align="center"><h2>Consultar Licencias</h2></div>
                    <p><b>Nota:</b> Utilice las celdas inferiores de cada columna para filtrar los resultados.</p>
                    <!--<h4><a href="{ {route('crearUsuario')}}">Crear nuevo usuario</a> </h4><br> -->
                    <div class="table-responsive m-b-12">

                        <table id="datatable" name="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Ver / Editar</th>
                                <th>Número</th>
                                <th>Radicación</th>
                                <th>Expedición</th>
                                <th>Ejecutoría</th>
                                <th>Vencimiento</th>
                                <th>Estado</th>
                                <th>Antecedentes</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>Número</th>
                                <th>Radicación</th>
                                <th>Expedición</th>
                                <th>Ejecutoría</th>
                                <th>Vencimiento</th>
                                <th>Estado</th>
                                <th>Antecedentes</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
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
        $(function (){
            table = $("#datatable").DataTable({
                procesing: true,
                serverSide: true,
                "language": {
                    "url": "{!!route('datatable_es')!!}"
                },
                ajax: {
                    url: "{!!route('gridConsultarLicencias')!!}",
                    "type":"get"
                },
                columns: [
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    {data: 'num_licencia', name: 'num_licencia'},
                    {data: 'fecha_radicacion', name: 'fecha_radicacion'},
                    {data: 'fecha_expedicion', name: 'fecha_expedicion'},
                    {data: 'fecha_ejecutoria', name: 'fecha_ejecutoria'},
                    {data: 'fecha_vence', name: 'fecha_vence'},
                    {data: 'estado', name: 'estado'},
                    {data: 'antecedentes', name: 'antecedentes'}
                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        if(column.footer().innerHTML != ""){
                            var input = document.createElement("input");
                            $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                        }
                    });
                },
            });
        });
        $.fn.dataTable.ext.errMode = 'throw';
    </script>

@endsection