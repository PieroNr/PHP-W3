<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="src/app/assets/css/app.css">
    <link rel="stylesheet" href="src/app/assets/css/form.css">
    <title>Account</title>
</head>
<body>
<div class="container">
    <h1>My account</h1>
    <form action="" method="get" class="form-example">
        <div class="form">
            <label for="name">Nom: </label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="form">
            <label for="name">Prénom: </label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="form">
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form">
            <label for="password">Mot de passe : </label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form">
            <label for="password">Vérifier le mot de passe : </label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form">
            <input class="btn" type="submit" value="Modifier">
        </div>
    </form>

</div>
</body>
</html>
