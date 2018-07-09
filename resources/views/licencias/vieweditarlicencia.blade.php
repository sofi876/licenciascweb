@extends('plantillas.sinmenu')

@section('styles')
    {{Html::Style('css/style.css')}}
@endsection

@section('contenido')
   <!-- <h4><a href="{ {route('consultarLicencias')}}">Volver a consultar licencias</a> </h4> -->
   <br>
    <div class="embed-container">
        <iframe width="560" height="315" src="{{route('frameeditarlicencia', ['id' => $licencia->cod_licencia])}}" frameborder="0" allowfullscreen></iframe>
    </div>

@endsection

@section('scripts')

@endsection