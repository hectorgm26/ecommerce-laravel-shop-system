<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Switch</title>
</head>
<body>
    
    <p>
        @switch($numero)
            @case(1)
                Lunes
                @break
            @case(2)
                Martes
                @break
            @case(3)
                Miércoles
                @break
            @case(4)
                Jueves
                @break
            @case(5)
                Viernes
                @break
            @case(6)
                Sábado
                @break
            @case(7)
                Domingo
                @break
            @default
                No es un día de la semana válido
        @endswitch
    </p>
    
</body>
</html>