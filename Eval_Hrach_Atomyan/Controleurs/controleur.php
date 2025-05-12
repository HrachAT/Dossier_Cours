<?php

require_once __DIR__ . '/../Modeles/modele_tibco.inc.php';

// test de la méthode d'envois des données
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET') {
    // récupération de la donnée 'commande'
    $commande = filter_input(INPUT_GET, 'commande');
    header('Content-Type: application/json', JSON_NUMERIC_CHECK);
    switch ($commande) {
        case 'getListeClients' :

            $clients = genererListeEntrepriseJson();
            echo json_encode($clients);
            break;
        case 'getBoitesSite' :

            echo json_encode(getDataTableauSpareClient());

            break;
        case 'getListeBoites' :
            $clients = genererListeBoiteJson();
            echo json_encode($clients);
            break;
        default:
            header('Content-Type: application/json');
            echo json_encode("commande inconnue");
    }
}

