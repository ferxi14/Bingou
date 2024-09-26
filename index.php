<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bingo</title>
</head>

<body>
    <?php
    $cartones = array(array(), array(), array(), array());
    $players = array(
        ['yayo1'] => $cartones,
        ['yayo2'] => $cartones,
        ['yayo3'] => $cartones,
        ['yayo4'] => $cartones
    );
    var_dump($players);

    ?>
</body>

</html>