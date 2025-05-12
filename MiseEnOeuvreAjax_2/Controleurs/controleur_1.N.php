<?php

require_once __DIR__ . '/../Modeles/modele_regions.inc.php';
require_once __DIR__ . '/../Modeles/modele_departements.inc.php';
require_once __DIR__ . '/../Modeles/modele_villes.inc.php';

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET') {
    // récupération de la donnée 'commande'
    $commande = filter_input(INPUT_GET, 'commande');

    // envoi de l'en-tête pour la réponse en json
    header('Content-Type: application/json');

    switch ($commande) {
        case 'getRegions' :
            echo json_encode(obtenirListeRegions());
            break;
        case 'getDepartements' :
            // récupération du numéro de département
            $idRegion = filter_input(INPUT_GET, 'idRegion', FILTER_VALIDATE_INT);
            // $numero est bien un entier
            if ($idRegion != false) {
                echo json_encode(obtenirDepartementsDeLaRegion($idRegion));
            }
            break;
        case 'getVille' :
            // récupération du numéro de département
            $idDepartement = filter_input(INPUT_GET, 'idDepartement', FILTER_VALIDATE_INT);
            // $numero est bien un entier
            if ($idDepartement != false) {
                echo json_encode(obtenirVilleDuDepartement($idDepartement));
            }
            break;
        case 'getDepartementsPourVille' :
            // récupération du numéro de département
            $nomVille = filter_input(INPUT_GET, 'nomVille');
            // $numero est bien un entier
            if ($nomVille != false) {
                echo json_encode(obtenirDepartementsPourVille($nomVille));
            }
            break;

        default:

            echo json_encode("commande inconnue");
    }
}