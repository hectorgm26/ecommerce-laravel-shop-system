<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Sistema')</title> {{-- Si no envian nada las plantillas hijas, sera por defecto Sistema --}}

    {{-- Estilos heredados por todas las vistas --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    
    {{-- Seccion para incluir estilos específicos de cada vista --}}
    @stack('css')
</head>
<body>
    
    <header>
        <h1 class="texto-rojo">Bienvenido a mi sistema</h1>
    </header>

    {{-- Inckuidar el menu desde un archivo partial --}}
    @include('partials.menu')

    <main>
        @yield('contenido')
    </main>

    <footer>
        <p>2025 - Sistema</p>
    </footer>

    {{-- Incluir los scripts de JavaScript --}}
    @stack('scripts')

</body>
</html>