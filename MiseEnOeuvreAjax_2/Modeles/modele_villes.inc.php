<?php

require_once __DIR__ . '/modele.inc.php';

function obtenirVilleDuDepartement($idDepartement) {
    try {
        $bdd = connexionBdd();

        $requete = $bdd->prepare('SELECT ville_id, ville_nom FROM villes where ville_departement_id = :id;');
        $requete->bindParam(":id", $idDepartement);
        $requete->execute();

        $villes = array();
        while ($reponse = $requete->fetch(PDO::FETCH_ASSOC)) {
            array_push($villes, $reponse);
        }
        $requete->closeCursor();
        return $villes;
    } catch (PDOException $exc) {
        print(" Pb obtenirDepartementsDeLaRegion :" . $exc->getMessage());
        die();
    }
}

function obtenirDepartementsPourVille($nomVille) {
    try {
        $bdd = connexionBdd();

        $requete = $bdd->prepare("select villes.ville_nom_simple as Ville, villes.ville_code_postal as Code_postal, departements.departement_nom as Departement
                                FROM departements, villes 
                                WHERE villes.ville_departement_id = departements.departement_id
                                AND villes.ville_nom= :nom;");
        $requete->bindParam(":nom", $nomVille);
        $requete->execute();
        $departements = array();
        while ($reponse = $requete->fetch()) {
            array_push($departements, array(
                // Elements à mettre dans le tableau pour le DataTables
                $reponse['Ville'],
                $reponse['Code_postal'],
                $reponse['Departement'],
                    )
            );
        }
        $requete->closeCursor();
        return $departements;
    } catch (PDOException $exc) {
        print(" Pb obtenirDepartementsDeLaRegion :" . $exc->getMessage());
        die();
    }
}
