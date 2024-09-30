<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bingo</title>
</head>

<body>
    <?php
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
        // var_dump($play);
        }
    };
    // var_dump($players);
    // $arrea = array();
    // insertNum($arrea);
    // var_dump($arrea);

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
    array_push($bolas, sacarBola($bolas));
    /**************************************************/
    function sacarBola($bolas) {
        $num = 0;

        do {
            $seguir = true;
            $num = rand(1, 60);

            foreach ($bolas as $bola) {
                if ($bola == $num) {
                    $seguir = false;
                }
            }
        } while(!$seguir);

        return $num;        
    }
    /**************************************************/
    function imprimirCartones($players)
    {
        foreach ($players as $player => $cartones) {
            echo "<h3>" . $player . " </h3>";
            foreach ($cartones as $num => $carton) {
                $num++;
                echo "<table><caption> Carton " . $num . "</caption><tr>";
                for ($i = 0; $i < 15; $i++) {
                    if ($i % 5 == 0 && $i != 0) {
                        echo "</tr> <tr> <td>" . $carton[$i] . "</td>";
                    } else {
                        echo "<td>" . $carton[$i] . "</td>";
                    }
                }
				
                echo "</tr> </table>";
            }
        }
    }
    /**************************************************/

    ?>
</body>

</html>