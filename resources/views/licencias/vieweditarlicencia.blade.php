@extends('plantillas.general')

@section('styles')
    {{Html::Style('css/style.css')}}
@endsection

@section('contenido')
    <div class="embed-container">
        <iframe width="560" height="315" src="{{route('frameeditarlicencia', ['id' => $licencia->cod_licencia])}}" frameborder="0" allowfullscreen></iframe>
    </div>

@endsection

@section('scripts')

@endsection