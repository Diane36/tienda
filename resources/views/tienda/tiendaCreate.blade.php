<x-mi-layout titulo="Agregar nuevo libro">

<body>
    @include('layouts.formError')
    <form action="{{ route('tienda.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" value="{{ old('titulo')}}"><br>
        @error('titulo')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="autor">Autor</label>
        <input type="text" name="autor" value="{{ old('autor')}}"><br>
        @error('autor')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="editorial">Editorial</label>
        <input type="text" name="editorial" value="{{ old('editorial')}}"><br>
        @error('editorial')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="precio">Precio</label>
        <input type="text" name="precio" value="{{ old('precio')}}"><br>
        @error('precio')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <br>
        <hr>
        <input type="file" name="archivo">
        <br> <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</x-mi-layout>