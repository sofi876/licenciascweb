<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Notificación de Nueva Licencia de Construcción</title>
</head>
<body>
<p>Una nueva licencia ha sido registrada en el sistema web.</p>
<p>Estos son los datos de la Licencia:</p>
<ul>
    <li>Número de licencia: {{ $licencia->num_licencia }}</li>
    <li>Fecha de radicación: {{ $licencia->fecha_radicacion }}</li>
    <li>Fecha de expedición: {{ $licencia->fecha_expedicion }}</li>
    <li>Fecha de ejecutoría: {{ $licencia->fecha_ejecutoria }}</li>
    <li>Fecha de vencimiento: {{ $licencia->fecha_vence }}</li>
</ul>
<br><p>Para ver más información ingrese al aplicativo de Licencias.</p>
<!--<p>Y esta es la posición reportada:</p>
<ul>
    <li>Latitud: { { $distressCall->lat }}</li>
    <li>Longitud: { { $distressCall->lng }}</li>
    <li>
        <a href="https://www.google.com/maps/dir/{ { $distressCall->lat }},{ { $distressCall->lng }}">
            Ver en Google Maps
        </a>
    </li>
</ul> -->
</body>
</html>