function afficherPopulationParRegion2012()
{
    $.getJSON('../Controleurs/controleur.php', 
	{ 'commande': 'getPopRegions2012' 
	})
            .done(function (donnees, stat, xhr) {
               console.log(donnees);
                const chart = Highcharts.chart('containerReg2012', {
                    chart: {
                        type: 'pie'//'column'  // bar, line, spline
                    },
                    title: {
                        text: 'population par regions 2012 '
                    },                   
                    series: [{
                            data : donnees
                        }]
                });
            })
            .fail(function (xhr, text, error) {
                console.log("param : " + JSON.stringify(xhr));               
            });
}

function afficherPopulationParRegion2010()
{
    $.getJSON('../Controleurs/controleur.php', 
	{ 'commande': 'getPopRegions2010' 
	})
            .done(function (donnees, stat, xhr) {
               console.log(donnees);
                const chart = Highcharts.chart('containerReg2010', {
                    chart: {
                        type: 'pie'//'column'  // bar, line, spline
                    },
                    title: {
                        text: 'population par regions 2010 '
                    },                   
                    series: [{
                            data : donnees
                        }]
                });
            })
            .fail(function (xhr, text, error) {
                console.log("param : " + JSON.stringify(xhr));               
            });
}

function afficherPopulationParRegion1999()
{
    $.getJSON('../Controleurs/controleur.php', 
	{ 'commande': 'getPopRegions1999' 
	})
            .done(function (donnees, stat, xhr) {
               console.log(donnees);
                const chart = Highcharts.chart('containerReg1999', {
                    chart: {
                        type: 'pie'//'column'  // bar, line, spline
                    },
                    title: {
                        text: 'population par regions 1999 '
                    },                   
                    series: [{
                            data : donnees
                        }]
                });
            })
            .fail(function (xhr, text, error) {
                console.log("param : " + JSON.stringify(xhr));               
            });
}

function afficherPopulationParDepartement2012()
{
    $.getJSON('../Controleurs/controleur.php', 
	{ 'commande': 'getPopDepartement2012' 
	})
            .done(function (donnees, stat, xhr) {
               console.log(donnees);
                const chart = Highcharts.chart('containerDep2012', {
                    chart: {
                        type: 'pie'//'column'  // bar, line, spline
                    },
                    title: {
                        text: 'population par departement 2012 '
                    },                   
                    series: [{
                            data : donnees
                        }]
                });
            })
            .fail(function (xhr, text, error) {
                console.log("param : " + JSON.stringify(xhr));               
            });
}


$(document).ready(function () {
    $("#popReg2012").click(afficherPopulationParRegion2012);
    $("#popReg2010").click(afficherPopulationParRegion2010);
    $("#popReg1999").click(afficherPopulationParRegion1999);
    $("#popDep2012").click(afficherPopulationParDepartement2012);
});
