
{{-- Con extends se indica que es plantilla hija que hereda de una plantilla padre o maestra --}}
@extends('app')

{{-- Con section se define una sección o atributos que se pueden sobreescribir en la plantilla hija --}}
{{-- En este caso, se define el título de la página --}}
@section('title', 'Sistema - Categoría')

{{-- Podemos apilar estilos css que se pasaran del hijo a la padre --}}
@push('css')
    {{-- se presume que ya parte de la carpeta public/ el asset del href --}}
    <link rel="stylesheet" href="{{ asset('css/mantenimiento.css') }}">
@endpush

@section('contenido')
    <h2 class="texto-rojo">@lang('main.categories')</h2>
    <p>Este es el contenido de @lang('main.categories')</p>
@endsection

@push('scripts')
    <script src="{{ asset('js/mantenimiento.js') }}"></script>
@endpush