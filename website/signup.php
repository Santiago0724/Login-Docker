<?php 
    require 'database.php';

    $mess = '';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);
    
        if($stmt->execute()){
            $mess = "Ha sido creado el usuario";
        }else{
            $mess = "ha ocurrido un error creando su contraseña " . $stmt->errorInfo()[2];;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php 
        if(!empty($mess));   
    ?>
    <p> <?= $mess ?> </p>

    <div class="container">
        <h1>Sign up</h1>
        <span>or <a href="login.php">Login</a></span>
        <form action="signup.php" method="post">
            <input type="text" name="email" placeholder="Add your Email">
            <input type="password" name="password" placeholder="Add your password">
            <input type="password" name="password-confirm" placeholder="Confirm your password"> 
            <input type="submit" value="Send">
        </form>
    </div>

</body>
</html>