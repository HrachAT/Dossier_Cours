<?php

require_once __DIR__ . '/config.inc.php';

function connecterBdd() {
    try {
        $pdoOptions = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $bdd = new PDO('mysql:host=' . SERVBD . ';dbname=' . BASE, LOG, MDP, $pdoOptions);
        $bdd->exec("set names utf8");
        return $bdd;
    } catch (PDOException $e) {
        print "Erreur connexion bdd: " . $e->getMessage();
        die();
    }
}

function afficherPersonnes() {
    try {

        $pdo = connecterBdd();
        $requeteFr = $pdo->query("set lc_time_names='fr_FR';");
        $requete = $pdo->query("select nom, prenom, "
                . "DATE_FORMAT(dateNaissance,'%d %M %Y') as dateNaissance "
                . ",ville_nom, departement_nom, region_nom "
                . "from utilisateurs, villes, departements, regions "
                . " where "
                . " utilisateurs.ville_id=villes.ville_id and "
                . " villes.ville_departement_id=departements.departement_id and "
                . "departements.departement_region_id=regions.region_id");

        // Entête du tableau
        echo "<table class='table table-bordered table-striped w-auto text-center'>\n";
        echo "<thead><tr>"
        . "<th>Nom</th>"
        . "<th>Prénom</th>"
        . "<th>Date de naissance</th>"
        . "<th>Ville</th>"
        . "<th>Département</th>"
        . "<th>Régions</th>"
        . "</tr></thead>";
        echo "<tbody>";
        // Pour chaque ligne de résultat, affichage dans le tableau HTML
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td> {$ligne['nom']}</td>";
            echo "<td> {$ligne['prenom']}</td>";
            echo "<td> {$ligne['dateNaissance']}</td>";
            echo "<td> {$ligne['ville_nom']}</td>";
            echo "<td> {$ligne['departement_nom']}</td>";
            echo "<td> {$ligne['region_nom']}</td>";
            echo "</tr>\n";
        }
        $requete->closeCursor();
        echo "</tbody>";
        // Fin du tableau et du HTML
        echo "</table>\n";
    } catch (PDOException $excep) {
        print "La connexion a échoué : " . $excep->getMessage() . "<br>";
        die();
    }
}

function afficherVillesFromCp($codePostal) {
    try {

        $pdo = connecterBdd();

        $requete = $pdo->prepare("select ville_nom "
                . "from villes "
                . "where ville_code_postal like :monCodePostal ;");
        $codeJoker = "%" . $codePostal . "%";
        $requete->bindParam(":monCodePostal", $codeJoker);
        $requete->execute();

        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {

            echo "{$ligne['ville_nom']}<br>";
        }
        $requete->closeCursor();
    } catch (PDOException $excep) {
        print "La connexion a échoué : " . $excep->getMessage() . "<br>";
        die();
    }
}

function afficherCompteVillesFromCp($codePostal) {
    try {

        $pdo = connecterBdd();

        $requete = $pdo->prepare("select count(ville_nom) as nbVilles "
                . "from villes "
                . "where ville_code_postal like :monCodePostal ;");
        $codeJoker = "%" . $codePostal . "%";
        $requete->bindParam(":monCodePostal", $codeJoker);
        $requete->execute();

        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {

            echo "{$ligne['nbVilles']}<br>";
        }
        $requete->closeCursor();
    } catch (PDOException $excep) {
        print "La connexion a échoué : " . $excep->getMessage() . "<br>";
        die();
    }
}

function afficherNombreCommuneParDepartement() {
    try {

        $pdo = connecterBdd();
        $requete = $pdo->query("select "
                . " count(ville_nom) as nbVilles, departement_nom   "
                . " from villes, departements "
                . " where "
                . " villes.ville_departement_id=departements.departement_id "
                . " group by departement_nom;");

        // Entête du tableau
        echo "<table class='table table-bordered table-striped w-auto text-center'>\n";
        echo "<thead><tr>"
        . "<th>Département</th>"
        . "<th>Nombre de villes</th>"
        . "</tr></thead>";
        echo "<tbody>";
        // Pour chaque ligne de résultat, affichage dans le tableau HTML
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td> {$ligne['departement_nom']}</td>";
            echo "<td> {$ligne['nbVilles']}</td>";
            echo "</tr>\n";
        }
        $requete->closeCursor();
        echo "</tbody>";
        // Fin du tableau et du HTML
        echo "</table>\n";
    } catch (PDOException $excep) {
        print "La connexion a échoué : " . $excep->getMessage() . "<br>";
        die();
    }
}

function genererListePersonnes() {
    try {

        $pdo = connecterBdd();
        $requete = $pdo->query("select nom, prenom, utilisateurs_id from utilisateurs");

        // Entête du tableau
        echo "<select name='user'>";
        echo "<option value='-1'>Selectionner un utilisateur</option>";

        // Pour chaque ligne de résultat, affichage dans le tableau HTML
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value=\"{$ligne['utilisateur_id']}>" . "{$ligne['nom']} {$ligne['prenom']}" . "<\option>";
        }
    } catch (PDOException $excep) {
        print "La connexion a échoué : " . $excep->getMessage() . "<br>";
        die();
    }
}

function mettreAJourDateDeNaissance($id,$nouvelleDateDeNaissance){
    try {

        $pdo = connecterBdd();

        $requete = $pdo->prepare("update utilisateurs"
                . "set dateNaissance = :nouvelleDate"
                . "where utilisateur_id = :id;");
        $requete->bindParam(":nouvelleDate",$nouvelleDateDeNaissance);
        $requete->bindParam(":id",$id);
        $requete->execute();

    } catch (PDOException $excep) {
        print "La connexion a échoué : " . $excep->getMessage() . "<br>";
        die();
    }
}
