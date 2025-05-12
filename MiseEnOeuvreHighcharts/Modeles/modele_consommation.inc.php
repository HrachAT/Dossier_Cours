<?php

require_once __DIR__ . '/modele.inc.php';

function obtenirConsommation($idUser) {
    try {
        $bdd = connexionBdd();
        // generation des tableaux des series et categories pour l'utilisateur            
        $tabSeries = array();
        $requete = $bdd->prepare("SELECT prenom, quantite, nomFruit from fruits, consommation, users where users.idUser=:id and fruits.idFruit =consommation.idFruit and users.idUser = consommation.idUser;");
        $requete->bindParam(":id", $idUser);
        $requete->execute();
        $tabSerieCourante = array();
        $tabCategorie = array();
        while ($ligne = $requete->fetch()) {
            array_push($tabSerieCourante, $ligne['quantite']);
            array_push($tabCategorie, $ligne['nomFruit']);
            $prenom = $ligne['prenom'];
        }
        $requete->closeCursor();

        array_push($tabSeries, array(
            'name' => $prenom,
            'data' => $tabSerieCourante
        ));

        $tabDonnees = array(
            "series" => $tabSeries,
            "categories" => $tabCategorie
        );
        return $tabDonnees;
    } catch (Exception $exc) {
        print("Erreur : " . $exc->getMessage() . "</br>");
        die();
    }
}

function obtenirLesConsommations() {
    try {
        // Connexion à la base de données
        $bdd = connexionBdd();
        // Requête  pour récupérer toutes les consommations
        // avec les prénoms des utilisateurs
        $requete = $bdd->query("
            SELECT users.prenom, consommation.quantite, fruits.nomFruit
            FROM consommation, users, fruits
            WHERE users.idUser = consommation.idUser
            AND fruits.idFruit = consommation.idFruit
            ORDER BY users.idUser, fruits.idFruit;
        ");
        $tabSeries = [];
        $tabCategories = [];
        while ($ligne = $requete->fetch()) {
            $prenom = $ligne['prenom'];
            // Si l'utilisateur n'existe pas encore dans le tableau, on l'initialise
            if (!isset($tabSeries[$prenom])) {
                $tabSeries[$prenom] = [
                    'name' => $prenom,
                    'data' => []
                ];
            }
            // Ajout des quantités consommées pour l'utilisateur
            $tabSeries[$prenom]['data'][] = $ligne['quantite'];
            // Stockage des catégories 
            // si le fruit courant n'est pas dans les catégories
            // l'y ajouter
            if (!in_array($ligne['nomFruit'], $tabCategories)) {
                $tabCategories[] = $ligne['nomFruit'];
            }
        }
        $requete->closeCursor();
        // Conversion des données en un tableau indexé pour l'affichage
        $tabDonnees = [
            "series" => array_values($tabSeries),
            "categories" => $tabCategories
        ];
        return $tabDonnees;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
