<?php
require_once  __DIR__.'/../Modeles/modele.inc.php';

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    // récupération de la donnée 'commande'
    $commande = filter_input(INPUT_POST, 'commande');
   
    // envoi de l'en-tête pour la réponse en json
    header('Content-Type: application/json');   
    switch ($commande) {
        case 'verifLogMdp' :
            // récupération du login et du mot de passe
            $log = filter_input(INPUT_POST, 'login');
            $mdp = filter_input(INPUT_POST, 'mdp');
            echo json_encode(verifierLogin($log, $mdp));
            
            break;
        default:
            
            echo json_encode("commande inconnue");
    }
}

