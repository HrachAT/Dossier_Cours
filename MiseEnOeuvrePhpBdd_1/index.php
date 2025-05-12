<!DOCTYPE html>
<html>
    <head>
        <title>TD2_PHP_PDO</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 

    </head>
    <body>
        <form action="PHP/traitement_user.php" method="get">
            <?php
            genererListePersonnes();
            ?>
            Nouvelle date de naissance : 
            <input type="date" name="ddn" required/>                
            <input type="submit"/><br>
            Nouveau utilisateur :
            <input type="text" name="nom" required/>
            <input type="text" name="prenom" required/>
            <input type="submit"/>
        </form>
        <div class="container pt-5">
            <h1>Liste des utilisateurs</h1>
            <?php
            require_once __DIR__ . '/PHP/france2015.inc.php';
            afficherPersonnes();
            afficherNombreCommuneParDepartement();
            ?>
        </div>
    </body>
</html>