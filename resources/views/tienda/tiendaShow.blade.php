<x-mi-layout titulo="Agregar nuevo libro">
<body>
    <h1>Libros agregados {{ $tienda->id }}</h1>
    <ul>
        <li>Titulo: {{ $tienda->titulo }}</li>
        <li>Autor: {{ $tienda->autor }}</li>
        <li>Editorial: {{ $tienda->editorial }}</li>
        <li>Precio: {{ $tienda->precio }}</li>
    </ul>

    <h2>Archivos</h2>
    <ul>
        @foreach ($archivos as $archivo)
            <li>
                <a href="{{ route('tienda.download', $archivo) }}">
                    <img src="{{ Storage::url($archivo->ubicacion) }}" alt="{{ $archivo->nombre_original }}">
                </a>
            </li>
        @endforeach
    </ul>
</body>
</x-mi-layout>