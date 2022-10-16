<?php
session_start();
if($_SESSION['connect'] = 1){

    session_unset();
    session_destroy();
    header('location: connexion.php');
    exit('Vous avez ete deconnecté');} ?>

<div>
        Logout Sucessful!
        Please <a href="connexion.php">re-login</a> to access the site again.
</div>

