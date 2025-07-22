<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Foreach</title>
</head>
<body>

    @foreach ( $lista as $fruta )
        <p>{{ $fruta }}</p>
    @endforeach
    
    {{-- Directiva php para ingresar codigo php en la vista --}}
    @php
        function sumar($num1, $num2) {
            return $num1 + $num2;
        }
    @endphp

    <p>Resultado: {{ sumar(2, 18) }}</p>
    
</body>
</html>