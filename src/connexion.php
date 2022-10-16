<?php
session_start();
if(!empty($_POST['email']) && !empty($_POST['password'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $pdo = new PDO("mysql:host=database:3306;dbname=php_db", "root", "password");

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header('location: connexion.php?error1&message=Votre adresse email est invalide.');
        exit();

}
    //hashage password
    $password = "aq1".sha1($password."1254")."25";

    //verification que le mail existe

    $req = $pdo->prepare("SELECT count(*) as numberEmail FROM users WHERE email = ?");
    $req->execute([
            $email
    ]);
    while($email_verification = $req->fetch()){
        if($email_verification['numberEmail'] !=1){
            header('location: connexion.php?error=1&message=Impossible de vous authentifier correctement ');
            exit();
        }
    }


// connexion

$req = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$req->execute([
        $email
]);

while($users = $req->fetch()){
    if($password == $users['password']){
        $_SESSION['connect'] = 1;
        $_SESSION['email'] = $users['email'];
        $_SESSION['pseudo'] = $users['pseudo'];
        $_SESSION['id'] = $users['id'];


        header('location: connexion.php?success=1 ');
        exit();

    }else{
        header('location: connexion.php?error=1&message=Impossible de vous authentifier correctement ');
        exit();
    }
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Title of the document</title>
</head>

<body>
    <?php if(isset($_SESSION['connect'])){ ?>
        <h1>Bienvenue <?php echo $_SESSION['pseudo']?> très heureux de vous voir</h1>
        <p>Gerez vos post dans Accueil</p>
        <a href="index.php">Accueil</a>
        <a href="logout.php">Deconnexion</a>


    <?php }else { ?>



        <h2>Connexion</h2>
        <?php
        if(isset($_GET['error'])){
            if(isset($_GET['message'])){
                echo '<div>'.htmlspecialchars($_GET['message']).'</div>';
            }
        }else if(isset($_GET['success'])){
            echo '<div>'.'Vous etes maintenant connecté'.'</div>';


        }
        ?>

        <form action="connexion.php" method="post">
        <h3>Bienvenue! si vous avez pas de compte veuillez inscrire  <a href="register.php" >ici</a> </h3>


        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Connexion</button>

        </div>
        </form>
    <?php } ?>
</body>

</html>