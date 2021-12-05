<?php
ob_start();

use App\Database\Database;
use App\Manager\UserManager;

require '../../vendor/autoload.php';

$managerUser = new UserManager(Database::getConnection());
$recipes = $managerUser->getAllUsers();





?>

        <div class="container">
            <div class="alert alert-danger mb-1">Si vous supprimer un utilisateur, ces posts et commentaires seront automatiquement supprimer.</div>
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
                            <td><?php echo $managerUsers['first_name'];?></td>
                            <td><?php echo $managerUsers['last_name']; ?></td>
                            <td><a class="primary" href="mailto:<?php echo $managerUsers['email']; ?>"><?php echo $managerUsers['email']; ?></a></td>
                            <td>
                                <?php if ($managerUsers['is_admin'] == 1) {
                                    echo "Administrateur";
                                } else {
                                    echo "Utilisateur";
                                } ?>
                            </td>
                            <td class="text-end">
                                <a href="modifUser.php?id=<?php echo $managerUsers['id']?>">Modifier</a>
                                <?php echo $managerUsers['id'] ?>
                                <a href="delete-user.php?id=<?php echo $managerUsers['id']?>">Supprimer</a>
                            </td>
                        </tr>
                     <?php } ?>
                </tbody>
            </table>
        </div>
<?php
$content = ob_get_clean();
require_once("template.php");
