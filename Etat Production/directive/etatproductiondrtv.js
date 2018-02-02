app.directive('bordereauEtat', function($filter, $rootScope, $window, $parse, $timeout, toaster, Data, $interpolate) {
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
                        var verifs = ["2", "36"]

                        if (verifs.indexOf(scope.idnomgroup) === -1) {


                        } else {
                            if (moment(element.val(), "DD/MM/YYYY").isValid()) {
                                scope.bordereauEtatButton = true;
                            }

                        }

                    })
                }
            }
        }
    }
})

app.directive('dateProduct', function($filter, $window, $parse, $timeout, toaster) {
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
                        var datedebut = moment($filter('date')(scope.etatProduction.datedebut, "DD/MM/yyyy")).utc().valueOf();
                        var datefin = moment($filter('date')(scope.etatProduction.datefin, "DD/MM/yyyy")).utc().valueOf();
                        tabdeb = (scope.etatProduction.datedebut.split(/[- //]/));
                        tabfin = (scope.etatProduction.datefin.split(/[- //]/));
                        Odeb = new Date(tabdeb[2], tabdeb[1], tabdeb[0]);
                        Ofin = new Date(tabfin[2], tabfin[1], tabfin[0]);

                        console.log('Date debut', Odeb);
                        console.log('Date fin', Ofin);
                        if (Odeb > Ofin) {
                            toaster.pop('Info', "Information", 'La date de fin ne doit pas être antérieure à la date du début.');
                            scope.etatProduction.datedebut = " ";
                            scope.etatProduction.datefin = " ";
                            scope.etatProduction.datedebut.focus();
                            scope.etatProduction.datedebut.style.backgroundColor = '#fee';
                            return false
                        }

                    })
                }
            }
        }
    }
});

/*   onsubmit = function() {
// les dates étant saisies en français, on les transforme
// Ici sont acceptés comme séparateurs le tiret, le slash et l'espace
tabdeb = (debut.value.split(/[- //]/));
tabfin = (fin.value.split(/[- //]/));
Odeb = new Date(tabdeb[2],tabdeb[1],tabdeb[0]);
Ofin = new Date(tabfin[2],tabfin[1],tabfin[0]);
if(Odeb > Ofin) {
alert ('La fin ne doit pas être antérieure au début.');
debut.focus(); debut.style.backgroundColor='#fee';
return false
};
};*/