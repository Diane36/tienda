<x-mi-layout titulo="Listado de libros">
    <a class="btn btn-primary" href="{{ route('tienda.create') }}">Nuevo Libro</a>
    <table border="1">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Editorial</th>
                <th>Precio</th>
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
                    <td>{{ $tienda->create_at }}</td>
                    <td>
                        <a href="{{ route ('tienda.show', $tienda)}}" >Detalle</a>    
                        <a href="{{ route ('tienda.edit', $tienda)}}" >Editar</a>
                        <form action="{{ route ('tienda.destroy', $tienda)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-mi-layout>