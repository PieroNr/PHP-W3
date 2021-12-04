<?php
ob_start();


use App\classes\User;
use App\Database\Database;

require './vendor/autoload.php';


if (isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'])){

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $first_name = stripslashes($_POST['first_name']);
    $last_name = stripslashes($_POST['last_name']);
    $email = stripslashes($_POST['email']);
    $password = stripslashes($_POST['password']);

    $user->firstname = $first_name;
    $user->lastname = $last_name;
    $user->email = $email;
    $user->password = $password;
    if (isset($_POST['is_admin'])){
        $user->isadmin = 1;
    }else{
        $user->isadmin = 0;
    }
    echo $first_name;

    $user->createUser();

    header('Location: http://localhost:5555/index.php');
    exit();


}else{
    ?>
    <form class="box" action="" method="post">
        <h1 class="box-title">S'inscrire</h1>
        <input type="text" class="box-input" name="first_name" placeholder="Prénom" required />
        <input type="text" class="box-input" name="last_name" placeholder="Nom" required />
        <input type="email" class="box-input" name="email" placeholder="Email" required />
        <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
        <input type="checkbox" class="box-input" name="is_admin">
        <input type="submit" name="submit" value="S'inscrire" class="box-button" />

        <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
    </form>
<?php }
$content = ob_get_clean();
require_once("template.php");