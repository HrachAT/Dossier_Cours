<?php

require_once __DIR__.'/../Modeles/modele_regions.inc.php';
//require_once __DIR__.'/../Modeles/modele_departements.inc.php';
//require_once __DIR__.'/../Modeles/modele_villes.inc.php';


if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET') {
   // récupération de la donnée 'commande'
    $commande = filter_input(INPUT_GET, 'commande');
   
    // envoi de l'en-tête pour la réponse en json
    header('Content-Type: application/json');   
    switch ($commande) {
      
        case 'getPopRegions2012':
                echo json_encode(obtenirPopulationRegions2012(),JSON_NUMERIC_CHECK);
            break;
        case 'getPopRegions2010':
                echo json_encode(obtenirPopulationRegions2010(),JSON_NUMERIC_CHECK);
            break;
        case 'getPopRegions1999':
                echo json_encode(obtenirPopulationRegions1999(),JSON_NUMERIC_CHECK);
            break;
        case 'getPopDepartement2012':
                echo json_encode(obtenirPopulationDepartements2012(),JSON_NUMERIC_CHECK);
            break;
        default:

            echo json_encode("commande inconnue");
    }
}
