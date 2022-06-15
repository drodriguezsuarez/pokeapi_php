<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokeDex</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php 
    $pokemon = 'charizard';

    $api = curl_init("https://pokeapi.co/api/v2/pokemon/$pokemon");
    curl_setopt($api, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($api);
    curl_close($api);

    $json = json_decode($response);

    echo '<h3>Habilidades</h3>';
    foreach($json->abilities as $k => $v) {
        echo $v->ability->name.'<br>';
    }
    echo '<h3>Tipo</h3>';
    echo $json->types[0]->type->name;

    echo '<h3>Sprite</h3>';
    echo '<img src="'.$json->sprites->back_default.'"width="200">';
    echo '<img src="'.$json->sprites->front_default.'"width="200">';
    ?>
</body>
</html>