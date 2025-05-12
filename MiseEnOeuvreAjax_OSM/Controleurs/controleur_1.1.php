<?php

require_once __DIR__ . '/../Modeles/modele.inc.php';

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    // récupération de la donnée 'commande'
    $commande = filter_input(INPUT_POST, 'commande');

    // envoi de l'en-tête pour la réponse en json
    header('Content-Type: application/json');

    switch ($commande) {
        case 'obtenirAdresse' :
            // récupération de l'id de l'utilisateur
            $id = filter_input(INPUT_POST, 'idUser', FILTER_VALIDATE_INT);
            // $numero est bien un entier
            if ($id != false) {
                echo json_encode(obtenirAdresse($id));
                
            }
            break;
        case 'obtenirPrenom' :
            // récupération de l'id de l'utilisateur
            $id = filter_input(INPUT_POST, 'idUser', FILTER_VALIDATE_INT);
            // $numero est bien un entier
            if ($id != false) {
                echo json_encode(obtenirPrenom($id));
               
            }
            break;
        case 'listeUtilisateurs' :
            echo json_encode(obtenirListeUtilisateurs());
            break;
        default:
            echo json_encode("commande inconnue");
    }
}