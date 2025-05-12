function remplirTable(e)
{

    e.preventDefault();
    var nomDeLaVille = $("#ville").val();
    console.log("nom de la ville =" + nomDeLaVille);

    $.getJSON('../Controleurs/controleur_1.N.php',
            {commande: 'getDepartementsPourVille',
                nomVille: nomDeLaVille})
            .done(function (donnees, stat, xhr) {
                //detruire le datatable s'il existe déjà
                if ($.fn.dataTable.isDataTable('#deptVille')) {
                    $('#deptVille').DataTable().clear().destroy();
                }
                // création du datatable
                var table = $('#deptVille').DataTable(
                        {
                            "data": donnees,

                            "columns": [
                                {title: "Ville"},
                                {title: "Code postal"},
                                {title: "Departement"}
                            ],
                            "lengthMenu": [[5, 10, 15, 25, 50, 100, -1], [5, 10, 15, 25, 50, 100, "Tous"]],
                            "pageLength": 5,
                            "language": {
                                "lengthMenu": "Afficher _MENU_ lignes par page",
                                "info": "page _PAGE_ sur _PAGES_",
                                "infoEmpty": "pas de résultat",
                                "search": "Recherchez: ",
                                "paginate": {
                                    "first": "Premier ",
                                    "last": "Dernier ",
                                    "next": "Suivant ",
                                    "previous": "Précédent "
                                }
                            }
                        }
                );
                // Ajuster la largeur des colonnes
                table.columns.adjust().draw();
            })
            .fail(function (xhr, text, error) {
                console.log("param : " + JSON.stringify(xhr));
                console.log("status : " + text);
                console.log("error : " + error);
            })
}
$(document).ready(function () {
    console.log("Welcome");
    $('form').submit(remplirTable);

});


