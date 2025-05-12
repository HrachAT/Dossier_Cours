<?php

require_once __DIR__ . '/config.inc.php';

function connexionBdd() {
    try {
        $dsn = 'mysql:host=' . SERVEUR_BDD . ';dbname=' . NOM_DE_LA_BASE;
        $bdd = new PDO($dsn, LOGIN, MOT_DE_PASSE);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->exec("set names utf8");
        return $bdd;
    } catch (PDOException $ex) {
        echo ('</br>Erreur de connexion au serveur BDD : ' . $ex->getMessage());
        die();
    }
}

function obtenirListeUtilisateurs() {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->query('SELECT id, nom, prenom FROM users;');
        $requete->execute();

        $listeUtilisateurs = array();
        while ($reponse = $requete->fetch(PDO::FETCH_ASSOC)) {
            array_push($listeUtilisateurs, $reponse);
        }
        $requete->closeCursor();
        return $listeUtilisateurs;
    } catch (PDOException $exc) {
        print("<br/> Pb obtenirPersonnes :" . $exc->getMessage());
        die();
    }
}

function obtenirAdresse($id) {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("select adresse from users where id = :idU ;");
        $requete->bindParam(":idU", $id);
        $requete->execute() or die(print_r($requete->errorInfo()));
        if ($requete->rowCount() == 0) {
            $adresse = "pas d'adresse";
        } else {
            $adresse = $requete->fetchColumn();
        }
        $requete->closeCursor();
        return($adresse);
    } catch (PDOException $ex) {
        print "Erreur : " . $ex->getMessage() . "<br/>";
        die();
    }
}

function obtenirPrenom($id) {
    try {
        $bdd = connexionBdd();
        $requete = $bdd->prepare("select prenom from users where id = :idU ;");
        $requete->bindParam(":idU", $id);
        $requete->execute() or die(print_r($requete->errorInfo()));
        if ($requete->rowCount() == 0) {
            $prenom = "pas de prenom";
        } else {
            $prenom = $requete->fetchColumn();
        }
        $requete->closeCursor();
        return($prenom);
    } catch (PDOException $ex) {
        print "Erreur : " . $ex->getMessage() . "<br/>";
        die();
    }
}

function verifierLogin($log, $mdp) {
    try {
        $bdd = connexionBdd();

        // Vérifier si le login existe et récupérer le mot de passe
        $requete = $bdd->prepare("SELECT mdp FROM users WHERE login = :log;");
        $requete->bindParam(":log", $log);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC); // On récupère la ligne
        $requete->closeCursor();

        // Vérifier l'authentification
        $status = $result ? ($result['mdp'] === $mdp ? 'v' : 'o') : 'r';

        // Utilisation correcte du switch
        switch ($status) {
            case 'v':
                return 'v'; // Connexion réussie (vert)
            case 'o':
                return 'o'; // Login correct mais mauvais mot de passe (orange)
            case 'r':
                return 'r'; // Login incorrect (rouge)
        }
    } catch (Exception $exc) {
        print "Erreur : " . $exc->getMessage() . "<br/>";
        die();
    }
}
