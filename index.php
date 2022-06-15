<?php 
    session_start();
    require 'database.php';

    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT id, user, password FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null; 

        if (count($results) > 0) {
            $user = $results;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to pokedex</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
        <br> Welcome. <?= $user['user'] ?>
        <br> You are successfully logged in
        <a href="logout.php">Logout</a>
    <?php else: ?>
        
        <h1>Please, logIn or signUp</h1>
        <a href="login.php">Login</a> or
        <a href="signup.php">SignUp</a>
    <?php endif; ?>
</body>
</html> 