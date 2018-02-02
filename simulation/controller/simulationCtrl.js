app.controller('SimulationCtrl', function($scope, $rootScope, $modalInstance, item, Data, $modal, $window, datetime, $filter, toaster) {
    Data.get('gestiontypepret').then(function(resultpret) {
        $scope.typeprets = resultpret.data;
        var selectedBanqueActif = _.where($scope.typeprets, {
            etat: '0'
        });
        $scope.selectedBanqueTypePret = _.where(selectedBanqueActif, {
            idbanque: $rootScope.idbanque
        });
        $scope.product.typepret = $scope.selectedBanqueTypePret[0];
        console.log($scope.selectedBanqueTypePret);
    })
    Data.get('gestionParametrePrime').then(function(results) {
        $scope.parametre = results.data;

    })
    $scope.product = angular.copy(item);
    console.log($scope.product);
    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };

    var original = item;
    $scope.isClean = function() {
        return angular.equals(original, $scope.product);
    }

    $scope.product.sexe = "M";
    $scope.product.reglementprime = "UNIQUE";
    $scope.product.periodicite = "mensuelle";
    $scope.product.differe = 0;
    $scope.product.perteemploi = 'non';
    $scope.product.remboursement = 'PERIODIQUE';
    $scope.product.primeassurance = 0;
    $scope.product.tauxprimes = 0;
    $scope.product.dateecheance = 'jj/mm/yyyy';
    $scope.product.totalesupprime = 0;
    /* function calculateDiscount(newValue, oldValue, scope){
    $scope.product.capital = product.capital.split(' ');
    product.capital = product.capital.join('');
    var newValueInt =newValue.split(' ');
    newValueInt=newValueInt.join('');
    var oldValueInt =oldValue.split(' ');
    oldValueInt=oldValueInt.join('');
    $scope.product.capital = (parseInt(newValue,20) > 100) ?  parseInt(newValue,20) * 0.10 : 0;
    };*/

    /* $scope.finalTotal = function(){
    return ($scope.product.capital*$scope.product.tauxprimes)/$scope.product.duree;   
    };

    $scope.$watch( $scope.product.capital, calculateDiscount);

    */
    $scope.finalTotal = function() {
        var Donnees = {
            action: $scope.product.i,
            idtypepret: $scope.product.idtypepret,
            datenaissance: $scope.product.datenaissance,
            capital: $scope.product.capital,
            duree: $scope.product.duree,
            dateeffet: $scope.product.dateeffet,
            periodicite: $scope.product.periodicite,
            perteemploi: $scope.product.perteemploi,
            remboursement: $scope.product.remboursement,
            tauxbanquaire: $scope.product.tauxemprunt,
            differe: $scope.product.differe
        };
        return Donnees;
    };
    $scope.simulationClick = function(customer) {

        customer.idtypepret = customer.typepret.idtypepret;
        console.log(customer);


        if (customer.capital < 0) {
            toaster.pop('error', "Attention", 'Vous n\'avez pas renseigné le capital pour ce contrat');
        } else {
            customer.capital = (!angular.isString(customer.capital)) ? customer.capital : customer.capital.replace(/ /g, '');
            Data.get('gestionParametrePrime').then(function(results) {
                $scope.parametre = results.data;
                if (parseInt(customer.capital) > parseInt($scope.parametre[0].capitalmax)) {
                    customer.capital = 0;
                    customer.tauxprimes = 0;
                    customer.primeassurance = 0;
                    toaster.pop('error', "Attention", 'Capital ne peut excéder ' + $scope.parametre[0].capitalmax + '. Veuillez contacter votre service bancassurance');

                } else if (parseInt(customer.tauxemprunt) > 100) {
                    toaster.pop('error', "Attention", 'Le taux banquaire ne peut excéder 100');
                } else {
                    customer.capital = customer.capital;
                    customer.surprime = 0;
                    customer.tauxbanquaire = customer.tauxemprunt;
                    Data.post('SimulationPath', customer).then(function(result) {
                        console.log(result)
                        $scope.product.primeassurance = result.Primetotale;
                        var n = (result.Primetotale / customer.capital) * 100;
                        $scope.product.tauxprimes = n.toFixed(2);
                        $scope.product.primeperte = result.PrimePE;
                        $scope.product.accessoires = result.Accessoires;
                        $scope.product.primedeces = result.Primedeces;

                    })
                    console.log(customer.capital);
                }
            })



        }


    };

    $scope.sendClick = function(argument) {
        argument.primetotale = $scope.primetotale;
        argument.primedeces = $scope.primedeces;
        argument.primePE = $scope.primePE;
        argument.Accessoires = $scope.Accessoires;
        var x = angular.copy(argument);
        x.save = 'insert';
        $modalInstance.close(x);
    }
})