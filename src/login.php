<?php
ob_start();

use App\classes\User;
use App\Database\Database;

require './vendor/autoload.php';

session_start();
if (isset($_POST['first_name'], $_POST['password'])) {

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $first_name = stripslashes($_POST['first_name']);
    $password = stripslashes($_POST['password']);

    $user->firstname = $first_name;
    $user->password = $password;

    $user->getSingleUser();

    header('Location: http://localhost:5555/index.php');
    exit();


}else{ ?>
<form class="box" action="" method="post" name="login">
    <h1 class="box-logo box-title"><a href="https://waytolearnx.com/">WayToLearnX.com</a></h1>
    <h1 class="box-title">Connexion</h1>
    <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
    <input type="password" class="box-input" name="password" placeholder="Mot de passe">
    <input type="submit" value="Connexion " name="submit" class="box-button">
    <p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p>
    <?php if (!empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>
</form>
<?php }
$content = ob_get_clean();
require_once("template.php");