<?php

require_once __DIR__ . '/modele.inc.php';

function getInfosAnnuaire() {
    try {
        // connexion à la base de données
        $bdd = connexionBdd();
        $requete = $bdd->query("SELECT nom, prenom, age from users; ");
       $tabInfosAnnuaire = array();
        // execution de la requete
        while ($ligne = $requete->fetch()) {
            array_push($tabInfosAnnuaire, array(
                $ligne['nom'],
                $ligne['prenom'],
                $ligne['age']
            ));
        }
        // libération de la ressource
        $requete->closeCursor();
        return $tabInfosAnnuaire;
        
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}