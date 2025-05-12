<?php

require_once __DIR__ . '/modele.inc.php';

function obtenirPopulationDepartements2012()
{
     try {
        $bdd = connexionBdd();
        $requete = $bdd->query("select departement_nom, sum(ville_population_2012) as pop from villes,departements 
            where villes.ville_departement_id =departements.departement_id
            group by departement_nom;");
        $requete->execute();

        $lesRegions = array();
        while ($reponse = $requete->fetch(PDO::FETCH_ASSOC)) {
            array_push($lesRegions, array(
               "name" => $reponse['departement_nom'],
                "y" => $reponse['pop']
            ));
        }
        $requete->closeCursor();
        return $lesRegions;
    } catch (PDOException $exc) {
        print("Pb obtenirListeRegions :" . $exc->getMessage());
        die();
    }
    
}

function obtenirPopulationDepartements2010()
{
     try {
        $bdd = connexionBdd();
        $requete = $bdd->query("select departement_nom, sum(ville_population_2010) as pop from villes,departements 
            where villes.ville_departement_id =departements.departement_id
            group by departement_nom;");
        $requete->execute();

        $lesRegions = array();
        while ($reponse = $requete->fetch(PDO::FETCH_ASSOC)) {
            array_push($lesRegions, array(
               "name" => $reponse['departement_nom'],
                "y" => $reponse['pop']
            ));
        }
        $requete->closeCursor();
        return $lesRegions;
    } catch (PDOException $exc) {
        print("Pb obtenirListeRegions :" . $exc->getMessage());
        die();
    }
    
}

function obtenirPopulationDepartements1999()
{
     try {
        $bdd = connexionBdd();
        $requete = $bdd->query("select departement_nom, sum(ville_population_1999) as pop from villes,departements 
            where villes.ville_departement_id =departements.departement_id
            group by departement_nom;");
        $requete->execute();

        $lesRegions = array();
        while ($reponse = $requete->fetch(PDO::FETCH_ASSOC)) {
            array_push($lesRegions, array(
               "name" => $reponse['departement_nom'],
                "y" => $reponse['pop']
            ));
        }
        $requete->closeCursor();
        return $lesRegions;
    } catch (PDOException $exc) {
        print("Pb obtenirListeRegions :" . $exc->getMessage());
        die();
    }
    
}