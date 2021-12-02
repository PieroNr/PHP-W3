<?php

use App\classes\User;
use App\Database\Database;

require './vendor/autoload.php';

$database = new Database();
$db = $database->getConnection();

$users = new User($db);
$result = $users->getUsers();

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
                    <div class="d-flex a-i-center mb-1 secondary">
                        <h2>Example post title</h2>
                    </div>
                    <img alt="" src="https://images.unsplash.com/photo-1494253109108-2e30c049369b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8cmFuZG9tfGVufDB8fDB8fA%3D%3D&w=1000&q=80"/>
                    <p class="p-3 secondary">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A asperiores aspernatur assumenda dolore earum exercitationem modi nisi odio pariatur porro, quisquam, sunt, temporibus unde! Atque cupiditate mollitia nisi sint vero.</p>
                    <div class="d-flex ms-auto p-3 secondary">
                        <span class="author">Adrien Bouteiller</span>
                        <span class="hour">le jj/mm/aaaa </span>
                    </div>
                </div>
                <div class="comments px-3">
                    <div class="mb-1">
                        <h3>Commentaires</h3>
                        <h6 class="comment-author">Tristan Seclet : </h6>
                        <p class="comment px-3 pt-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, beatae, neque? Amet asperiores at cum
                            earum eos est itaque magnam, molestiae odit quod reiciendis repellendus sapiente, tempora totam ut,
                            voluptas!
                        </p>
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

