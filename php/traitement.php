<?php

session_start();

require_once './fonctions.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /* echo 'Nom : ' . filter_input(INPUT_POST, "nom") . '</br>';
      echo 'Prenom : '. filter_input(INPUT_POST, "prenom") . '</br>';
      echo 'Ville : '. filter_input(INPUT_POST, "code_postale") . '</br>';
      echo 'Le Sexe : '. filter_input(INPUT_POST, "lesexe") . '</br>';
      echo 'OS : '. filter_input(INPUT_POST, "OS") . '</br>';
      echo 'Version : '. filter_input(INPUT_POST, "version") . '</br>';
      echo 'Mot de passe : '. filter_input(INPUT_POST, "mdb") . '</br>';
      echo 'Confirmation du mot de passe : '. filter_input(INPUT_POST, "confirme") . '</br>'; */

    $nom = filter_input(INPUT_POST, "nom");
    $prenom = filter_input(INPUT_POST, "prenom");
    $mdp = filter_input(INPUT_POST, "mdp");
    $login = filter_input(INPUT_POST, "login");
    $confirme = filter_input(INPUT_POST, "confirme");

    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

    //echo "Bonjour : $nom $prenom  </br>";

    echo 'Ville : ' . filter_input(INPUT_POST, "code_postal") . '</br>';

    //Verification de la structure du mail
    if ($email !== false) {
        echo "Votre adresse mail est valide : $email </br>";
    } else {
        echo "adresse mail invalide";
    }
    echo "<br>[$login][$mdp]<br>";
    //Génération de la variable cookie $logmdp
    $logmdp = filter_input(INPUT_COOKIE, "logmdp");
    if ($logmdp) {
        echo "in cookie 1";
        setcookie("logmdp", $logmdp . "|" . $login . "/" . $mdp, time() + 3600,"/");
    } else {
        echo "in cookie 2";
        setcookie("logmdp", $login . "/" . $mdp, time() + 3600,"/");
    }
    //Verification du mot de passe
    if (verifierDoubleMotPasse($mdp, $confirme)) {
        echo "Mot de passe OK";
    } else {
        echo "Mot de passe pas OK";
        header("Location: ../index.php");
        exit();
    }



    /* Création des cookies-**/
      setcookie("nom", $nom, time() + 3600, "/");
      setcookie("prenom", $prenom, time() + 3600, "/"); 
}

