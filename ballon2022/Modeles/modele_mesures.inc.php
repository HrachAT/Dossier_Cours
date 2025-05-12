<?php

require_once __DIR__ . '/modele.inc.php';

function obtenirEvolutionAltitudeTemps()
{
    try {
        $bdd = connexionBdd();
        $tabSeries = array();
        $tabCategories = array();
        
        $requete = $bdd->query("SELECT datetime, altitude FROM mesures ORDER BY datetime;");
        
        $data = array();
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $tabCategories[] = $ligne['datetime'];
            $data[] = floatval($ligne['altitude']);
        }
        
        $requete->closeCursor();
        
        $tabSeries[] = array(
            "name" => "Altitude",
            "data" => $data
        );
        
        return array("categories" => $tabCategories, "series" => $tabSeries);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}


function obtenirEvolutionAltitudePressionTemps()
{
    try {
        $bdd = connexionBdd();
        $tabCategories = array();
        $altitudeData = array();
        $pressionData = array();
        
        $requete = $bdd->query("SELECT datetime, altitude, pression FROM mesures ORDER BY datetime;");
        
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $tabCategories[] = $ligne['datetime'];
            $altitudeData[] = floatval($ligne['altitude']);
            $pressionData[] = floatval($ligne['pression']);
        }
        
        $requete->closeCursor();
        
        $tabSeries = array(
            array("name" => "Altitude", "data" => $altitudeData, "yAxis" => 0),
            array("name" => "Pression", "data" => $pressionData, "yAxis" => 1)
        );
        
        return array("categories" => $tabCategories, "series" => $tabSeries);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function obtenirEvolutionTemperatureTemps()
{
    try {
        $bdd = connexionBdd();
        $tabSeries = array();
        $tabCategories = array();
        
        $requete = $bdd->query("SELECT datetime, temperature FROM mesures ORDER BY datetime;");
        
        $data = array();
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $tabCategories[] = $ligne['datetime'];
            $data[] = floatval($ligne['temperature']);
        }
        
        $requete->closeCursor();
        
        $tabSeries[] = array(
            "name" => "temperature",
            "data" => $data
        );
        
        return array("categories" => $tabCategories, "series" => $tabSeries);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function obtenirEvolutionAltitudeTemperatureTemps()
{
    try {
        $bdd = connexionBdd();
        $tabCategories = array();
        $altitudeData = array();
        $pressionData = array();
        
        $requete = $bdd->query("SELECT datetime, altitude, temperature FROM mesures ORDER BY datetime;");
        
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $tabCategories[] = $ligne['datetime'];
            $altitudeData[] = floatval($ligne['altitude']);
            $pressionData[] = floatval($ligne['temperature']);
        }
        
        $requete->closeCursor();
        
        $tabSeries = array(
            array("name" => "Altitude", "data" => $altitudeData, "yAxis" => 0),
            array("name" => "temperature", "data" => $pressionData, "yAxis" => 1)
        );
        
        return array("categories" => $tabCategories, "series" => $tabSeries);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function obtenirEvolutionAltitudePressionTemperatureTemps()
{
    try {
        $bdd = connexionBdd();
        $tabCategories = array();
        $altitudeData = array();
        $pressionData = array();
        $temperatureData = array();
        
        $requete = $bdd->query("SELECT datetime, altitude, pression, temperature FROM mesures ORDER BY datetime;");
        
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $tabCategories[] = $ligne['datetime'];
            $altitudeData[] = floatval($ligne['altitude']);
            $pressionData[] = floatval($ligne['pression']);
            $temperatureData[] = floatval($ligne['temperature']);
        }
        
        $requete->closeCursor();
        
        $tabSeries = array(
            array("name" => "Altitude", "data" => $altitudeData, "yAxis" => 0),
            array("name" => "Temperature", "data" => $temperatureData, "yAxis" => 1),
            array("name" => "Pression", "data" => $pressionData, "yAxis" => 2)
        );
        
        return array("categories" => $tabCategories, "series" => $tabSeries);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
