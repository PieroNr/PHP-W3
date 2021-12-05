<?php

use App\Database\Database;
require '../../vendor/autoload.php';
session_start();  // démarrage d'une session

// on vérifie que les données du formulaire sont présentes
if (isset($_POST['login']) && isset($_POST['mdp'])) {

    $database = new Database();
    $bdd = $database->getConnection();
    // cette requête permet de récupérer l'utilisateur depuis la BD
    $requete = "SELECT * FROM users WHERE email=? AND password=?";
    $resultat = $bdd->prepare($requete);
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    $resultat->execute(array($login, $mdp));
    if ($resultat->rowCount() == 1) {
        // l'utilisateur existe dans la table
        // on ajoute ses infos en tant que variables de session
        $_SESSION['login'] = $login;
        $_SESSION['mdp'] = $mdp;

        // cette variable indique que l'authentification a réussi
        $authOK = true;
        $res = $resultat->fetch(PDO::FETCH_ASSOC);

        $_SESSION['is_admin'] = $res['is_admin'];
        $_SESSION['idUser']= $res['id'];
        $_SESSION['firstname'] = $res['first_name'];
        $_SESSION['lastname'] = $res['last_name'];

    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Résultat de l'authentification</title>
</head>
<body>
<h1>Résultat de l'authentification</h1>
<?php
if (isset($authOK)) {
    echo "<p>Vous avez été reconnu(e) en tant que " . $_SESSION['login'] . "</p>";
    if ($_SESSION['is_admin'] == 1){
        echo "<p>Vous êtes admin</p>";
    } else {
        echo "<p>Vous est utilisateur standard</p>";
    }
    echo '<a href="posts.php">Poursuivre vers la page d\'accueil</a>';
}
else { ?>
    <p>Vous n'avez pas été reconnu(e)</p>
    <p><a href="login.php">Nouvel essai</p>
<?php } ?>
</body>
</html>
