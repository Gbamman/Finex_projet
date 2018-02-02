app.directive('echeanceDateEduc', function($filter, $window, $parse, toaster) {
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
                        console.log('ready');
                        var dateactualise1 = moment().add(element.val(), 'month').format('DD/MM/YYYY');
                        var duree = parseInt(scope.produit.dureecontrat);
                        var dateactualise = moment(scope.produit.dateeffet, 'DD/MM/YYYY').add(duree, 'month').format('DD/MM/YYYY');
                        if (moment(scope.produit.dateeffet, "DD/MM/YYYY").isValid()) {
                            scope.$apply(function() {
                                var date2 = $parse('produit.dateecheance').assign(scope, dateactualise);
                            });
                        };
                        tabdeb = (scope.produit.dateeffet.split(/[- //]/));
                        Odeb = new Date(tabdeb[2], parseInt(tabdeb[1] - 1), tabdeb[0]);
                        Ofin = new Date();

                        console.log('Date debut', Odeb);
                        console.log('Date fin', Ofin);
                        if (Odeb < Ofin) {
                            scope.$apply(function() {
                                var date2 = $parse('produit.dateeffet').assign(scope, scope.produit.dateeffet);
                            });
                        }

                    })
                }
            }
        }
    }
});


app.directive('verifChampsEduc', function($filter, $rootScope, $window, $parse, $timeout, toaster, Data, $interpolate) {
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
                    element.on('submit', function(event) {


                        /*    if(scope.product.capital < 0){
                        toaster.pop('error', "Attention", 'Vous n\'avez pas renseigné le capital pour ce contrat');
                        }else{ 
                        scope.product.capital= (!angular.isString(scope.product.capital)) ?  scope.product.capital :  scope.product.capital.replace(/ /g, '');
                         if (parseInt(scope.product.capital) > parseInt(scope.parametre[0].capitalmax)) {

                         scope.product.capital=0;
                        scope.product.tauxprimes=0;
                        scope.product.primeassurance=0;
                        console.log(scope.idnomgroup);
                        toaster.pop('error', "Attention", 'Capital ne peut excéder '+scope.parametre[0].capitalmax+'. Veuillez contacter votre service bancassurance');
                        element.css('background', 'pink');
                        }else{
                         console.log(scope.product.capital);
                        scope.product.capital =scope.product.capital;
                        element.css('background', '#ffffff');
                        }
                        }*/

                        if (scope.produit.dureecontrat <= 0) {
                            toaster.pop('error', "Attention", 'Vous n\'avez pas renseigné la duree pour ce produit');
                            scope.produit.dureecontrat = 0;
                        } else {


                        }

                        if (scope.produitForm.nom.$dirty || scope.produitForm.nom.$invalid) {
                            toaster.pop('error', "Attention", 'Vous n\'avez renseigné le nom du souscripteur12363');

                        } else {


                        }

                        if (scope.produit.prenom == 'undefined') {
                            toaster.pop('error', "Attention", 'Vous n\'avez renseigné le prénom du souscripteur');


                        } else {


                        }
                        if (scope.produit.differe < 0) {
                            toaster.pop('error', "Attention", 'Quel est le differé du contrat');


                        } else {


                        }

                        /*if(moment(scope.produit.datesignature,"DD/MM/YYYY").isValid()){*/
                        if (moment(scope.produit.datesignature, "DD/MM/YYYY").isValid()) {


                        } else {

                            toaster.pop('error', "Attention", 'Vous n\'avez pas renseigné la date du signature');
                            scope.produit.datesignature = '';
                        }


                        /*  if(typeof scope.produit.typepret == 'undefined'){
                        scope.product.idtypepret=11;    
                        }else{
                        scope.produit.idtypepret=scope.product.typepret.idtypepret;
                        }

                        if(scope.produit.tauxemprunt<=0){
                        toaster.pop('error', "Attention", 'Vous n\'avez pas renseigné le taux de la banque');

                        }else if (parseInt(scope.product.tauxemprunt)<=0) {
                        toaster.pop('error', "Attention", 'Le taux de la banque doit être superieur a 0');
                        scope.produit.tauxemprunt='';
                        } else if ( parseInt(scope.product.tauxemprunt)>100) {
                        toaster.pop('error', "Attention", 'Le taux de la banque ne doit pas depasseer 100');
                        scope.produit.tauxemprunte='';
                        }else{
                        scope.product.tauxemprunt= scope.product.tauxemprunt;

                        }
                        if (scope.produit.duree >=0) {

                        }; */


                        var verif = ["2", "36"]
                        if (verif.indexOf(scope.idnomgroup) === -1) {
                            console.log(verif.indexOf(scope.idnomgroup));
                            scope.product.gestionCoassurance = false;
                            console.log(scope.product.gestionCoassurance);
                        } else {
                            /* scope.product.gestionCoassurance=true;
                            if(typeof scope.product.typepret == 'undefined'){
                            scope.product.idtypepret=1    
                            }else{
                            scope.product.idtypepret=scope.product.typepret.idtypepret;
                            }
                            scope.product.capital= (!angular.isString(scope.product.capital)) ?  scope.product.capital :  scope.product.capital.replace(/ /g, '');
                            console.log(scope.product.gestionCoassurance);             */
                        }

                        /* if(parseInt(scope.finalTotal().capital)>0 && parseInt(scope.finalTotal().duree)>0 && parseInt(scope.finalTotal().differe)>=0 && parseInt(scope.finalTotal().tauxbanquaire)>0){
                        console.log(scope.finalTotal())
                        Data.post('SimulationPath', scope.finalTotal()).then(function (result) {
                        scope.product.primeassurance=result.Primetotale;
                        var n=parseInt(result.Primetotale)/ parseInt(scope.finalTotal().capital)*100;
                        scope.product.tauxprimes=n.toFixed(2);
                        scope.product.primeperte=result.PrimePE;
                        scope.product.accessoires=result.Accessoires;
                        scope.product.primedeces=result.Primedeces;
                        scope.product.montantsupprime=result.surprime;
                        })
                        }*/

                    })
                }
            }
        }
    }
});

