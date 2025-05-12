<?php
session_start();

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    $login = filter_input(INPUT_POST, 'login2');
    $mdp = filter_input(INPUT_POST, 'mdp2');
    $couple = $login . "/" . $mdp;

    if (in_array($couple,$_SESSION['logmdp'])) {
        $_SESSION["logok"]="true";
        header("Location: acceuil.php");
        exit();
    } else {
        $_SESSION["logok"]="false";
        header("Location: login.php");
        exit();
    }
}