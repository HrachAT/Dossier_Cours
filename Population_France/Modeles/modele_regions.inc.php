<?php

require_once __DIR__ . '/modele.inc.php';
function obtenirPopulationRegions2012()
{
     try {
        $bdd = connexionBdd();
        $requete = $bdd->query("select region_nom, sum(ville_population_2012) as pop from villes,departements,regions where villes.ville_departement_id =departements.departement_id
and departements.departement_region_id =regions.region_id group by region_nom;");
        $requete->execute();

        $lesRegions = array();
        while ($reponse = $requete->fetch(PDO::FETCH_ASSOC)) {
            array_push($lesRegions, array(
               "name" => $reponse['region_nom'],
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

function obtenirPopulationRegions2010()
{
     try {
        $bdd = connexionBdd();
        $requete = $bdd->query("select region_nom, sum(ville_population_2010) as pop from villes,departements,regions where villes.ville_departement_id =departements.departement_id
and departements.departement_region_id =regions.region_id group by region_nom;");
        $requete->execute();

        $lesRegions = array();
        while ($reponse = $requete->fetch(PDO::FETCH_ASSOC)) {
            array_push($lesRegions, array(
               "name" => $reponse['region_nom'],
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

function obtenirPopulationRegions1999()
{
     try {
        $bdd = connexionBdd();
        $requete = $bdd->query("select region_nom, sum(ville_population_1999) as pop from villes,departements,regions where villes.ville_departement_id =departements.departement_id
and departements.departement_region_id =regions.region_id group by region_nom;");
        $requete->execute();

        $lesRegions = array();
        while ($reponse = $requete->fetch(PDO::FETCH_ASSOC)) {
            array_push($lesRegions, array(
               "name" => $reponse['region_nom'],
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
