<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estructuras de control</title>
</head>
<body>
    <h1>Su nota es: {{ $nota }}</h1>

    <p>
        Situacion:
        @if($nota >= 10.5)
            <strong>Aprobado</strong>
        @else
            <strong>Reprobado</strong>
        @endif
    </p>

    <p>
        Categoria:
        @if($nota >= 0 && $nota <= 6)
            <strong>Pesimo</strong>
        @elseif ($nota > 6 && $nota < 8)
            <strong>Regular</strong>
        @elseif ($nota >= 8 && $nota < 10)
            <strong>Bueno</strong>
        @elseif ($nota >= 10 && $nota < 12)
            <strong>Notable</strong>
        @elseif ($nota >= 12 && $nota < 14)
            <strong>Excelente</strong>
        @elseif ($nota >= 14 && $nota <= 20)
            <strong>Increible</strong>
        @else
            <strong>Invalida</strong>
        @endif
    </p>
</body>
</html>