<?php

use App\Database\Database;
use App\Manager\UserManager;
require '../../vendor/autoload.php';

ob_start();
$managerUser = new UserManager(Database::getConnection());

if (isset($_GET['id'])){
    $user = $managerUser->getUser($_GET['id']);

    if (isset($_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['password'])){

        if (isset($_POST['is_admin'])){
            $isadmin = 1;
        }else{
            $isadmin = 0;
        }

        $input = array(
            'firstname' => $_POST['firstname'],
            'lastname' =>  $_POST['lastname'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'isadmin' => $isadmin
        );


        $managerUser->updateUser($_GET['id'], $input);
    }

?>

    <form class="box" action="" method="post">
        <h1 class="box-title">S'inscrire</h1>
        <input type="text" class="box-input" name="firstname" placeholder="Prénom" value="<?php echo $user['first_name']; ?>" required />
        <input type="text" class="box-input" name="lastname" placeholder="Nom" value="<?php echo $user['last_name']; ?>" required />
        <input type="email" class="box-input" name="email" placeholder="Email" value="<?php echo $user['email']; ?>" required />
        <input type="text" class="box-input" name="password" placeholder="Mot de passe" value="<?php echo $user['password']; ?>" required />
        <input type="checkbox" class="box-input" name="is_admin" <?php if($user['is_admin'] ==1) echo "checked"; ?>/>
        <input type="submit" name="submit" value="Enregistrer" class="box-button" />


    </form>

<?php
}
$content = ob_get_clean();
require_once("template.php"); ?>
?>
