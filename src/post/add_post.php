<?php
session_start();
require_once '../auth_check.php';


require_once '../PDO.php';
$liens = [

    "Accueil" => "../index.php"


];


//afficher les utilisateurs
$statement = $pdo->prepare("SELECT posts.post_id,posts.title_post,posts.post_txt,users.id,users.pseudo FROM `users`,`posts` WHERE posts.user_id = users.id ORDER BY users.pseudo");

$statement->execute();

$users = $statement->fetchAll(PDO::FETCH_ASSOC);


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $postTitle = filter_input(INPUT_POST, "postTitle");
    $postTxt = filter_input(INPUT_POST, "postTxt");





    $maRequete = $pdo->prepare("INSERT INTO posts (title_post,post_txt,user_id) VALUES(:postTitle,:postTxt, :iduser)");
    $maRequete->execute([
        ":postTitle" => $postTitle,
        ":postTxt" => $postTxt,
        ":iduser" => $_SESSION['id']

    ]);



    http_response_code(302);
    echo 'operation reussite';
    header('Location: add_post.php');
    exit();
}
var_dump($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une pages</title>
</head>
<body>
<nav>
    <ul>
        <?php foreach($liens as $libelle =>$lien ): ?>

            <li> <a href=" <?= $lien ?>"><?= $libelle ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>








<h1>Ajouter un nouveau post</h1>
<br>


<form method="POST">
    <label for="user">Titre du post :</label>
    <input type="text" id="postTitle" name="postTitle" placeholder="Titre du post" />
    <label for="user">Contenu à ajouter :</label>
    <input type="text" id="postTxt" name="postTxt" placeholder="contenu" required
           minlength="4" maxlength="800" size="100" />





    <input type="submit" value="ajouter un post " />

</form>
<center> <h2> Liste des posts</h2></center>
<table>
    <thead>
    <tr>
        <th>ID créateur</th>
        <th>pseudo</th>
        <th>Titre</th>
        <th>contenu</th>


    </tr>
    </thead>
    <tbody>
    <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user["id"] ?>   </td>
            <td><?= $user["pseudo"] ?></td>
            <td><?= $user["title_post"] ?></td>
            <td><?= $user["post_txt"] ?></td>



        </tr>
    <?php endforeach; ?>

</body>
</html>


</select>