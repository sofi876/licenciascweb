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
                    <div class="card-header" align="center"><h2>Lista de Usuarios</h2></div>
                    <!--<h4><a href="{ {route('crearUsuario')}}">Crear nuevo usuario</a> </h4><br> -->
                    <div class="table-responsive m-b-12">

                        <table id="datatable" name="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td>Id</td>
                                    <td>Nombre</td>
                                    <td>Email</td>
                                    <td>Tipo</td>
                                    <td>Notificar</td>
                                    <td>Editar</td>
                                </tr>
                                </thead>
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
                    url: "{!!route('gridConsultarUsuarios')!!}",
                    "type":"get"
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {
                        data: 'tipo',
                        name: 'tipo',
                        render: function (data) {
                            if (data == '1') {
                                return 'Administrador';
                            }
                            else if (data == '2') {
                                return 'Funcionario';
                            } else {
                                return 'Error'
                            }
                        },
                        searchable: true
                    },
                    {
                        data: 'notificar',
                        name: 'notificar',
                        render: function (data) {
                            if (data == '0') {
                                return 'No';
                            }
                            else if (data == '1') {
                                return 'Si';
                            } else {
                                return 'Error'
                            }
                        },
                        searchable: true
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
            });
        });
    </script>

    <!--
    <script>
        var table;
        $(function () {
            table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                "language": {
                    "url": "{ !!route('datatable_es')!!}"
                },
                ajax: {
                    url: "{ !!route('gridconsultatarjetabono')!!}",
                    "type": "get"
                },
                columns: [
                    {data: 'numero_tarjeta', name: 'numero_tarjeta'},
                    {
                        data: 'monto_inicial',
                        name: 'monto_inicial',
                        render: function (data) {
                            return '$ '+enmascarar(data);
                        }
                    },
                    {
                        data: 'estado',
                        name: 'estado',
                        render: function (data) {
                            if (data == 'A') {
                                return 'Activo';
                            }
                            else if (data == 'I') {
                                return 'Inactivo';
                            } else {
                                return 'Pendiente'
                            }
                        },
                        searchable: false
                    },
                    {data: 'vencimiento', name: 'vencimiento'},
                    {data: 'numcontrato', name: 'numcontrato'},
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

    </script> -->
@endsection