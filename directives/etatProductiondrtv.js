app.directive('datePrestation', function($filter, $window, $parse, $timeout, toaster) {
    return {
        require: '?ngModel',
        restrict: 'A',
        compile: function() {
            var moment = $window.moment;
            var getter, setter;
            return function(scope, element, attrs, ngModel) {

                // If the ngModel directive is used, then set the initial value and keep it in sync 
                if (ngModel) {
                    element.on('blur', function(event) {
                        var datedebut = moment($filter('date')(scope.etatprestation.datedebut, "DD/MM/yyyy")).valueOf();
                        var datefin = moment($filter('date')(scope.etatprestation.datefin, "DD/MM/yyyy")).valueOf();
                        tabdeb = (scope.etatprestation.datedebut.split(/[- //]/));
                        tabfin = (scope.etatprestation.datefin.split(/[- //]/));
                        Odeb = new Date(tabdeb[2], parseInt(tabdeb[1] - 1), tabdeb[0]);
                        Ofin = new Date(tabfin[2], parseInt(tabdeb[1] - 1), tabfin[0]);

                        console.log('Date debut', Odeb);
                        console.log('Date fin', Ofin);
                        if (Odeb > Ofin) {
                            toaster.pop('Info', "Information", 'La date de fin ne doit pas être antérieure à la date du début.');
                            scope.etatprestation.datedebut = " ";
                            scope.etatprestation.datefin = " ";
                            return false
                        }

                    })
                }
            }
        }
    }
});



app.directive('verifPrime', function($filter, $rootScope, $window, $parse, $timeout, toaster, Data, $interpolate) {
    return {
        require: '?ngModel',
        restrict: 'A',
        compile: function() {
            var moment = $window.moment;
            var getter, setter;
            var verif = false;
            return function(scope, element, attrs, ngModel) {
                getter = $parse(attrs.ngModel);
                setter = getter.assign;
                // If the ngModel directive is used, then set the initial value and keep it in sync 
                if (ngModel) {
                    element.on('blur', function(event) {
                        var verif = ["2", "36"]
                        if (verif.indexOf(scope.idnomgroup) === -1) {
                            console.log(verif.indexOf(scope.idnomgroup));
                            scope.product.gestionCoassurance = false;
                            console.log(scope.product.gestionCoassurance);
                            if (scope.product.capital < 0) {
                                toaster.pop('error', "Attention", 'Vous n\'avez pas renseigné le capital pour ce contrat');
                            } else {
                                scope.product.capital = (!angular.isString(scope.product.capital)) ? scope.product.capital : scope.product.capital.replace(/ /g, '');
                                if (parseInt(scope.product.capital) > parseInt(scope.parametre[0].capitalmax)) {

                                    scope.product.capital = 0;
                                    scope.product.tauxprimes = 0;
                                    scope.product.primeassurance = 0;
                                    console.log(scope.idnomgroup);
                                    toaster.pop('error', "Attention", 'Capital ne peut excéder ' + scope.parametre[0].capitalmax + '. Veuillez contacter votre service bancassurance');
                                    element.css('background', 'pink');
                                } else {
                                    console.log(scope.product.capital);
                                    scope.product.capital = scope.product.capital;
                                    element.css('background', '#ffffff');
                                }
                            }

                            if (scope.product.duree <= 0) {
                                toaster.pop('error', "Attention", 'Vous n\'avez pas renseigné la duree pour ce contrat');

                            } else {


                            }

                            if (scope.product.differe < 0) {
                                toaster.pop('error', "Attention", 'Quel est le differé du contrat');


                            } else {


                            }


                            if (typeof scope.product.typepret == 'undefined') {
                                scope.product.idtypepret = 11;
                            } else {
                                scope.product.idtypepret = scope.product.typepret.idtypepret;
                            }

                            if (scope.product.tauxemprunt <= 0) {
                                toaster.pop('error', "Attention", 'Vous n\'avez pas renseigné le taux de la banque');

                            } else if (parseInt(scope.product.tauxemprunt) <= 0) {
                                toaster.pop('error', "Attention", 'Le taux de la banque doit être superieur a 0');
                                scope.product.tauxemprunt = '';
                            } else if (parseInt(scope.product.tauxemprunt) > 100) {
                                toaster.pop('error', "Attention", 'Le taux de la banque ne doit pas depasseer 100');
                                scope.product.tauxemprunte = '';
                            } else {
                                scope.product.tauxemprunt = scope.product.tauxemprunt;

                            }
                            if (scope.product.duree >= 0) {

                            };


                        } else {
                            scope.product.gestionCoassurance = true;
                            if (typeof scope.product.typepret == 'undefined') {
                                scope.product.idtypepret = 1
                            } else {
                                scope.product.idtypepret = scope.product.typepret.idtypepret;
                            }
                            scope.product.capital = (!angular.isString(scope.product.capital)) ? scope.product.capital : scope.product.capital.replace(/ /g, '');
                            console.log(scope.product.gestionCoassurance);
                        }

                        if (parseInt(scope.finalTotal().capital) > 0 && parseInt(scope.finalTotal().duree) > 0 && parseInt(scope.finalTotal().differe) >= 0 && parseInt(scope.finalTotal().tauxbanquaire) > 0) {
                            console.log(scope.finalTotal())
                            Data.post('SimulationPath', scope.finalTotal()).then(function(result) {
                                scope.product.primeassurance = result.Primetotale;
                                var n = parseInt(result.Primetotale) / parseInt(scope.finalTotal().capital) * 100;
                                scope.product.tauxprimes = n.toFixed(2);
                                scope.product.primeperte = result.PrimePE;
                                scope.product.accessoires = result.Accessoires;
                                scope.product.primedeces = result.Primedeces;
                                scope.product.montantsupprime = result.surprime;
                            })
                        }

                    })
                }
            }
        }
    }
});
app.directive('droitUsers', function($filter, $window, $parse, $timeout, toaster, Data) {
    return {
        require: '?ngModel',
        restrict: 'A',
        compile: function() {
            var moment = $window.moment;
            var getter, setter;
            var verif = false;
            return function(scope, element, attrs, ngModel) {

                // If the ngModel directive is used, then set the initial value and keep it in sync 
                if (ngModel) {
                    element.on('click', function(event) {
                        // console.log(attrs);


                    })
                }
            }
        }
    }
});