<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Notificación de Nueva Denuncia</title>
</head>
<body>
<p>Una nueva denuncia ha sido reportada en la fecha {{ $denuncia->fecha }}.</p>
<p>Estos son los datos de la denuncia:</p>
<ul>
    <li>Descripción de la denuncia: {{ $denuncia->des_denuncia }}</li>
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