<?php
use App\Database\Database;
use App\Manager\UserManager;
use App\Manager\PostManager;
use App\Manager\CommentManager;


require '../../vendor/autoload.php';
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/app.css">
    <title>Doo.og</title>
</head>
<body>
<nav class="w-100 nav bg-primary">
    <ul class="d-flex a-i-center">
        <li class="px-3">
            <a class="d-flex a-i-center" style="opacity: 1;" href="posts.php">
                <img src="../assets/img/logo.png" alt="logo" style="width: 50px">
                <h1>DOO.OG</h1>
            </a>
        </li>
        <li class="px-3"><a href="posts.php">Home</a></li>
        <li class="px-3"><a href="account.php">Account</a></li>
        <?php if(isset($_SESSION['login'], $_SESSION['mdp'])){
            if($_SESSION['is_admin'] == 1){?>
            <li class="px-3"><a href="users.php">Users</a></li>
            <li class="px-3"><a href="/api/post">API Posts</a></li>
            <li class="px-3"><a href="/api/user">API Users</a></li>
            <li class="px-3"><a href="/api/comment">API Comments</a></li>

        <?php }} ?>




        <?php if(isset($_SESSION['login'], $_SESSION['mdp'])){ ?>
            <b class="px-3 ms-auto"><?php echo $_SESSION['firstname']. " " .$_SESSION['lastname'];?></b>
            <li class="px-3">
                <button class="btn btn-secondary" onclick="window.location.href = 'logout.php';">Logout</button>
            </li>
        <?php } else {?>
        <li class="px-3 ms-auto">
            <button class="btn" onclick="window.location.href = 'login.php';">Log in</button>
        </li>
        <li class="px-3">
            <button class="btn btn-secondary" onclick="window.location.href = 'Signup.php';">Sign in</button>
        </li>
        <?php } ?>
    </ul>
</nav>
<div class="container">
    <?=$content?>
</div>
</body>
</html>
