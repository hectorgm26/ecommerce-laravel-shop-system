<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>While</title>
</head>
<body>
    
    <p>
        {{ $numero }}
    </p>

    @while ($numero > 0)
        <p>{{ $numero = $numero - 1 }}</p>
    @endwhile
</body>
</html>