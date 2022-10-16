<?php
session_start();
require_once '../auth_check.php';
$userid = $_SESSION['id'];
$username= $_SESSION['pseudo'];

$pdo = new PDO("mysql:host=database:3306;dbname=php_db", "root", "password");
$req = $pdo->prepare("SELECT * FROM `posts` WHERE user_id = $_SESSION[id] ");
$req->execute();

$posts = $req->fetchAll(PDO::FETCH_ASSOC);

$liens = [

    "Accueil" => "../index.php",
    "Gerer les posts" => "add_post.php",

];
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Utilisateur</title>
</head>



<body>
<nav>
    <ul>
        <?php foreach($liens as $libelle =>$lien ): ?>

            <li> <a href=" <?= $lien ?>"><?= $libelle ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>
<h1>Liste des posts</h1>
<table>
    <thead>
    <tr>
        <th>Id post</th>
        <th>Titre du post</th>
        <th>Contenu</th>
        <th>Auteur</th>



    </tr>
    </thead>
    <tbody>
    <?php foreach($posts as $post): ?>

        <tr>
            <td><?= $post['post_id'] ?>  </td>

            <td> <?= $post["title_post"] ?></td>
            <td><?= $post["post_txt"] ?></td>
            <td><?= $username ?></td>

            <td> <a href="pages-entiere.php?id=<?= $post["post_id"] ?>">afficher la page entiere</a></td>
            <td> <a href="delete_post.php?id=<?= $post["post_id"] ?>">Supprimer</a></td>
            <td> <a href="modify_post.php?id=<?= $post["post_id"] ?>">Modifier</a></td>

        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

</body>



</html>
