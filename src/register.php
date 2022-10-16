<?php
session_start();
if(isset($_SESSION['connect'])){
    header('location: index.php');
    exit();
}
$pdo = new PDO("mysql:host=database:3306;dbname=php_db", "root", "password");

if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) ){

    // VARIABLE
    $pseudo       = $_POST['pseudo'];
    $email        = $_POST['email'];
    $password     = $_POST['password'];



    // TEST SI EMAIL UTILISE
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email ");
    $stmt->bindParam(':email',$email);
    $stmt->execute();

if($stmt->rowCount()!=0){
    exit('Email already exists');
}else{
    echo 'Compte cree avec succès';

}


    // HASH
    $secret = sha1($email).time();
    $secret = sha1($secret).time().time();


    // CRYPTAGE DU PASSWORD
    $password = "aq1".sha1($password."1254")."25";

    // ENVOI DE LA REQUETE
    $req = $pdo->prepare("INSERT INTO users (pseudo, email, password, secret) VALUES(?,?,?,?)");
    $req->execute([
            $pseudo,
            $email,
            $password,
            $secret
    ]);


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