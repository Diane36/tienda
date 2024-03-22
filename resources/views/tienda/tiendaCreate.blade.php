<x-mi-layout titulo="Agregar nuevo libro">

<body>
    @include('layouts.formError')
    <form action="{{ route('tienda.store') }}" method="POST">
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
</x-mi-layout>