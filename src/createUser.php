<?php
use App\classes\User;
use App\Database\Database;

require './vendor/autoload.php';

$database = new Database();
$db = $database->getConnection();

$users = new User($db);
$result = $users->getUsers();

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Créer un utilisateur</title>
        <link rel="stylesheet" href="assets/css/app.css">
    </head>
    <body>
        <form action=""></form>
    </body>
</html>
