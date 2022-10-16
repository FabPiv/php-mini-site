<?php
session_start();

if(empty($_POST['pseudo']) && empty($_POST['email']) && empty($_POST['password'])) {
    require('PDO.php');

    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

//adresse email valide

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location : reg.php?error=1&message=Votre email est invalide.');
        exit();
    }
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
<div class="login-form">
    <?php
    if(!isset($_GET['error'])){
        if(isset($_GET['message'])){
            echo '<div>'.htmlspecialchars($_GET['message']).'</div>';
        }
    }
    ?>
    <form action="register.php" method="post">
        <h2>Inscription</h2>
        <h3>Bienvenue si vous avez un compte veuillez vous connecter <a href="connexion.php" >ici</a> </h3>

        <div class="form-group">
            <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Inscription</button>

        </div>
    </form>
</div>

</body>
</html>