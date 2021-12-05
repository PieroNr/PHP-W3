<?php
ob_start();

use App\Database\Database;
use App\Manager\UserManager;

require '../../vendor/autoload.php';

$managerUser = new UserManager(Database::getConnection());
$recipes = $managerUser->getAllUsers();

session_start();



?>
<?php if(isset($_SESSION['login'], $_SESSION['mdp'])) {
    if ($_SESSION['is_admin'] == 1) {

        ?>




        <div class="container">
            <div class="alert alert-danger mb-1">Si vous supprimer un utilisateur, ces posts et commentaires seront
                automatiquement supprimer.
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
                <?php foreach ($recipes as $managerUsers) { ?>
                    <tr>
                        <td><?php echo $managerUsers['first_name']; ?></td>
                        <td><?php echo $managerUsers['last_name']; ?></td>
                        <td><a class="primary"
                               href="mailto:<?php echo $managerUsers['email']; ?>"><?php echo $managerUsers['email']; ?></a>
                        </td>
                        <td>
                            <?php if ($managerUsers['is_admin'] == 1) {
                                echo "Administrateur";
                            } else {
                                echo "Utilisateur";
                            } ?>
                        </td>
                        <td class="text-end">
                            <a href="modifUser.php?id=<?php echo $managerUsers['id'] ?>">Modifier</a>

                            <?php

                            if(!($_SESSION['idUser'] == $managerUsers['id'])){?>
                                <a href="deleteUser.php?id=<?php echo $managerUsers['id'] ?>">Supprimer</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else {
        header('Location: http://localhost:5555/app/view/posts.php');
        exit();
    }
}
$content = ob_get_clean();
require_once("template.php");
