<?php

require_once __DIR__.'/../Modeles/modele_mesures.inc.php';



if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET') {
   // récupération de la donnée 'commande'
    $commande = filter_input(INPUT_GET, 'commande');
   
    // envoi de l'en-tête pour la réponse en json
    header('Content-Type: application/json');   

    switch ($commande) {   
        case 'getTpsAlt':
            echo json_encode(obtenirEvolutionAltitudeTemps(),JSON_NUMERIC_CHECK);
            break;
         case 'getTpsAltPres':
            echo json_encode(obtenirEvolutionAltitudePressionTemps(),JSON_NUMERIC_CHECK);
            break;  
         case 'getTpsTemperature':
            echo json_encode(obtenirEvolutionTemperatureTemps(),JSON_NUMERIC_CHECK);
            break;
        case 'getTpsAltTemperature':
            echo json_encode(obtenirEvolutionAltitudeTemperatureTemps(),JSON_NUMERIC_CHECK);
            break;
        case 'getTpsAltTemperaturePres':
            echo json_encode(obtenirEvolutionAltitudePressionTemperatureTemps(),JSON_NUMERIC_CHECK);
            break;
        default:

            echo json_encode("commande inconnue");
    }
}