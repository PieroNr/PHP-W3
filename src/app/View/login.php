<?php
ob_start();


use App\Database\Database;
use App\Model\User;

require '../../vendor/autoload.php';

session_start();
 ?>
    <h1>Connexion utilisateur</h1>
    <form action="login_post.php" method="post">
        <label for="nom">Email :</label>
        <input type="text" name="login" id="nom" required />
        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp" id="mdp" required />
        <input type="submit" value="Connexion">
        <p class="box-register">Vous êtes nouveau ici? <a href="login_post.php.php">S'inscrire</a></p>
        <?php if (!empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>
    </form>

<?php
$content = ob_get_clean();
require_once("template.php");
