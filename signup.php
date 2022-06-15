<?php 
    require 'database.php';

    $message = '';

    if (!empty($_POST['user']) && !empty($_POST['password'])) {
        $sql = "INSERT INTO users (user, password) VALUES (:user, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user',$_POST['user']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password',$password);

        if ($stmt->execute()) {
            $message = 'Successfuly created new user';
        } else{
            $message = 'Sorry there must have been an issue creating your account';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php require 'partials/header.php' ?>
    
    <?php if(!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>
    
    <h1>SignUp</h1>
    <span>or <a href="login.php">LogIn</a></span>
    <form method="post" action="signup.php">
        <input type="text" name="user" placeholder="Enter your user">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="password" name="confirm_password" placeholder="Confirm your password">
        <input type="submit" value="send">
    </form>
</body>
</html>