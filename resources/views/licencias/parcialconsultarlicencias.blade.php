<!--  <input type="button" class="btn btn-success" value="Actualizar" onClick="location.reload();" />-->
<div class="row">
    <div class="col-sm-12">
        <h5>Exportar</h5>
        <div class="card-box widget-inline">
            <div class="row">
                <div class="widget-inline-box text-right">
                    <strong>Exportar: </strong>
                    <div class="btn-group">
                         <a href="{{route('excelLicencias',['lista_licencias'=>$lista_licencias])}}"
                           class="btn btn-sm btn-custom" data-toggle="tooltip" title="EXCEL">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">

                        <div class="col-sm-12">
                    <p><b>Nota:</b> Utilice las celdas inferiores de cada columna para filtrar los resultados.</p>
                        </div>
                    </div>
                    <!--<h4><a href="{ {route('crearUsuario')}}">Crear nuevo usuario</a> </h4><br> -->
                    <div class="table-responsive m-b-12">

                        <table id="datatable" name="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Ver</th>
                                <th>Número de Licencia</th>
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
                                <th>Número de Licencia</th>
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



    <script>
        $(function (){

            table = $("#datatable").DataTable({
                procesing: true,
                serverSide: true,
                "language": {
                    "url": "{!!route('datatable_es')!!}"
                },
                ajax: {
                    url: "{!!route('gridConsultarLicenciasFiltro')!!}",
                    "type": "POST",
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    'data': function (d) {
                        d.filtro = "{{$filtro}}";
                        d.numlicencia = "{{$numlicencia}}";
                        d.tipo_fecha = "{{$tipo_fecha}}";
                        d.fecha1 = "{{$fecha1}}";
                        d.fecha2 = "{{$fecha2}}";
                        d.estado = "{{$estado}}";
                        d.cedula = "{{$cedula}}";
                    }
                //"data": {filtro: "1" ,_token: '{ {csrf_token()}}', numlicencia: "6666"}
                    //data: {'filtro': filtro},
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
