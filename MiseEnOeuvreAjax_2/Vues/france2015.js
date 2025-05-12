function genererListeRegions() {

    // vider la liste des régions sauf la première ligne
    $("#regions").find('option').not(':first').remove();
    $.getJSON('../Controleurs/controleur_1.N.php',
            {
                'commande': 'getRegions'
            }
    )
            .done(function (donnees, stat, xhr) {
                // génération de la liste déroulante des utilisateurs               
                $.each(donnees, function (index, ligne) {
                    // ligne contient un objet json de la forme
                    // {"idRegion" : "id de la region"},
                    // {"nomRegion" : "nom de la region"}                 
                    $("#regions").append($('<option>', {value: ligne.region_id}).text(ligne.region_nom));
                });
            })
            .fail(function (xhr, text, error) {
                console.log("param : " + JSON.stringify(xhr));
                console.log("status : " + text);
                console.log("error : " + error);
            });
}

function genereListeDepartements()
{
    var idRegion = $(this).val(); // on récupère la valeur de la clef primaire correspondant à la région

    // vider la liste des départements sauf la première ligne
    $("#departements").find('option').not(':first').remove();
    // vider la liste des villes sauf la première ligne
    $("#villes").find('option').not(':first').remove();

    // si la region selectionné existe (pas le "choisissez une region")
    if (idRegion !== -1) {
        $.getJSON('../Controleurs/controleur_1.N.php',
                {
                    'commande': 'getDepartements',
                    'idRegion': idRegion
                }
        )
                .done(function (donnees, stat, xhr) {
                    // génération de la liste déroulante des utilisateurs
                    $.each(donnees, function (index, ligne) {
                        // ligne contient un objet json de la forme
                        // {"idDepartement" : "id du departement"},
                        // {"nomDepartement" : "nom du departement"}           
                        $("#departements").append($('<option>', {value: ligne.departement_id}).text(ligne.departement_nom));
                    });
                })
                .fail(function (xhr, text, error) {
                    console.log("param : " + JSON.stringify(xhr));
                    console.log("status : " + text);
                    console.log("error : " + error);
                });
    }

}

function genereListeVilles()
{
    var idDepartement = $(this).val(); // on récupère la valeur de la clef primaire correspondant au departement

    // vider la liste des villes sauf la première ligne
    $("#villes").find('option').not(':first').remove();

    // si la region selectionné existe (pas le "choisissez une region")
    if (idDepartement !== -1) {
        $.getJSON('../Controleurs/controleur_1.N.php',
                {
                    'commande': 'getVille',
                    'idDepartement': idDepartement
                }
        )
                .done(function (donnees, stat, xhr) {
                    // génération de la liste déroulante des utilisateurs
                    console.log(donnees);
                    $.each(donnees, function (index, ligne) {
                        // ligne contient un objet json de la forme
                        // {"idDepartement" : "id du departement"},
                        // {"nomDepartement" : "nom du departement"}           
                        $("#villes").append($('<option>', {value: ligne.ville_id}).text(ligne.ville_nom));
                    });
                })
                .fail(function (xhr, text, error) {
                    console.log("param : " + JSON.stringify(xhr));
                    console.log("status : " + text);
                    console.log("error : " + error);
                });
    }

}


$(document).ready(function ()
{
    // generation de la liste deroulante des regions
    genererListeRegions();

    // gestion du changement de region
    $("#regions").change(genereListeDepartements);

    // gestion du changement de departement
    $("#departements").change(genereListeVilles);

});