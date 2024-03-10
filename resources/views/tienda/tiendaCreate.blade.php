<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar libro</title>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</head>
<body>
    <form action="/tienda" method="POST">
        @csrf
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" value="{{ old('titulo')}}"><br>
        <label for="autor">Autor</label>
        <input type="text" name="autor" value="{{ old('autor')}}"><br>
        <label for="editorial">Editorial</label>
        <input type="text" name="editorial" value="{{ old('editorial')}}"><br>
        <label for="precio">Precio</label>
        <input type="text" name="precio" value="{{ old('precio')}}"><br>
        
        <input type="submit" value="Enviar">
    </form>
</body>
</html>