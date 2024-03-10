<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion de los libros agregados</title>
</head>
<body>
    <h1>Libros ID {{ $tienda->id }}</h1>
    <ul>
        <li>Titulo: {{ $tienda->titulo }}</li>
        <li>Autor: {{ $tienda->autor }}</li>
        <li>Editorial: {{ $tienda->editorial }}</li>
        <li>Precio: {{ $tienda->precio }}</li>
    </ul>
</body>
</html>