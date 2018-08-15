<div class="row">
    <div class="col-sm-12">
        <h5>Exportar</h5>
        <div class="card-box widget-inline">
            <div class="row">
                <div class="widget-inline-box text-right">
                    <strong>Exportar: </strong>
                    <div class="btn-group">
                        <a href="{{route('excelDenuncias',['fecha1'=>$fecha1, 'fecha2'=>$fecha2])}}"
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
        <p><b>Nota:</b> Utilice la celda inferior de la columna para filtrar los resultados.</p>
    </div>
</div>
<div class="table-responsive m-b-12">

    <table id="datatable" name="datatable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Ver</th>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Es nueva</th>
            <th>Observación</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th></th>
            <th>Fecha</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
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
                url: "{!!route('gridConsultarDenunciasFiltro')!!}",
                "type": "POST",
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                'data': function (d) {
                    d.fecha1 = "{{$fecha1}}";
                    d.fecha2 = "{{$fecha2}}";
                }
            },
            columns: [
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'fecha', name: 'fecha'},
                {data: 'des_denuncia', name: 'des_denuncia'},
                {data: 'estado_name', name: 'estado_name'},
                {
                    data: 'nueva',
                    name: 'nueva',
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
                    searchable: false
                },
                {data: 'observacion', name: 'observacion'}
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
