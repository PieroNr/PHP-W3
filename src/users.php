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
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Utilisateurs</title>
            <link rel="stylesheet" href="assets/css/app.css">
        </head>
        <body>
            <nav class="w-100 nav bg-primary">
                <ul class="d-flex a-i-center">
                    <li class="px-3">
                        <a class="d-flex a-i-center" style="opacity: 1;" href="../index.php">
                            <img style="width: 40px;" src="assets/img/logo.png" alt="logo">
                            <h1>WRIT.OR</h1>
                        </a>
                    </li>
                    <li class="px-3"><a href="../index.php">Home</a></li>
                    <li class="px-3"><a href="">Account</a></li>
                    <li class="px-3"><a class="active" href="users.php">Users</a></li>
                    <li class="px-3 ms-auto">
                        <button class="btn">Log in</button>
                    </li>
                    <li class="px-3">
                        <button class="btn btn-secondary">Sign in</button>
                    </li>
                </ul>
            </nav>
            <div class="container">
                <div class="w-100 d-flex a-i-center mb-1">
                    <div class="alert alert-danger">Si vous supprimer un utilisateur, ces posts seront automatiquement supprimer.</div>
                    <a href="createUser.php" class="btn btn-primary ms-auto">Ajouter un utilisateur</a>
                </div>

                <table class="w-100 table">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Mail</th>
                            <th>Rôle</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = $result->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?php echo $user['first_name']; ?></td>
                                <td><?php echo $user['last_name']; ?></td>
                                <td><a class="primary" href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a></td>
                                <td>
                                    <?php if ($user['is_admin'] == 1) {
                                        echo "Administrateur";
                                    } else {
                                        echo "Utilisateur";
                                    }?>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-primary">Modifier</button>
                                    <button class="btn btn-danger">Supprimer </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </body>
    </html>
