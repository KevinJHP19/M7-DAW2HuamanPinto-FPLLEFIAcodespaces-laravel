<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->

    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <h1>Añadir pokemons a la api</h1>

    <form action="https://potential-palm-tree-v6q6qj65q6r5cw467-8000.app.github.dev/api/tarjets" method="POST">

        <div>
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div>
            <label for="image">Imagen</label>
            <input type="text" name="image" id="image" required>
        </div>





        <button type="submit">Añadir Pokemon</button>

    </form>

    <h1>Editar pokemon</h1>
    <div>
        <label for="id">ID</label>
        <input type="number" name="id" id="id" required>
    </div>
    <div>
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" >
    </div>
    <div>
        <label for="image">Imagen</label>
        <input type="text" name="image" id="image" >
    </div>

    </body>
</html>
