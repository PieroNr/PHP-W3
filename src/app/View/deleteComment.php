<?php

use App\Database\Database;
use App\Manager\CommentManager;

require '../../vendor/autoload.php';
session_start();
if(isset($_SESSION['login'], $_SESSION['mdp'])) {
    if (isset($_GET['id'])) {
        echo 'coucou';
        $managerComment = new CommentManager(Database::getConnection());
        $managerComment->deleteComment($_GET['id']);
    }
}

?>
