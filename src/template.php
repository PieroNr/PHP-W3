<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/app.css">
    <title>Doo.og</title>
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
        <li class="px-3"><a href="../index.php">Home</a></li>
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
    <?= $content ?>
</div>
</body>
</html>
