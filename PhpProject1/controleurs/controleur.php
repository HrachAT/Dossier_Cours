<?php
require_once __DIR__.'/../Modeles/modele_users.inc.php';
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'GET') {
    $action = filter_input(INPUT_GET, "action");
    switch ($action) {
        case 'getAnnuaire':
            $tabInfosAnnuaire = getInfosAnnuaire();
            //envoyer les données au format json
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($tabInfosAnnuaire, JSON_NUMERIC_CHECK);
            break;
    }
}