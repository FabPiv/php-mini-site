<?php
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);


if($id) {

    require_once '../PDO.php';

    $maRequete = $pdo->prepare("DELETE FROM posts WHERE post_id = :id ");

    $maRequete->execute([
        ":id" => $id

    ]);

    echo "Le poste a été supprimé";
    header('Location: /post.php');
    exit();

}

?>