app.directive('effetDateValideEduc', function($filter, $window, $parse, toaster) {
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
                        tabdeb = (scope.produit.dateeffet.split(/[- //]/));
                        Odeb = new Date(tabdeb[2], parseInt(tabdeb[1] - 1), tabdeb[0]);
                        Ofin = new Date();

                        console.log('Date debut', Odeb);
                        console.log('Date fin', Ofin);
                        if (Odeb > Ofin) {
                            scope.$apply(function() {
                                var date2 = $parse('product.dateeffet').assign(scope, scope.prodit.dateeffet);
                            });
                        } else {
                            toaster.pop('error', "Information", 'La date d\'effet ne doit pas être antérieure à la date du jour.');
                            scope.produit.dateeffet = '';
                        }
                    })

                }
            }
        }
    }

})


/****************************************************************************************************************************************************************************************/
app.directive('showErrors', function($timeout) {
    return {
        restrict: 'A',
        require: '^form',
        link: function(scope, el, attrs, formCtrl) {
            // find the text box element, which has the 'name' attribute
            var inputEl = el[0].querySelector("[name]");
            // convert the native text box element to an angular element
            var inputNgEl = angular.element(inputEl);
            // get the name on the text box
            var inputName = inputNgEl.attr('name');

            // only apply the has-error class after the user leaves the text box
            var blurred = false;
            inputNgEl.bind('blur', function() {
                blurred = true;
                el.toggleClass('has-error', formCtrl[inputName].$invalid);
            });

            scope.$watch(function() {
                return formCtrl[inputName].$invalid
            }, function(invalid) {
                // we only want to toggle the has-error class after the blur
                // event or if the control becomes valid
                if (!blurred && invalid) {
                    return
                }
                el.toggleClass('has-error', invalid);
            });

            scope.$on('show-errors-check-validity', function() {
                el.toggleClass('has-error', formCtrl[inputName].$invalid);
            });

            scope.$on('show-errors-reset', function() {
                $timeout(function() {
                    el.removeClass('has-error');
                }, 0, false);
            });
        }
    }
});

/*module.controller('NewUserController', function($scope) {
$scope.save = function() {
$scope.$broadcast('show-errors-check-validity');

if ($scope.userForm.$valid) {
alert('User saved');
$scope.reset();
}
};

$scope.reset = function() {
$scope.$broadcast('show-errors-reset');
$scope.user = { name: '', email: '' };
}
});*/


/****************************************************************************************************************************************************************************************/