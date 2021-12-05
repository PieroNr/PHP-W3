<?php

use App\Database\Database;
use App\Manager\UserManager;
require '../../vendor/autoload.php';
session_start();
ob_start();
$managerUser = new UserManager(Database::getConnection());

if (isset($_SESSION['idUser'])){
    $user = $managerUser->getUser($_SESSION['idUser']);

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

        $_SESSION['is_admin'] = $input['isadmin'];
        $_SESSION['firstname'] = $input['firstname'];
        $_SESSION['lastname'] = $input['lastname'];
        $_SESSION['email'] = $input['email'];
        $_SESSION['login'] = $input['email'];
        $_SESSION['mdp'] = $input['password'];


        $managerUser->updateUser($_SESSION['idUser'], $input);

        header('Location: http://localhost:5555/app/view/posts.php');
        exit();
    }

?>

    <form class="box" action="" method="post">
        <h1 class="box-title">Modifier</h1>
        <input type="text" class="box-input" name="firstname" placeholder="Prénom" value="<?php echo $user['first_name']; ?>" required />
        <input type="text" class="box-input" name="lastname" placeholder="Nom" value="<?php echo $user['last_name']; ?>" required />
        <input type="email" class="box-input" name="email" placeholder="Email" value="<?php echo $user['email']; ?>" required />
        <input type="text" class="box-input" name="password" placeholder="Mot de passe" value="<?php echo $user['password']; ?>" required />
        <input type="checkbox" class="box-input" name="is_admin" <?php if($user['is_admin'] ==1) echo "checked"; ?>/>
        <input type="submit" name="submit" value="Enregistrer" class="box-button" />


    </form>

<?php
} else {
    header('Location: http://localhost:5555/app/view/login.php');
    exit();
}
$content = ob_get_clean();
require_once("template.php"); ?>
