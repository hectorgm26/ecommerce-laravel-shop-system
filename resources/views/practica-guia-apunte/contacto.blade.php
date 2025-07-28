
{{-- Con extends se indica que es plantilla hija que hereda de una plantilla padre o maestra --}}
@extends('app')

{{-- Con section se define una sección o atributos que se pueden sobreescribir en la plantilla hija --}}
{{-- En este caso, se define el título de la página --}}
@section('title', 'Sistema - Contacto')

@section('contenido')
    <h2 class="texto-rojo">Contacto</h2>
    <p>Este es el contenido de contacto</p>
@endsection
