<?php

use App\classes\Post;
use App\classes\Comment;
use App\Database\Database;

require './vendor/autoload.php';

$database = new Database();
$db = $database->getConnection();

$Post = new Post($db);
$result = $Post->getPosts();
$Comment = new Comment($db);
$result = $Comment->getComment();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>
    <link rel="stylesheet" href="./assets/css/app.css">
</head>
<body>
<nav class="w-100 nav bg-primary">
    <ul class="d-flex a-i-center">
        <li class="px-3">
            <a class="d-flex a-i-center" style="opacity: 1;" href="../index.php">
                <img src="assets/img/logo.png" alt="logo">
                <h1>DOO.OG</h1>
            </a>
        </li>
        <li class="px-3"><a class="active" href="../index.php">Home</a></li>
        <li class="px-3"><a href="">Account</a></li>
        <li class="px-3"><a href="users.php">Users</a></li>
        <li class="px-3 ms-auto">
            <button class="btn">Log in</button>
        </li>
        <li class="px-3">
            <button class="btn btn-secondary">Sign in</button>
        </li>
    </ul>
</nav>
<div class="container">
    <div class="post-container">
        <div class="post px-3 bg-primary">
            <?php while ($Post = $result->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="d-flex a-i-center mb-1 secondary">
                <h2><?php echo $Post['title']; ?></h2>
            </div>
            <img alt=""
                 src="https://images.unsplash.com/photo-1494253109108-2e30c049369b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8cmFuZG9tfGVufDB8fDB8fA%3D%3D&w=1000&q=80"/>
            <p class="p-3 secondary"><?php echo $Post['content']; ?></p>
            <div class="d-flex ms-auto p-3 secondary">
                <span class="author"><?php echo $Post['authorid']; ?></span>
                <span class="hour"><?php echo $Post['publish']; ?></span>
            </div>
        </div>
        <?php } ?>
        <div class="comments px-3">
            <div class="mb-1">
                <?php while ($Comment = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                    <h3>Commentaires</h3>
                    <h6 class="comment-author"><?php echo $Comment['authorid']; ?> : </h6>
                    <p><?php echo $Comment['publish']; ?></p>
                    <p class="comment px-3 pt-1"><?php echo $Comment['content']; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="py-3">
                <textarea name="commentaire" id="input1" class="w-100" rows="4" cols="48"></textarea>
                <button class="btn btn-secondary">Commenter</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>

