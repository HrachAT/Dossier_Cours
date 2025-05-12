function afficherGraphAjax() {
    $.getJSON('../Controleurs/controleur.php',
            {
                action: 'getConsommation',
                idUser: 2
            })
            .done(function (donnees, stat, xhr) {
                var categories = donnees.categories;
                var serie = donnees.series;
                const chart = Highcharts.chart('graphe',
                        {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Consommation de fruits'
                            },
                            xAxis: {
                                categories: categories
                            },
                            yAxis: {
                                title: 'Quantité'
                            },
                            series: serie
                        });
            })
            .fail(function (xhr, text, error) {
                console.log("param : " + JSON.stringify(xhr));
            });
}

$(document).ready(function () {
    $('#menu').load('menu.html');
    afficherGraphAjax();
});
