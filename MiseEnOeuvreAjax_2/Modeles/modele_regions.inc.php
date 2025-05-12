<?php

require_once __DIR__ . '/modele.inc.php';

function obtenirListeRegions() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->query('SELECT region_id, region_nom FROM regions;');
        $requete->execute();

        $lesRegions = array();
        while ($reponse = $requete->fetch(PDO::FETCH_ASSOC)) {
            array_push($lesRegions, $reponse);
        }
        $requete->closeCursor();
        return $lesRegions;
    } catch (PDOException $exc) {
        print("Pb obtenirListeRegions :" . $exc->getMessage());
        die();
    }
}
