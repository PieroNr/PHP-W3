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
        $_SESSION['email'] = $res['email'];


    }

}
header('Location: http://localhost:5555/app/view/posts.php');
exit();
?>


