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

            /* ******************************** */
            /*            FUNCIONES             */
            /* ******************************** */

            // COMPROBAR AJUSTES
            function comprobarAjustes($ajustes){
                for ($i = 0; $i < count($ajustes); $i++)
                    if ($ajustes[$i] < 1) {
                        echo "<h2>Todos los ajustes deben tener un valor mínimo de 1</h2>";
                        exit;
                    }

                if ($ajustes[2] > $ajustes[3]) {
                    echo "<h2>El número de cartones no puede ser mayor que el número de bolas.</h2>";
                    exit;
                }
            }

            /* ******************************** */

            // CREAR JUGADORES Y SUS CARTONES
            function crearJugadores(&$players, $ajustes) {
                for ($i = 1; $i <= $ajustes[0]; $i++)
                    $players["yayo" . $i ] = array();
                
                foreach($players as $player => $player)
                    crearCartones($players[$player], $ajustes);
            }
        
            // CREAR LOS CARTONES DE UN JUGADOR
            function crearCartones(&$player, $ajustes){
                for($i = 0; $i < $ajustes[1]; $i++){
                    $carton = array();
                    rellenarCarton($carton, $ajustes);
                    array_push($player,$carton);
                }
            };
        
            // DAR VALORES A UN CARTÓN
            function rellenarCarton(&$carton, $ajustes){
                while(count($carton) < $ajustes[2]){
                    $num = rand(1, $ajustes[3]);
                    if(!in_array($num, $carton)){
                        array_push($carton,$num);
                    }
                }
                // Añadir contador de bolas acertadas al final del cartón
                array_push($carton, 0);
            }

            /* ******************************** */

            // IMPRIMIR TODOS LOS CARTONES DE CADA JUGADOR
            function imprimirCartones($players) {
                echo "<div class='container'>";
                foreach ($players as $player => $cartones) {
                    echo "<div class='jugador'><h3>" . $player . " </h3>";
                    foreach ($cartones as $num => $carton) {
                        $num++;
                        echo "<table border='1'><caption> Carton " . $num . "</caption><tr>";
                        for ($i = 0; $i < count($carton)-1; $i++) {
                            if ($i % 5 == 0 && $i != 0)
                                echo "</tr> <tr> <td>" . $carton[$i] . "</td>";
                            else
                                echo "<td>" . $carton[$i] . "</td>";
                        }
                        echo "</tr> </table>";
                    }
                    echo "</div>";
                }
                echo "</div>";
            }

            /* ******************************** */
            
            // CREAR BOLAS
            function crearBolas(&$bolas, $ajustes) {
                for ($i = 1; $i <= $ajustes[3]; $i++)
                    array_push($bolas, $i);
                shuffle($bolas);
            }

            /* ******************************** */

            // INICIAR JUEGO
            function iniciarJuego(&$players, &$bolas, $ajustes) {
                $ganador = "";
            
                echo "<h3>Bolas sacadas</h3>";
                do {
                    $hayGanador = sacarBola($players, $bolas, $ganador, $ajustes);
                } while(!$hayGanador);
                echo "<h1>Ganador(es): ". $ganador . "</h1>";
            }
        
            // SACAR UNA BOLA Y COMPROBAR SI HAY GANADOR
            function sacarBola(&$players, &$bolas, &$ganador, $ajustes) {
                $num = array_shift($bolas);
                echo "<img src='images/". $num . ".PNG' height='70'>";
            
                comprobarBolaCartones($players, $num);
                $hayGanador = comprobarGanador($players, $ganador);
            
                return $hayGanador;
            }
        
            // COMPROBAR SI LA BOLA QUE HA SALIDO SE ENCUENTRA EN ALGÚN CARTÓN
            function comprobarBolaCartones(&$players, $bola) {
                foreach ($players as $player => &$cartones)
                    foreach ($cartones as &$carton)
                        if (in_array($bola, $carton))
                            $carton[count($carton) - 1]++;
            }
        
            // COMPROBAR SI ALGÚN JUGADOR HA GANADO
            function comprobarGanador($players, &$ganador) {
                $hayGanador = false;
                foreach ($players as $player => &$cartones)
                    foreach ($cartones as &$carton)
                        if ($carton[count($carton) - 1] == count($carton) - 1) {
                            $ganador .= $player . " ";
                            $hayGanador = true;
                        }
                return $hayGanador;
            }
        ?>
    </body>
</html>