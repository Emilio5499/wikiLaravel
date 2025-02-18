<!DOCTYPE html>
<html>
<head>
    <title>Evento!!</title>
</head>
<body>
    <h1>El evento empieza pronto</h1>
    <p><strong>Evento:</strong> {{ $evento['titulo'] }}</p>
    <p><strong>Fecha:</strong> {{ $evento['fecha'] }}</p>
    <p><strong>Descripción:</strong> {{ $evento['descripcion'] }}</p>
    <p><a href="{{ $evento['link'] }}">Leer mas</a></p>
</body>
</html>
