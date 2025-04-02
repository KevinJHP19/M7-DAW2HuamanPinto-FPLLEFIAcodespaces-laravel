<?php
// resources/views/peliculas.blade.php
// Este archivo es una vista de Blade en Laravel que muestra una tabla de películas
// con sus respectivos detalles. Se utiliza Bootstrap para el estilo de la tabla.


$peliculas = [
    (object)[
        'id' => 1,
        'titulo' => 'Inception',
        'duracion' => '148 min',
        'clasificacion' => 'PG-13',
        'fecha_estreno' => '2010-07-16'
    ],
    (object)[
        'id' => 2,
        'titulo' => 'The Matrix',
        'duracion' => '136 min',
        'clasificacion' => 'R',
        'fecha_estreno' => '1999-03-31'
        
    ],
    // Agrega más películas según sea necesario
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Peliculas</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Duracion</th>
                    <th>Clasificacion</th>
                    <th>Fecha de Estreno</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peliculas as $pelicula)
                    <tr>
                        <td>{{ $pelicula->id }}</td>
                        <td>{{ $pelicula->titulo }}</td>
                        <td>{{ $pelicula->duracion }}</td>
                        <td>{{ $pelicula->clasificacion }}</td>
                        <td>{{ $pelicula->fecha_estreno }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>







</body>
</html>
