/* client_spare.js */

function remplirTableauBoiteClient() {
    $.getJSON('../Controleurs/controleur.php',
            {
                /* a completer */
                "commande": "getBoitesSite"

            })
            .done(function (donnees, stat, xhr) {

                $('#tab_spare_client').DataTable({
                    /* a completer */
                    "data": donnees,
                    "lengthMenu": [[5, 10, 15, 25, 50, 100, -1], [5, 10, 15, 25, 50, 100, "Tous"]],
                    "pageLength": 5,
                    "language": {
                        "lengthMenu": "Afficher _MENU_ lignes par page",
                        "info": "page _PAGE_ sur _PAGES_",
                        "infoEmpty": "pas de résultat",
                        "search": "Recherchez: ",
                        "paginate": {
                            "first": "Premier",
                            "last": "Dernier",
                            "next": "Suivant",
                            "previous": "Précédent"
                        },
                    },
                    "order": [[5, "asc"]]
                });
            })
            .fail(function (xhr, text, error) {
                console.log("param : " + JSON.stringify(xhr));
                console.log("status : " + text);
                console.log("error : " + error);
            });
}

function remplirListeSite()
{
    var idClient = $(this).val();
    /* a completer */

    $.getJSON('../Controleurs/controleur.php',
            {

                /* a completer */
            })
            .done(function (donnees, stat, xhr) {

                /* a completer */
            })
            .fail(function (xhr, text, error) {
                console.log("param : " + JSON.stringify(xhr));
                console.log("status : " + text);
                console.log("error : " + error);
            });
}

function remplirListeBoitesDisponibles()
{
    /* a completer */
    $("#boite").find('option').not(':first').remove();
    $.getJSON('../Controleurs/controleur.php',
            {
                /* a completer */
                "commande": "getListeBoites"
            })
            .done(function (donnees, stat, xhr) {
                /* a completer */
                $("#boite").append($('<option>', {value: stat.id}).text(stat.nom));

            })
            .fail(function (xhr, text, error) {
                console.log("param : " + JSON.stringify(xhr));
                console.log("status : " + text);
                console.log("error : " + error);
            });
}

function remplirListeEntreprises()
{
    $("#ent").find('option').not(':first').remove();    // vider la liste des entreprises sauf la 1ere ligne
    $.getJSON('../Controleurs/controleur.php',
            {
                'commande': 'getListeClients'
            })
            .done(function (donnees, stat, xhr) {
                $.each(donnees, function (index, ligne) {
                    //remplissage de la liste deroulante des entreprises (#ent)
                    $("#ent").append($('<option>', {value: ligne.id}).text(ligne.nom));
                }
                );

            })
            .fail(function (xhr, text, error) {
                console.log("param : " + JSON.stringify(xhr));
                console.log("status : " + text);
                console.log("error : " + error);
            });
}

// ce qui est lance/implemtente a la fin du chargement de la page
$(document).ready(function () {


    remplirTableauBoiteClient();
    remplirListeEntreprises();
    remplirListeBoitesDisponibles();
    $("#ent").change(remplirListeSite);

});
