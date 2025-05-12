<!DOCTYPE html>
<?php
session_start();

require_once './fonctions.inc.php';

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === "POST") {
// Traitement pour le nom

    $nom = filter_input(INPUT_POST, "nom");
    $prenom = filter_input(INPUT_POST, "prenom");
    $mdp = filter_input(INPUT_POST, "mdp");
    $confirme = filter_input(INPUT_POST, "confirme");
    $login = filter_input(INPUT_POST, "login");

    $email = filter_input(INPUT_POST, "mail", FILTER_VALIDATE_EMAIL);

    echo "Bonjour : $nom $prenom  </br>";

    echo 'Ville : ' . filter_input(INPUT_POST, "code_postal") . '</br>';

    if ($email !== false) {
        echo "Votre adresse mail est valide : $email </br>";
    } else {
        echo "adresse mail invalide";
        header("Location: ../index.php");
        exit();
    }



    //verif mdp
    $ok = verifierDoubleMotPasse($mdp, $confirme);
    if ($ok) {
        echo "mot de passe ok";
        //recup log et mdp
        if (!isset($_SESSION['logmdp'])) {
            $_SESSION['logmdp'] = [];
        }
        $_SESSION['logmdp'][] = $login . "/" . $mdp;
    } else {
        echo "mot de passe pas ok";
    }
    setcookie("nom", $nom, time() + 3600, "/");

    //redirection 

    if ($ok === FALSE) {
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: login.php");
        exit();
    }
}

