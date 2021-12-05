<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Accueil</title>
        <link rel="stylesheet" href="src/app/assets/css/app.css">
    </head>
    <body>
        <nav class="w-100 nav bg-primary">
            <ul class="d-flex a-i-center">
                <li class="px-3">
                    <a class="d-flex a-i-center" style="opacity: 1;" href="index.php">
                        <img style="width: 40px;" src="src/app/assets/img/logo.png" alt="logo">
                        <h1>WRIT.OR</h1>
                    </a>
                </li>
                <li class="px-3"><a class="active" href="index.php">Home</a></li>
                <li class="px-3"><a href="">Account</a></li>
                <li class="px-3"><a  href="users.php">Users</a></li>
                <li class="px-3 ms-auto">
                    <button class="btn">Log in</button>
                </li>
                <li class="px-3">
                    <button class="btn btn-secondary">Sign in</button>
                </li>
            </ul>
        </nav>
        <div class="container">
            <div class="post px-3 bg-secondary">
                <h2><strong>Exemple post title</strong></h2>
                <p>Ecrit par : nom de la personne <br/> Le : jj/mm/aaaa à hh:min</p>
                <img alt="" src="https://images.unsplash.com/photo-1494253109108-2e30c049369b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8cmFuZG9tfGVufDB8fDB8fA%3D%3D&w=1000&q=80"/>
                <p>Description du texte</p>
            </div>
            <div class="comments px-3">
                <h3>Les commentaires</h3>
                <h4>Auteur :</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, beatae, neque? Amet asperiores at cum
                    earum eos est itaque magnam, molestiae odit quod reiciendis repellendus sapiente, tempora totam ut,
                    voluptas!
                </p>
                <h3>Ajouter un commentaire</h3>
                <textarea name="commentaire" id="input1" class="w-100" rows="4" cols="48"></textarea>
                <button class="btn btn-secondary">Ajouter un article</button>
            </div>
        </div>
    </body>
</html>
