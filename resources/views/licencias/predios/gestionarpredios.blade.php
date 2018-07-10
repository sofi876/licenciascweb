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
                     @if (session('error'))
                         <div class="alert alert-danger">
                             {{ session('error') }}
                         </div>
                     @endif
                     @if (session('success'))
                         <div class="alert alert-success">
                             {{ session('success') }}
                         </div>
                     @endif
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

        {{Form::open(['route'=>['funcionAdicionarPredio',$licencia->cod_licencia], 'class'=>'form-horizontal', 'id'=>'adicionarpredio'])}} <!-- -->
            <br>
            <h2>Adicionar Predio</h2>
            <div class="row">
                <!-- <div class="col-sm-12">
                     <h4 class="info-text"></h4>
                 </div>-->
                <div class="form-group">
                    <label class="col-sm-3 control-label">Dirección:</label>
                    <div class="col-sm-2">
                        <select class="form-control obtener" id="viaprincipal" tabindex="1" name="viaprincipal">
                            <option value="AP">AUTOPISTA</option>
                            <option value="AV">AVENIDA</option>
                            <option value="AC">AVENIDA CALLE</option>
                            <option value="AK">AVENIDA CARRERA</option>
                            <option value="CL" selected="selected">CALLE</option>
                            <option value="CRA">CARRERA</option>
                            <option value="CIRC">CIRCUNVALAR</option>
                            <option value="DG">DIAGONAL</option>
                            <option value="MANZ">MANZANA</option>
                            <option value="TV">TRANSVERSAL</option>
                            <option value="VIA">VIA</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <input type="text" id="numerovia" name="numerovia" tabindex="2" class="form-control obtener"
                               data-parsley-type="alphanum" maxlength="5" required>
                    </div>
                    <label class="col-sm-1 control-label">#</label>
                    <div class="col-sm-1">
                        <input type="text" id="numero1" name="numero1" tabindex="3" class="form-control obtener"
                               data-parsley-type="alphanum" maxlength="5" required>
                    </div>
                    <label class="col-sm-1 control-label">-</label>
                    <div class="col-sm-1">
                        <input type="text" id="numero2" name="numero2" tabindex="4" class="form-control obtener"
                               data-parsley-type="number"  maxlength="5" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Complemento:</label>
                    <div class="col-sm-7">
                        <input type="text" id="complemento" name="complemento" tabindex="5" class="form-control obtener"
                               data-parsley-pattern="^[a-zA-Z0-9]+(\s*[a-zA-Z0-9]*)*[a-zA-Z0-9]+$"  maxlength="60">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Barrio:</label>
                    <div class="col-sm-7">
                    {{Form::text('barrio', null,['class'=>'form-control', "required", "tabindex"=>"6",'id'=>'barrio'])}} <!-- "data-parsley-type"=>"number"] -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Estrato:</label>
                    <div class="col-sm-7">
                    {{Form::number('estrato', null ,['class'=>'form-control', "required", "tabindex"=>"7",'id'=>'estrato','min'=>'0','max'=>'6'])}} <!-- "data-parsley-type"=>"number"] -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Cédula Catastral:</label>
                    <div class="col-sm-7">
                    {{Form::text('cedula_catastral', null ,['class'=>'form-control', "tabindex"=>"8",'id'=>'cedula_catastral'])}} <!-- "data-parsley-type"=>"number"] -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Matricula Inmobiliaria:</label>
                    <div class="col-sm-7">
                    {{Form::text('matricula', null ,['class'=>'form-control', "required", "tabindex"=>"9",'id'=>'matricula'])}} <!-- "data-parsley-type"=>"number"] -->
                    </div>
                </div>
            </div>
            <p align="center"><button type="submit" id="adicionar" class="btn btn-custom waves-effect waves-light" >Guardar</button></p>

            {{Form::close()}}

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

        $(function () {
            $("#adicionarpredio").submit(function (e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    type: "POST",
                    context: document.body,
                    url: '{{route("funcionAdicionarPredio",['id'=>$licencia->cod_licencia])}}',
                    data: form.serialize(),
                    /*beforeSend: function () {
                        cargando();
                    },*/
                    success: function (result) {
                        //alert(result.mensaje);
                        if (result.estado) {
                            swal(
                                {
                                    title: 'Bien!!',
                                    text: result.mensaje,
                                    type: 'success',
                                    confirmButtonColor: '#4fa7f3'
                                }
                            ).then(function(){
                                location.reload();
                            });
                        } else {
                            swal(
                                'Error!!',
                                result.mensaje,
                                'error'
                            )
                        }
                    },
                    error: function (xhr, status) {
                    }
                    // código a ejecutar sin importar si la petición falló o no
                    /*complete: function (xhr, status) {
                        fincarga();
                    }*/
                });
            });
        });
        function eliminarpredio() {
            if(confirm('¿Esta seguro de eliminar este predio?'))
                return true;
            else
                return false;

        }

    </script>

@endsection