<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bingou</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        include "Librari.php";
            // AJUSTES DEL JUEGO [JUGADORES, CARTONES, TAMAÑO_CARTONES, BOLAS]
            $ajustes = [4, 3, 15, 60];
            comprobarAjustes($ajustes);

            // EJECUCIÓN DEL JUEGO
            $players = array();
            crearJugadores($players, $ajustes);

            imprimirCartones($players);

            $bolas = array();
            crearBolas($bolas, $ajustes);

            iniciarJuego($players, $bolas, $ajustes);
        ?>
    </body>
</html>