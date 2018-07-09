@extends('plantillas.sinmenu')
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
        <br>
        <div class="card-box widget-inline">
        <div class="row">

        <div class="row justify-content-center">
            <div class="col-md-12">
                 <div class="card" >
                    <div class="card-header" align="center"><h2>Predios Asociados</h2></div>
                    <input type="button" class="btn btn-success" value="Actualizar" onClick="location.reload();" />
                    <p><b>Nota:</b> Utilice las celdas inferiores de cada columna para filtrar los resultados.</p>
                    <!--<h4><a href="{ {route('crearUsuario')}}">Crear nuevo usuario</a> </h4><br> -->
                    <div class="table-responsive m-b-12">

                        <table id="datatable" name="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Dirección</th>
                                <th>Barrio</th>
                                <th>Estrato</th>
                                <th>Matrícula Inmobiliaria</th>
                                <th>Cédula Catastral</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Dirección</th>
                                <th>Barrio</th>
                                <th>Estrato</th>
                                <th>Matrícula Inmobiliaria</th>
                                <th>Cédula Catastral</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>

                </div>
                </div>
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
                    url: "{!!route('gridConsultarPredios')!!}",
                    "type": "POST",
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    'data': function (d) {
                        d.codlicencia = "{{$licencia->cod_licencia}}";
                    }
                },
                columns: [
                    {data: 'direccion', name: 'direccion'},
                    {data: 'barrio', name: 'barrio'},
                    {data: 'estrato', name: 'estrato'},
                    {data: 'matricula', name: 'matricula'},
                    {data: 'cedula_catastral', name: 'cedula_catastral'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
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