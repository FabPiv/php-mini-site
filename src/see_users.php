<?php
session_start();

$pdo = new PDO("mysql:host=database:3306;dbname=php_db", "root", "password");
require_once 'auth_check.php';
$liens = [

"Mes post" => "./post/post.php",
"Supprimer un post" => "./post/delete_post.php",
"Modifier un post" => "./post/modify_post.php",
"Voir les postes" => "./post/read_posts.php",
"Voir les utilisateurs" => "see_users.php",
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

<body>

<h1>Liste Utilisateur</h1>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Pseudo</th>
        <th>email</th>


    </tr>
    </thead>
    <tbody>
    <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user["id"] ?>   </td>
            <td><?= $user["pseudo"] ?></td>
            <td><?= $user["email"] ?></td>



        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

</body>



</html>
