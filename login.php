<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        header('location: /pokedex-php');
    }

    require 'database.php';

    if(!empty($_POST['user']) && !empty($_POST['password'])) {
        $records = $conn->prepare('SELECT id, user, password FROM users WHERE user=:user');
        $records->bindParam(':user', $_POST['user']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $message = '';

        if (count($results) > 0 && password_verify($_POST['password'], $results['password'])){
            $_SESSION['user_id'] = $results['id'];
            header('Location: /pokedex-php/pokeapi.php');
        }else{
            $message = 'Sorry, those credentials do not match';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php require 'partials/header.php' ?>  
    
    <h1>LogIn</h1>
    <span>or <a href="signup.php">SignUp</a></span>

    <?php if (!empty($message)) : ?>
        <p><?= $message ?></p>
    <?php endif;?>

    <form method="post" action="login.php">
        <input type="text" name="user" placeholder="Enter your user">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="submit" value="send">
    </form>
</body>
</html>