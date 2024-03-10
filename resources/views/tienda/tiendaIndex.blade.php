<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de libros</title>
</head>
<body>
    <a href="{{ route('tienda.create') }}">Nuevo Libro</a>
    <h1>Lista de Libros</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Editorial</th>
                <th>Precio</th>
                <th>Codigo de libro</th>
                <th>Creado / Enviado</th>
                <th>Editar / Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tiendas as $tienda)
                <tr>
                    <td>{{ $tienda->titulo }}</td>
                    <td>{{ $tienda->autor }}</td>
                    <td>{{ $tienda->editorial }}</td>
                    <td>{{ $tienda->precio }}</td>
                    <td>{{ $tienda->libro_code }}</td>
                    <td>{{ $tienda->create_at }}</td>
                    <td>
                        <a href="{{ route ('tienda.show', $libro)}}" >Detalle</a>    
                        <a href="{{ route ('tienda.edit', $libro)}}" >Editar</a>
                        <form action="{{ route ('tienda.destroy', $libro)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>