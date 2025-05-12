var lat = 48.852969;
var lon = 2.349903;
var maCarte = null;
var marqueur;
var marqueurDyna;
var cercle;
var polygone;
var groupe = new L.featureGroup();

function initCarte() {
    maCarte = L.map('carte').setView([lat, lon], 5);
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL    - rendu <a href="//openstreetmap.fr">OSM France</a>',
        minZoom: 1,
        maxZoom: 19
    }).addTo(maCarte);
}

function afficherAdresse()
{
    var idUser = $(this).val(); // on récupère la valeur de l'option de la liste
    $("#adresse").empty();  // vider la zone de texte
    if (idUser !== '-1') { // si l'utilisateur n'est pas le premier (choisissez....)

        /*$.getJSON('../Controleurs/controleur_1.1.php',
         {
         'commande': 'obtenirAdresse',
         'idUser': idUser
         }
         )
         .done(function (donnees, stat, xhr) {
         //$("#adresse").text(donnees.adresse);
         $("#adresse").text(donnees);
         
         })
         .fail(function (xhr, text, error) {
         console.log("param : " + JSON.stringify(xhr));
         console.log("status : " + text);
         console.log("error : " + error);
         });*/

        $.ajax({
            url: '../Controleurs/controleur_1.1.php',
            method: "POST",
            dataType: "json",
            data: {
                'commande': 'obtenirAdresse',
                'idUser': idUser
            },
            success: function (donnees, stats, xhr) {
                $("#adresse").text(donnees);
                ajouterMarqueur(donnees);
            },
            error: function (xhr, text, error) {
                console.log("param : " + JSON.stringify(xhr));
                console.log("status : " + text);
                console.log("error : " + error);
            }

        })
    }
}

function afficherPrenom()
{
    var idUser = $(this).val(); // on récupère la valeur de l'option de la liste
    $("#prenom").empty();  // vider la zone de texte
    if (idUser !== '-1') { // si l'utilisateur n'est pas le premier (choisissez....)

        /*$.getJSON('../Controleurs/controleur_1.1.php',
         {
         'commande': 'obtenirPrenom',
         'idUser': idUser
         }
         )
         .done(function (donnees, stat, xhr) {
         //$("#adresse").text(donnees.adresse);
         $("#prenom").text(donnees);
         
         })
         .fail(function (xhr, text, error) {
         console.log("param : " + JSON.stringify(xhr));
         console.log("status : " + text);
         console.log("error : " + error);
         });*/

        $.ajax({
            url: '../Controleurs/controleur_1.1.php',
            method: "POST",
            dataType: "json",
            data: {
                'commande': 'obtenirPrenom',
                'idUser': idUser
            },
            success: function (donnees, stats, xhr) {
                $("#prenom").text(donnees);
            },
            error: function (xhr, text, error) {
                console.log("param : " + JSON.stringify(xhr));
                console.log("status : " + text);
                console.log("error : " + error);
            }

        })
    }
}

function genererListeUser()
{
    /*$.getJSON('../Controleurs/controleur_1.1.php',
     {
     'commande': 'listeUtilisateurs'
     }
     )
     .done(function (donnees, stat, xhr) {
     // génération de la liste déroulante des utilisateurs
     $("#listeUtilisateur").append($('<option>', {value: -1}).text("Sélectionnez une personne"));
     $.each(donnees, function (index, ligne) {
     // ligne contient un objet json de la forme
     // {"id" : "id de la personne"},
     // {"nom" : "nom de la personne"}                        
     var utilisateur = ligne.nom + " " + ligne.prenom;
     $("#listeUtilisateur").append($('<option>', {value: ligne.id}).text(utilisateur));
     });
     })
     .fail(function (xhr, text, error) {
     console.log("param : " + JSON.stringify(xhr));
     console.log("status : " + text);
     console.log("error : " + error);
     });*/
    $.ajax({
        url: '../Controleurs/controleur_1.1.php',
        method: "POST",
        dataType: "json",
        data: {
            'commande': 'listeUtilisateurs',
        },
        success: function (donnees, stats, xhr) {
            $("#listeUtilisateur").append($('<option>', {value: -1}).text("Sélectionnez une personne"));
            $.each(donnees, function (index, ligne) {
                var utilisateur = ligne.nom + " " + ligne.prenom;
                $("#listeUtilisateur").append($('<option>', {value: ligne.id}).text(utilisateur));
            });
        },
        error: function (xhr, text, error) {
            console.log("param : " + JSON.stringify(xhr));
            console.log("status : " + text);
            console.log("error : " + error);
        }

    })
}

function ajouterMarqueur(adresse)
{		
	console.log(adresse);
	console.log(encodeURI(adresse));
	$.getJSON("https://api-adresse.data.gouv.fr/search/?q=" + adresse + "&limit=1")
		.done(function (resultat, status, xhr) {
			console.log(resultat.features[0].properties.city);
			var lonlat = resultat.features[0].geometry.coordinates;
			console.log(lonlat);
			marqueurDyna = L.marker([lonlat[1], lonlat[0]]).addTo(maCarte);
			marqueurDyna.bindPopup(resultat.features[0].properties.label);
			groupe.addLayer(marqueurDyna);
			maCarte.fitBounds(groupe.getBounds());

		})
		.fail(function (xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		});
}

function effacerMarqueurs() {
    groupe.clearLayers();
    maCarte.eachLayer(function (layer) {
        if (!(layer instanceof L.TileLayer)) { 
            maCarte.removeLayer(layer);
        }
    });
    maCarte.setView([46.2276, 2.2137], 5);
}

$(window).on('load', initCarte); 
$(document).ready(function ()
{
    //ajouterMarqueur("2 place washington, 72000 Le Mans");
    console.log("coucou");
    // génération de la liste déroulante aonclick="effacerMarqueurs"u chargement de la page
    genererListeUser();
    // gestion de la selection d'un nom
    $("#listeUtilisateur").change(afficherAdresse);
    $("#listeUtilisateur").change(afficherPrenom);
    $("#effacerMarqueurs").click(effacerMarqueurs);
});
