<?php

ob_start();
use App\Database\Database;
use App\Manager\UserManager;
session_start();
require '../../vendor/autoload.php';
if(isset($_SESSION['login'], $_SESSION['mdp'])) {
    $managerUser = new UserManager(Database::getConnection());
    $user = $managerUser->getUser($_GET['id']);
    $managerUser->deleteUser($_GET['id']);
    ?>
    <div class="container">
        <div class="alert alert-danger mb-1"><?php echo "L'utilisateur " . $user['first_name'] . " " . $user['last_name'] . " à été supprimé" ?></div>

    </div>
    <a href="users.php">Tous les utilisateurs</a>
    <?php
}
$content = ob_get_clean();
require_once("template.php");
