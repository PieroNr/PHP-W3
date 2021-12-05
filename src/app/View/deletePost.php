<?php

use App\Database\Database;
use App\Manager\PostManager;
require '../../vendor/autoload.php';
session_start();
if(isset($_SESSION['login'], $_SESSION['mdp'])) {
    if (isset($_GET['id'])) {
        $managerPost = new PostManager(Database::getConnection());
        $managerPost->deletePost($_GET['id']);
    }
}
header('Location: http://localhost:5555/app/view/posts.php');
exit();
?>
