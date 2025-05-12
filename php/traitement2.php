<?php

session_start();

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    $login = filter_input(INPUT_POST, 'login2');
    $mdp = filter_input(INPUT_POST, 'mdp2');
    $couple = $login . "/" . $mdp;
}
if (in_array($couple, $tabLogin)) {
// générer un cookie nommé logok et prenant comme valeur true
    $_SESSION["logok"] = "true";
// redirection vers accueil.php
    header("Location: acceuil.php");
} else {
// générer un cookie nommé logok et prenant comme valeur false
    $_SESSION["logok"] = "false";
// redirection vers login.php
    header("Location: login.php");
}
?>
