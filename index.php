<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bingo</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    ini_set('max_execution_time', 1); 

    $players = array(
        "yayo1" => array(),
        "yayo2" => array(),
        "yayo3" => array(),
        "yayo4" => array()
    );

    // RELLENA LOS CARTONES A TODOS LOS JUGADORES
    foreach($players as $p => $i){
        rellenarCarton($players[$p]);
    } 

    // INSERTA 3 ARRAYS LLENOS DE NUMEROS EN UN ARRAY QUE SE LE PASA POR PARAMETRO
    function rellenarCarton(&$play){
        for($i = 0; $i<3; $i++){
            $carton = array();
            insertNum($carton);
            array_push($play,$carton);
        }
    };

    // MODIFICA UN ARRAY VACIO DANDOLE 15 NUMEROS ALEATORIOS DEL 1 AL 60 QUE NO SE REPITEN
    function insertNum(&$arr){
        $numExist = false;
        $num = 0;
        while(count($arr) < 15){
            $num = rand(1,60);
            $numExist = false;
            foreach($arr as $i){
                if($num == $i){
                    $numExist = true;
                }
            }
            if(!$numExist){
                array_push($arr,$num);

            }
        }
    }
    imprimirCartones($players);
    $bolas = array();
    $hayGanador = false;
    $ganador = "";
    do {
        $hayGanador = sacarBola($players, $bolas, $ganador);
    } while(!$hayGanador);
    echo "<h1>Ganador: ". $ganador . "</h1>";
    imprimirCartones($players);
    /**************************************************/
    function sacarBola(&$players, &$bolas, &$ganador) {
        $num = 0;

        do {
            $num = rand(1, 60);
        } while(in_array($num, $bolas) && count($bolas) < 60);

        echo "<img src='images/". $num . ".PNG' height='70'>";

        count($bolas)<60 ? array_push($bolas, $num) : "";
        comprobarBolaCartones($players, $num);
        $hayGanador = comprobarGanador($players, $ganador);

        return $hayGanador;
    }
    /**************************************************/
    function imprimirCartones($players)
    {
        echo "<div class='container'>";
        foreach ($players as $player => $cartones) {
            echo "<div class='jugador'><h3>" . $player . " </h3>";
            foreach ($cartones as $num => $carton) {
                $num++;
                echo "<table border='1'><caption> Carton " . $num . "</caption><tr>";
                for ($i = 0; $i < 15; $i++) {
                    if ($i % 5 == 0 && $i != 0) {
                        echo "</tr> <tr> <td>" . $carton[$i] . "</td>";
                    } else {
                        echo "<td>" . $carton[$i] . "</td>";
                    }
                }
				
                echo "</tr> </table>";
            }
            echo "</div>";
        }
        echo "</div>";
    }
    /**************************************************/

    // COMPRUEBA SI LA BOLA SALIDA SE ENCUENTRA EN ALGÚN CARTÓN
    function comprobarBolaCartones(&$players, $bola) {
        foreach ($players as $player => &$cartones)
            foreach ($cartones as &$carton)
                    for ($i = 0; $i < count($carton); $i++)
                        if ($carton[$i] == $bola)
                            $carton[$i] = "X";
    }

    /**************************************************/

    // COMPRUEBA SI ALGÚN JUGADOR HA GANADO
    function comprobarGanador($players, &$ganador) {
        $hayGanador = false;
        foreach ($players as $player => &$cartones)
            foreach ($cartones as &$carton) {
                $contadorBolasCoincididas = 0;
                for ($i = 0; $i < count($carton); $i++)
                    if ($carton[$i] == "X")
                        $contadorBolasCoincididas++;
                if ($contadorBolasCoincididas == count($carton)) {
                    $ganador .= $player . " ";
                    $hayGanador = true;
                }
            }
        return $hayGanador;
    }
    ?>
</body>

</html>