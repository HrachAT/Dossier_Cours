<?php
session_start();
//supprimer la variable session
if (isset($_SESSION['logok'])) {
    unset($_SESSION['logok']);
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Formulaire d'inscription</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/libs/jquery/jquery.min.js"></script>
        <script src="js/mesFonctions.js"></script>
    </head>
    <body>
        <div class="container">
            <form class="was-validated mt-5" action="php/traitement.php" method="POST">
                <div class="row" >
                    <fieldset id="civilite" class="col-sm-6 border border-dark rounded-3 p-3">
                        <legend class="float-none w-auto px-3">Civilité</legend>
                        <div class="mb-3">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom" required/>    
                        </div>
                        <div class="mb-3">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom" required/>    
                        </div>
                        <div class="mb-3">
                            <label for="ville">Ville</label>
                            <select name="code_postal" class="form-select" id="ville">
                                <option selected>Sélectionnez votre ville</option>
                                <option value="Le Mans">Le Mans</option>
                                <option value="La Flèche">La Flèche</option>
                                <option value="Sablé-sur-Sarthe">Sablé-sur-Sarthe</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mail">Adresse Email</label>
                            <input type="email" class="form-control" id="mail" name="email" placeholder="Votre adresse électronique" required/>    
                        </div>
                        <div class="mb-3">
                            <label for="site">Site Internet</label>
                            <input type="text" class="form-control" id="site" placeholder="L'adresse de votre site Internet"/>    
                        </div>
                        <div class="mb-3">
                            <label for="sexe">Sexe</label>
                            <div class="form-inline" id="sexe">
                                <label class="form-check-label">
                                    <input type="radio" name='lesexe' value="masculin" class="form-check-input me-2"/>Masculin &nbsp;    
                                </label>
                                <label class="form-check-label ms-3">
                                    <input type="radio" name='lesexe'  value="feminin" class="form-check-input me-2"/>Féminin    
                                </label>
                                <label class="form-check-label ms-3">
                                    <input type="radio" name='lesexe'  value="autre" class="form-check-input me-2" checked/>Ne souhaite pas le préciser    
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control" id="photo" placeholder="Aucun fichier sélectionné"/>           
                        </div>
                        <div class="form-check mb-3">
                            <label class="form-check-label" for="invalidCheck">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>       
                                J'accepte les conditions d'utilisation
                            </label>
                            <div class="invalid-feedback">
                                Vous devez accepter avant de valider
                            </div>
                        </div>
                    </fieldset>
                    <div class="col-sm-6">
                        <fieldset id="savoirs" class="border border-dark rounded-3 p-3">
                            <legend class="float-none w-auto px-3">Savoirs</legend>
                            <div class="row" id="se">
                                <div class="col-6">
                                    <label for="systeme">Système d'exploitation</label>
                                    <select name="OS" class="form-select" id="systeme">
                                        <option selected>Sélectionnez le système</option>
                                        <option value="win">Windows</option>
                                        <option value="lin">Linux</option>
                                        <option value="mac">Mac OSx</option>
                                    </select>
                                </div>                          
                                <div class="col-6">
                                    <label for="version">Version</label>
                                    <select name="version" class="form-select" id="version">
                                        <option selected>Sélectionnez la version</option>
                                    </select> 
                                </div>
                            </div>
                            <label class="mt-2">Langage de programmation</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="java" value="java" />
                                <label class="form-check-label">Java</label>                 
                            </div>
                            <div class="form-check">       
                                <input type="checkbox" class="form-check-input" id="c" value="C" />
                                <label class="form-check-label">C/C++</label>        
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="php" value="php" />
                                <label class="form-check-label">PHP</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="autre" value="autre"/>
                                <label class="form-check-label">autre</label>
                            </div>
                        </fieldset>    
                        <fieldset id="connexion" class="border border-dark rounded-3 p-3">
                            <legend class="float-none w-auto px-3">Paramètres de connexion</legend>
                            <div class="mb-3">
                                <label for="login">Login</label>
                                <input type="text" class="form-control" name="login" id="login" required pattern="^[a-zA-Z]+$" title="Que des lettres"/>    
                            </div>
                            <div class="mb-3">
                                <label for="mdp">Mot de passe</label>
                                <div class="input-group">                                       
                                    <input type="password" class="form-control" id="mdp" name="mdp" required pattern="^[a-zA-Z]+$" title="Que des lettres"/>    
                                    <span class="input-group-text oeilmdp" id="oeilmdp">&#128065;</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="confirme">Confirmation du mot de passe</label>
                                <div class="input-group">  
                                    <input type="password" class="form-control" id="confirme" name="confirme" required pattern="^[a-zA-Z]+$" title="Que des lettres"/> 
                                    <span class="input-group-text" id="oeilconfirme"> &#128065;</span>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="mt-5 float-end">
                    <button type="submit" class="btn btn-primary">Inscription</button>
                    <button type="reset" class="btn btn-warning">Effacer les informations de ce formulaire</button>
                </div>
            </form>
        </div>
    </body>
</html>
