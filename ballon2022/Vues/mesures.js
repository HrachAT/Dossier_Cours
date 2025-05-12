
function afficherAltitudeTemps()
{

    $.getJSON('../Controleurs/controleur.php',
            {'commande': 'getTpsAlt'                
            })
            .done(function (donnees, stat, xhr) {
                var categories = donnees.categories;

                var tabSerie = donnees.series;
                const chart = Highcharts.chart('container', {
                    chart: {
                        type: 'spline'  // bar, line, spline
                    },
                    title: {
                        text: 'Evolution altitude dans le temps'
                    },
                    xAxis: {
                        categories: categories
                    },
                    yAxis: {
                        title: {
                            text: 'Altitude'
                        }
                    },
                    series: tabSerie
                });
            })
            .fail(function (xhr, text, error) {
                console.log("param : " + JSON.stringify(xhr));
            });

}

function afficherAltitudePressionTemps() {
    $.getJSON('../Controleurs/controleur.php',
        { 'commande': 'getTpsAltPres' })
        .done(function (donnees, stat, xhr) {
            var categories = donnees.categories;
            var tabSerie = donnees.series;

            const chart = Highcharts.chart('container', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'Évolution de l’altitude et de la pression dans le temps'
                },
                xAxis: {
                    categories: categories
                },
                yAxis: [
                    { // Axe Y pour l'altitude
                        title: {
                            text: 'Altitude (m)'
                        }
                    },
                    { // Axe Y pour la pression (ajouté)
                        title: {
                            text: 'Pression (hPa)'
                        },
                        opposite: true // Place l'axe de l'autre côté
                    }
                ],
                series: [
                    {
                        name: 'Altitude',
                        data: tabSerie[0].data,
                        yAxis: 0 // Associe à l'axe de gauche (altitude)
                    },
                    {
                        name: 'Pression',
                        data: tabSerie[1].data,
                        yAxis: 1 // Associe à l'axe de droite (pression)
                    }
                ]
            });
        })
        .fail(function (xhr, text, error) {
            console.log("Erreur : " + JSON.stringify(xhr));
        });
}

function afficherTemperatureTemps()
{

    $.getJSON('../Controleurs/controleur.php',
            {'commande': 'getTpsTemperature'                
            })
            .done(function (donnees, stat, xhr) {
                var categories = donnees.categories;

                var tabSerie = donnees.series;
                const chart = Highcharts.chart('container', {
                    chart: {
                        type: 'spline'  // bar, line, spline
                    },
                    title: {
                        text: 'Evolution Temperature dans le temps'
                    },
                    xAxis: {
                        categories: categories
                    },
                    yAxis: {
                        title: {
                            text: 'Temperature'
                        }
                    },
                    series: tabSerie
                });
            })
            .fail(function (xhr, text, error) {
                console.log("param : " + JSON.stringify(xhr));
            });

}

function afficherAltitudeTemperatureTemps() {
    $.getJSON('../Controleurs/controleur.php',
        { 'commande': 'getTpsAltTemperature' })
        .done(function (donnees, stat, xhr) {
            var categories = donnees.categories;
            var tabSerie = donnees.series;

            const chart = Highcharts.chart('container', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'Évolution de l’altitude et de la temperature dans le temps'
                },
                xAxis: {
                    categories: categories
                },
                yAxis: [
                    { // Axe Y pour l'altitude
                        title: {
                            text: 'Altitude (m)'
                        }
                    },
                    { // Axe Y pour la pression (ajouté)
                        title: {
                            text: 'Temperature (°C)'
                        },
                        opposite: true // Place l'axe de l'autre côté
                    }
                ],
                series: [
                    {
                        name: 'Altitude',
                        data: tabSerie[0].data,
                        yAxis: 0 // Associe à l'axe de gauche (altitude)
                    },
                    {
                        name: 'Temperature',
                        data: tabSerie[1].data,
                        yAxis: 1 // Associe à l'axe de droite (pression)
                    }
                ]
            });
        })
        .fail(function (xhr, text, error) {
            console.log("Erreur : " + JSON.stringify(xhr));
        });
}

function afficherTemperatureAltitudePressionTemps() {
    $.getJSON('../Controleurs/controleur.php',
        { 'commande': 'getTpsAltTemperaturePres' })
        .done(function (donnees, stat, xhr) {
            var categories = donnees.categories;
            var tabSerie = donnees.series;

            const chart = Highcharts.chart('container', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'Évolution de l’altitude, de pression et de la temperature dans le temps'
                },
                xAxis: {
                    categories: categories
                },
                yAxis: [
                    { // Axe Y pour l'altitude
                        title: {
                            text: 'Altitude (m)'
                        }
                    },
                    { // Axe Y pour la pression (ajouté)
                        title: {
                            text: 'Temperature (°C)'
                        }
                         // Place l'axe de l'autre côté
                    },
                    { // Axe Y pour la pression
                        title: {
                            text: 'Pression (hPa)'
                        },
                        opposite: true // Place l'axe de l'autre côté
                    }
                ],
                series: [
                    {
                        name: 'Altitude',
                        data: tabSerie[0].data,
                        yAxis: 0 // Associe à l'axe de gauche (altitude)
                    },
                    {
                        name: 'Temperature',
                        data: tabSerie[1].data,
                        yAxis: 1 // Associe à l'axe de droite (temperature)
                    },
                    {
                        name: 'Pression',
                        data: tabSerie[2].data,
                        yAxis: 2 // Associe à l'axe de gauche (pression)
                    }
                ]
            });
        })
        .fail(function (xhr, text, error) {
            console.log("Erreur : " + JSON.stringify(xhr));
        });
}

$(document).ready(function () {
    $("#tpsAlt").click( afficherAltitudeTemps);
    $("#tpsAltPres").click(afficherAltitudePressionTemps);
    $("#tpsTemperature").click(afficherTemperatureTemps);
    $("#tpsAltTemperature").click(afficherAltitudeTemperatureTemps);
    $("#tpsAltTemperaturePres").click(afficherTemperatureAltitudePressionTemps);
});

