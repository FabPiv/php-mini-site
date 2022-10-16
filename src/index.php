<?php
session_start();

$pdo = new PDO("mysql:host=database:3306;dbname=php_db", "root", "password");
require_once 'auth_check.php';
$liens = [

    "Mes posts" => "./post/post.php",
    "Voir les utilisateurs" => "see_users.php",
    "Ajouter un post" => "./post/add_post.php",
    "Connexion" => "connexion.php",
    "Inscription"=>"register.php",
    "Deconnexion"=>"logout.php"

];
$query = $pdo->query("SELECT * FROM users");

//var_dump($query->fetchAll());

$query->execute();

$users = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>

</head>
<body>
<nav>
    <ul>
        <?php foreach($liens as $libelle =>$lien ): ?>

            <li> <a href=" <?= $lien ?>"><?= $libelle ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>
