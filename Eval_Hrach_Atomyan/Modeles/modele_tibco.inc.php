<?php

require_once __DIR__ . '/config.inc.php';

function connexionBdd() {
    try {
        $pdoOptions = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $bdd = new PDO('mysql:host=' . SERVEURBD . ';dbname=' . NOMDELABASE, LOGIN, MOTDEPASSE, $pdoOptions);
        $bdd->exec("set names utf8");
        return $bdd;
    } catch (PDOException $ex) {
        print "Erreur : " . $ex->getMessage() . "<br/>";
        die();
    }
}

function genererListeEntrepriseJson() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->query("select id, nom from clients");
        $tab = array();
        while ($ligne = $requete->fetch()) {
            array_push($tab, array('id' => $ligne['id'], 'nom' => $ligne['nom']));
        }
        $requete->closeCursor();
        return $tab;
    } catch (PDOException $ex) {
        print "Erreur : " . $ex->getMessage() . "<br/>";
        die();
    }
}

function getDataTableauSpareClient() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->query("select boites.id as idboit, boites.reference as bref, iots.reference as iref, spares.reference as sref, spares.nom_spare, clients.nom, sites.adresse,sites.cp, sites.ville
                               from boites,spares,iots,clients,client_sites,sites,boite_spare_clients
                               where clients.id=client_sites.id_client
                               and client_sites.id_site=sites.id
                               and sites.id=boite_spare_clients.id_site
                               and boites.id=boite_spare_clients.id_boite
                               and iots.id=boites.id_iot
                               and spares.id=boite_spare_clients.id_spare");
        $tab = array();
        while ($ligne = $requete->fetch()) {
            array_push($tab, array(
                'DT_RowId' => $ligne['idboit'],
                $ligne['bref'],
                $ligne['iref'],
                $ligne['sref'],
                $ligne['nom_spare'],
                $ligne['nom'],
                "{$ligne['adresse']} {$ligne['cp']} {$ligne['ville']}",
                '<img src="img/supp.png" alt="" height="20"/><img src="img/modif.png" alt=""  height="20"/>'
            ));
        }
        $requete->closeCursor();
        return $tab;
    } catch (PDOException $ex) {
        print "Erreur : " . $ex->getMessage() . "<br/>";
        die();
    }
}

function genererListeBoiteJson() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->query("SELECT boites.id,boites.reference,spares.nom_spare,spares.reference FROM boites, spares, boite_spare_clients WHERE boites.id = boite_spare_clients.id_boite AND spares.id = boite_spare_clients.id_spare AND boite_spare_clients.id_site IS NULL AND boites.id_iot IS NOT NULL ");
        $tab = array();
        while ($ligne = $requete->fetch()) {
            array_push($tab, array('id' => $ligne['id'], 'nom' => $ligne['nom']));
        }
        $requete->closeCursor();
        return $tab;
    } catch (PDOException $ex) {
        print "Erreur : " . $ex->getMessage() . "<br/>";
        die();
    }
}
