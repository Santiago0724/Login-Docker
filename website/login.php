<?php

    require 'database.php';

    session_start();

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $mess = '';

        if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
            $_SESSION['user_id'] = $results['id'];
            header('Location: inicio.php');
            exit;
        }else{
            $mess = "Lo siento esas credenciales no coiciden";
        }
    }        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h1>Login</h1>

        <?php if(!empty($mess)) { ?>
        <p> <?= $mess ?> </p>
        <?php } ?>

        <form action="login.php" method="post">
            <input type="text" name="email" placeholder="Add your Email">
            <input type="password" name="password" placeholder="Add your password">
            <input type="submit" value="Send">
        </form>
        <p>or <a href="signup.php">Sign up</a></p>
    </div>
</body>
</html>
