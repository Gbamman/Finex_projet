app.controller('dashbordCtrl', function($scope, $rootScope, ActionSurMenue, $routeParams, $location, toaster, Data, Data2, $modal, $filter, $q) {
    ReadyDashboard.init();
    var tableau1;
    var tableauValeur = [];
    $scope.annee = $filter('date')(new Date(), "yyyy");
    $scope.countTo = 100;
    $scope.countFrom = 0;
    $scope.countFrom = Math.ceil(Math.random() * 300);
    $scope.countTo = Math.ceil($scope.contrat * 7000) - Math.ceil($scope.contrat * 600);
    $scope.countToCapi = Math.ceil($scope.capitaux * 8000) - Math.ceil($scope.capitaux * 600);
    $scope.countToPrimes = Math.ceil($scope.primes * 7000) - Math.ceil($scope.primes * 600);
    /*		function doQuery(type) {
    var d = $q.defer();
    var result = Account.query({ type: type }, function() {
    d.resolve(result);
    });


    var result = Data2.get(type);
    return d.promise;
    }

    $q.all([
    doQuery('billing'),
    doQuery('shipping')
    ]).then(function(data) {
    var billingAccounts = data[0];
    var shippingAccounts = data[1];

    //TODO: something...
    });*/
    //Histogramme
    Data2.get('getAgregatYear').then(function(resultagregat) {
        if (resultagregat.status == 'success') {
            $scope.contrat = resultagregat.data[0].nombretotaledecontrat;
            $scope.capitaux = resultagregat.data[0].capitalTotale;
            $scope.primes = resultagregat.data[0].totaleprimeassurance;

        }

    })

    Data.get('getCountUsers').then(function(resultUsers) {
        if (resultUsers.status == 'success') {
            $scope.utilisateurs = resultUsers.data[0].NombreUtilisateurs;
        }

    })

    Data2.get('getContratAlerte').then(function(resultContratAlerte) {
        if (resultContratAlerte.status == 'success') {
            $scope.contratsalerte = _.where(resultContratAlerte.data, {
                iduser: parseInt($rootScope.uid)
            });
            //$scope.contratsalerte=resultContratAlerte.data;

            $scope.currentPage = 1; //current page
            $scope.entryLimit = 5; //max no of items to display in a page
            $scope.filteredItems = $scope.contratsalerte.length; //Initially for no filter  
            $scope.totalItems = $scope.contratsalerte.length;
        }
        // console.log('Resultat des contrats en Alerte',$scope.contratsalerte);

    })
    var first = Data2.get('getCountdashbord'),
        second = Data2.get('getCountContrat/3'),
        third = Data2.get('getCountContrat/5');

    $q.all([first, second, third]).then(function(result) {
        var tmp = [];
        var intervalle = 1;
        var mois = 1;
        var moisCourant = 0;
        angular.forEach(result, function(response) {
            var moisTotal = [
                [0, 0],
                [1, 0],
                [2, 0],
                [3, 0],
                [4, 0],
                [5, 0],
                [6, 0],
                [7, 0],
                [8, 0],
                [9, 0],
                [10, 0],
                [11, 0],
                [12, 0]
            ];
            // console.log(response.data);
            var tableauValeur = [];


            for (var i = 0; i < response.data.length; i++) {
                var moisProduction = response.data[i].moisProduction;
                var nombreDeContratParmois = response.data[i].nombreDeContratParmois;
                // console.log(mois+'ET****'+intervalle+'Et*****'+response.data[i].moisProduction);
                moisCourant = moisProduction;
                moisTotal[moisCourant][1] = nombreDeContratParmois
                mois = parseInt(4 * (moisCourant - 1) + intervalle);
                moisTotal[moisCourant][0] = mois;
                // console.log(moisTotal[moisCourant]);
                //moisTotal.indexOf(moisCourant).[1]=response.data[i].nombreDeContratParmois;

                //mois=parseInt(mois+4);


            };
            intervalle++;
            mois = intervalle;
            tmp.push(moisTotal);
        });

        return tmp;
    }).then(function(tmpResult) {
        $scope.combinedResult = tmpResult;
        // console.log('Restats combinés',tmpResult);
        ReadyHistogrammeFunction(tmpResult);
    });

    //GRAPHE 
    var firstGraphe = Data2.get('getCapitauxContratYear');
    $q.all([firstGraphe]).then(function(result) {
        var tmp = [];
        var intervalle = 1;
        var mois = 1;
        var moisCourant = 0;
        angular.forEach(result, function(response) {
            var moisTotal = [
                [0, 0],
                [1, 0],
                [2, 0],
                [3, 0],
                [4, 0],
                [5, 0],
                [6, 0],
                [7, 0],
                [8, 0],
                [9, 0],
                [10, 0],
                [11, 0],
                [12, 0]
            ];
            // console.log(response.data);
            var tableauValeur = [];


            for (var i = 0; i < response.data.length; i++) {
                var moisProduction = response.data[i].moisProduction;
                var nombreDeContratParmois = response.data[i].capitalCalcule;
                // console.log(mois+'ET****'+intervalle+'Et*****'+response.data[i].moisProduction);
                moisCourant = moisProduction;
                moisTotal[moisCourant][1] = nombreDeContratParmois
                mois = parseInt(4 * (moisCourant - 1) + intervalle);
                //moisTotal[moisCourant][0]=mois;
                // console.log(moisTotal[moisCourant]);
                //moisTotal.indexOf(moisCourant).[1]=response.data[i].nombreDeContratParmois;

                //mois=parseInt(mois+4);


            };
            intervalle++;
            mois = intervalle;
            tmp.push(moisTotal);
        });

        return tmp;
    }).then(function(tmpResult) {
        $scope.combinedResult = tmpResult;
        // console.log('Restats des Graphes',tmpResult);
        var couleur = '#454e59';
        ReadyDashboardFunction(tmpResult, couleur);
    });
    // Primes
    var secondGraphe = Data2.get('getPrimesContratYear');
    $q.all([secondGraphe]).then(function(result) {
        var tmp = [];
        var intervalle = 1;
        var mois = 1;
        var moisCourant = 0;
        angular.forEach(result, function(response) {
            var moisTotal = [
                [0, 0],
                [1, 0],
                [2, 0],
                [3, 0],
                [4, 0],
                [5, 0],
                [6, 0],
                [7, 0],
                [8, 0],
                [9, 0],
                [10, 0],
                [11, 0],
                [12, 0]
            ];
            // console.log(response.data);
            var tableauValeur = [];


            for (var i = 0; i < response.data.length; i++) {
                var moisProduction = response.data[i].moisProduction;
                var nombreDeContratParmois = response.data[i].capitalCalcule;
                // console.log(mois+'ET****'+intervalle+'Et*****'+response.data[i].moisProduction);
                moisCourant = moisProduction;
                moisTotal[moisCourant][1] = nombreDeContratParmois
                mois = parseInt(4 * (moisCourant - 1) + intervalle);
                //moisTotal[moisCourant][0]=mois;
                // console.log(moisTotal[moisCourant]);
                //moisTotal.indexOf(moisCourant).[1]=response.data[i].nombreDeContratParmois;

                //mois=parseInt(mois+4);


            };
            intervalle++;
            mois = intervalle;
            tmp.push(moisTotal);
        });

        return tmp;
    }).then(function(tmpResult) {
        $scope.combinedResult = tmpResult;
        // console.log('Restats des Graphes',tmpResult);
        var couleur = '#1ABC9C';
        ReadyDashboardFunction1(tmpResult, couleur);
    });

    function ReadyHistogrammeFunction(getCountdashbord) {

        var tableauValeurFirst = [];
        var tableauValeurSecond = [];
        var tableauValeurThird = [];
        // Get the element where we will attach the chart
        var chartClassicDash = $('#chart-classic-dash');
        var chartBars = $('#chart-bars');

        // Data for the chart
        var dataEarnings = getCountdashbord[0]; /*[[1, 1900], [2, 2300], [3, 3200], [4, 2500], [5, 4200], [6, 3100], [7, 3600], [8, 2500], [9, 4600], [10, 3700], [11, 4200], [12, 5200]];*/
        var dataSales = getCountdashbord[1]; //[[1, 8], [2, 7], [3, 1], [4, 9], [5, 10], [6, 1], [7, 3], [8, 9], [9, 8], [10, 7], [11, 9], [12, 9]];
        var dataTickets = getCountdashbord[2]; //[[1, 1], [2, 3], [3, 2], [4, 3], [5, 1], [6, 2], [7, 2], [8, 3], [9, 2], [10, 3], [11, 5], [12, 4]];

        var dataMonths = [
            [1, 'Jan'],
            [2, 'Fev'],
            [3, 'Mar'],
            [4, 'Avr'],
            [5, 'Mai'],
            [6, 'Jun'],
            [7, 'Jul'],
            [8, 'Aou'],
            [9, 'Sep'],
            [10, 'Oct'],
            [11, 'Nov'],
            [12, 'Dec']
        ];
        //var dataMonthsBars  = [[1, 'Jan'], [4, 'Feb'], [8, 'Mar'], [11, 'Avr'], [14, 'Mai'], [17, 'Jun'], [20, 'Jul'], [23, 'Aou'], [27, 'Sep'], [30, 'Oct'], [33, 'Nov'], [36, 'Dec']];
        var dataMonthsBars = [
            [2, 'Jan'],
            [6, 'Feb'],
            [10, 'Mar'],
            [14, 'Avr'],
            [18, 'Mai'],
            [22, 'Jun'],
            [26, 'Jul'],
            [30, 'Aou'],
            [34, 'Sep'],
            [38, 'Oct'],
            [42, 'Nov'],
            [46, 'Dec']
        ];


        $.plot(chartBars, [{
                label: 'Total',
                data: dataEarnings,
                bars: {
                    show: true,
                    lineWidth: 0,
                    fillColor: {
                        colors: [{
                            opacity: .6
                        }, {
                            opacity: .6
                        }]
                    }
                }
            },
            {
                label: 'En cours',
                data: dataSales,
                bars: {
                    show: true,
                    lineWidth: 0,
                    fillColor: {
                        colors: [{
                            opacity: .6
                        }, {
                            opacity: .6
                        }]
                    }
                }
            },
            {
                label: 'En proposition',
                data: dataTickets,
                bars: {
                    show: true,
                    lineWidth: 0,
                    fillColor: {
                        colors: [{
                            opacity: .6
                        }, {
                            opacity: .6
                        }]
                    }
                }
            }
        ], {
            colors: ['#5ccdde', '#454e59', '#6cc999'],
            legend: {
                show: true,
                position: 'nw',
                backgroundOpacity: 0
            },
            grid: {
                borderWidth: 0
            },
            yaxis: {
                ticks: 3,
                tickColor: '#f5f5f5'
            },
            xaxis: {
                ticks: dataMonthsBars,
                tickColor: '#f5f5f5'
            }
        });
    };

    // Fonction pour construire le Graphe
    function ReadyDashboardFunction(getCountdashbord, couleur) {
        // console.log(couleur);
        var tableauValeurFirst = [];
        var tableauValeurSecond = [];
        var tableauValeurThird = [];
        // Get the element where we will attach the chart
        var chartClassicDash = $('#chart-classic-dash');
        var chartBars = $('#chart-bars');

        // Data for the chart
        var dataEarnings = getCountdashbord[0]; /*[[1, 1900], [2, 2300], [3, 3200], [4, 2500], [5, 4200], [6, 3100], [7, 3600], [8, 2500], [9, 4600], [10, 3700], [11, 4200], [12, 5200]];*/
        var dataSales = getCountdashbord[1]; //[[1, 8], [2, 7], [3, 1], [4, 9], [5, 10], [6, 1], [7, 3], [8, 9], [9, 8], [10, 7], [11, 9], [12, 9]];
        //var dataTickets         = getCountdashbord[2];//[[1, 1], [2, 3], [3, 2], [4, 3], [5, 1], [6, 2], [7, 2], [8, 3], [9, 2], [10, 3], [11, 5], [12, 4]];
        var dataMonths = [
            [1, 'Jan'],
            [2, 'Fev'],
            [3, 'Mar'],
            [4, 'Avr'],
            [5, 'Mai'],
            [6, 'Jun'],
            [7, 'Jul'],
            [8, 'Aou'],
            [9, 'Sep'],
            [10, 'Oct'],
            [11, 'Nov'],
            [12, 'Dec']
        ];


        // Classic Chart
        $.plot(chartClassicDash, [{
                label: 'Primes émises',
                data: dataEarnings,
                lines: {
                    show: true,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: .6
                        }, {
                            opacity: .6
                        }]
                    }
                },
                points: {
                    show: true,
                    radius: 5
                }
            },
            {
                label: 'Capitaux',
                data: dataSales,
                lines: {
                    show: true,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: .6
                        }, {
                            opacity: .6
                        }]
                    }
                },
                points: {
                    show: true,
                    radius: 5
                }
            }
        ], {
            colors: ['#5ccdde', couleur, '#ffffff'],
            legend: {
                show: true,
                position: 'nw',
                backgroundOpacity: 0
            },
            grid: {
                borderWidth: 0,
                hoverable: true,
                clickable: true
            },
            yaxis: {
                show: false,
                tickColor: '#f5f5f5',
                ticks: 3
            },
            xaxis: {
                ticks: dataMonths,
                tickColor: '#f9f9f9'
            }
        });

        // Creating and attaching a tooltip to the classic chart
        var previousPoint = null,
            ttlabel = null;
        chartClassicDash.bind('plothover', function(event, pos, item) {

            if (item) {
                if (previousPoint !== item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $('#chart-tooltip').remove();
                    var x = item.datapoint[0],
                        y = item.datapoint[1];

                    if (item.seriesIndex === 0) {
                        ttlabel = 'Primes émises <strong>' + y + '</strong>';
                    } else if (item.seriesIndex === 1) {
                        ttlabel = '<strong>' + y + '</strong> Contrats en proposition';
                    } else {
                        ttlabel = '<strong>' + y + '</strong> Contrats en cours';
                    }

                    $('<div id="chart-tooltip" class="chart-tooltip">' + ttlabel + '</div>')
                        .css({
                            top: item.pageY - 45,
                            left: item.pageX + 5
                        }).appendTo("body").show();
                }
            } else {
                $('#chart-tooltip').remove();
                previousPoint = null;
            }
        });
    }
    // Fonction pour construire le Graphe
    function ReadyDashboardFunction1(getCountdashbord, couleur) {
        // console.log(couleur);
        var tableauValeurFirst = [];
        var tableauValeurSecond = [];
        var tableauValeurThird = [];
        // Get the element where we will attach the chart
        var chartClassicDash = $('#chart-classic-prime');
        var chartBars = $('#chart-bars');

        // Data for the chart
        var dataEarnings = getCountdashbord[0]; /*[[1, 1900], [2, 2300], [3, 3200], [4, 2500], [5, 4200], [6, 3100], [7, 3600], [8, 2500], [9, 4600], [10, 3700], [11, 4200], [12, 5200]];*/
        var dataSales = getCountdashbord[1]; //[[1, 8], [2, 7], [3, 1], [4, 9], [5, 10], [6, 1], [7, 3], [8, 9], [9, 8], [10, 7], [11, 9], [12, 9]];
        //var dataTickets         = getCountdashbord[2];//[[1, 1], [2, 3], [3, 2], [4, 3], [5, 1], [6, 2], [7, 2], [8, 3], [9, 2], [10, 3], [11, 5], [12, 4]];
        var dataMonths = [
            [1, 'Jan'],
            [2, 'Fev'],
            [3, 'Mar'],
            [4, 'Avr'],
            [5, 'Mai'],
            [6, 'Jun'],
            [7, 'Jul'],
            [8, 'Aou'],
            [9, 'Sep'],
            [10, 'Oct'],
            [11, 'Nov'],
            [12, 'Dec']
        ];


        // Classic Chart
        $.plot(chartClassicDash, [{
                label: 'contrats en capitaux',
                data: dataEarnings,
                lines: {
                    show: true,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: .6
                        }, {
                            opacity: .6
                        }]
                    }
                },
                points: {
                    show: true,
                    radius: 5
                }
            },
            {
                label: 'contrats en primes',
                data: dataSales,
                lines: {
                    show: true,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: .6
                        }, {
                            opacity: .6
                        }]
                    }
                },
                points: {
                    show: true,
                    radius: 5
                }
            }
        ], {
            colors: ['#454e59', couleur, '#ffffff'],
            legend: {
                show: true,
                position: 'nw',
                backgroundOpacity: 0
            },
            grid: {
                borderWidth: 0,
                hoverable: true,
                clickable: true
            },
            yaxis: {
                show: false,
                tickColor: '#f5f5f5',
                ticks: 3
            },
            xaxis: {
                ticks: dataMonths,
                tickColor: '#f9f9f9'
            }
        });

        // Creating and attaching a tooltip to the classic chart
        var previousPoint = null,
            ttlabel = null;
        chartClassicDash.bind('plothover', function(event, pos, item) {

            if (item) {
                if (previousPoint !== item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $('#chart-tooltip').remove();
                    var x = item.datapoint[0],
                        y = item.datapoint[1];

                    if (item.seriesIndex === 0) {
                        ttlabel = 'Capitaux : <strong>' + y + '</strong>';
                    } else if (item.seriesIndex === 1) {
                        ttlabel = '<strong>' + y + '</strong> Contrats en proposition';
                    } else {
                        ttlabel = '<strong>' + y + '</strong> Contrats en cours';
                    }

                    $('<div id="chart-tooltip" class="chart-tooltip">' + ttlabel + '</div>')
                        .css({
                            top: item.pageY - 45,
                            left: item.pageX + 5
                        }).appendTo("body").show();
                }
            } else {
                $('#chart-tooltip').remove();
                previousPoint = null;
            }
        });
    }

})