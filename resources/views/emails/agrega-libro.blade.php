<x-mail::message>
    <x-slot name="subject">
        Nuevo libro agregado
    </x-slot>

    <h1>Nuevo libro agregado</h1>
    <x-mail::panel>
    @if($tienda)
        Se ha agregado un nuevo libro a la tienda:
        
        Título: {{ $tienda->titulo }}
        Autor: {{ $tienda->autor }}
        Editorial: {{ $tienda->editorial }}
        Precio: {{ $tienda->precio }}
    @else
        No se ha encontrado información del libro.
    @endif
    
    Gracias,
    Equipo de la Tienda
    </x-mail::panel>
</x-mail::message>

