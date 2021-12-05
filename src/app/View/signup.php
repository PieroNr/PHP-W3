<?php

use App\Database\Database;
use App\Manager\UserManager;
require '../../vendor/autoload.php';

ob_start();


if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'])){


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



    $manager = new UserManager(Database::getConnection());
    $manager->createUser($input);

    $_POST['login'] = $_POST['email'];
    $_POST['mdp'] = $_POST['password'];

    header('Location: http://localhost:5555/app/view/login_post.php');
    exit();


}else{
    ?>
    <form class="box" action="" method="post">
        <h1 class="box-title">S'inscrire</h1>
        <input type="text" class="box-input" name="firstname" placeholder="Prénom" required />
        <input type="text" class="box-input" name="lastname" placeholder="Nom" required />
        <input type="email" class="box-input" name="email" placeholder="Email" required />
        <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
        <input type="checkbox" class="box-input" name="is_admin">
        <input type="submit" name="submit" value="S'inscrire" class="box-button" />

        <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
    </form>
<?php }
$content = ob_get_clean();
require_once("template.php");
