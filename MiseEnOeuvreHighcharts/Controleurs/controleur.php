<?php

require_once __DIR__.'/../Modeles/modele_consommation.inc.php';
require_once __DIR__.'/../Modeles/modele_user.inc.php';


if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET') {
    $action = filter_input(INPUT_GET, "action");
    header('Content-type: application/json; charset=utf-8');
    switch ($action) {
        case 'getConsommation':
            $idUtilisateur = filter_input(INPUT_GET, "idUser", FILTER_VALIDATE_INT);
            if ($idUtilisateur !== false) {
                $tabConso = obtenirConsommation($idUtilisateur);
                echo json_encode($tabConso, JSON_NUMERIC_CHECK);
            }
            break;
        case 'getUsers':
            echo json_encode(obtenirUtilisateurs());
            break;
        case 'getConsommations':
            echo json_encode(obtenirLesConsommations());
            break;

        default:
            echo 'Commande inconnue';
            break;
    }
}
