@extends('plantillas.general')
@section('contenido')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header" align="center"><h2>Lista de Usuarios</h2></div>
                    <h4><a href="{{route('crearUsuario')}}">Crear nuevo usuario</a> </h4><br>
                    <div class="table-responsive">
                        @if($usuarios)
                            <table class="table">
                                <thead>
                                <tr>
                                    <td>Nombre</td>
                                    <td>Email</td>
                                    <td>Tipo</td>
                                    <td>Notificar</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $usuario->tipo }}</td>
                                        <td>{{ $usuario->notificar }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
