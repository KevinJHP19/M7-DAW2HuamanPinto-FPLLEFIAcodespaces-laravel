<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Suma de dos numeros</h1>
        <form action="/suma" method="POST">
            @csrf
            <input type="number" name="num1" placeholder="Número 1">
            <input type="number" name="num2" placeholder="Número 2">
            <button type="submit">Sumar</button>
        </form>


        @if(isset($resultado))
            <h1>Resultado de la suma: {{ $resultado }}</h1>
        @endif

    </div>

</body>
</html>
