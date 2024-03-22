<x-mi-layout titulo="Agregar nuevo libro">
<body>
    <h1>Libros agregados {{ $tienda->id }}</h1>
    <ul>
        <li>Titulo: {{ $tienda->titulo }}</li>
        <li>Autor: {{ $tienda->autor }}</li>
        <li>Editorial: {{ $tienda->editorial }}</li>
        <li>Precio: {{ $tienda->precio }}</li>
    </ul>
</body>
</x-mi-layout>