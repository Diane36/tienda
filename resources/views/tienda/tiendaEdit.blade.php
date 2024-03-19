<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar libro</title>
</head>
<body>
    @include('layouts.formError')
    <form action="{{ route('tienda.update', $tienda) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" value="{{ old('titulo') ?? $tienda->titulo}}"><br>
        <label for="autor">Autor</label>
        <input type="text" name="autor" value="{{ old('autor') ?? $tienda->autor}}"><br>
        <label for="editorial">Editorial</label>
        <input type="text" name="editorial" value="{{ old('editorial') ?? $tienda->editorial}}"><br>
        <label for="precio">Precio</label>
        <input type="text" name="precio" value="{{ old('precio') ?? $tienda->precio}}"><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>