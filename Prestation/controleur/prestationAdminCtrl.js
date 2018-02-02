app.controller('prestationAdminCtrl', function($scope, $rootScope, $modalInstance, item, Data, $filter, toaster) {
    $scope.prestation = angular.copy(item);
    // console.log(item);
    /*function valeurDefault1(droit){
    console.log();
    };*/
    Data.get('getEtat').then(function(result) {
        if (result.status == 'success') {
            $scope.etatcontrats = result.data;
            var valeuretatDefaut = '';
            if (item.idetat > 0) {
                valeuretatDefaut = _.where($scope.etatcontrats, {
                    idetat: item.idetat
                });
                $scope.prestation.etatContratContent = valeuretatDefaut[0];
                // console.log($scope.prestation.etatContratContent);
            } else {
                $scope.prestation.etatContratContent = $scope.etatcontrats[0];
            };


        }
    });
    $scope.Affectation = function(argumentaire) {
        argumentaire.etat = (argumentaire.etat == "0" ? "1" : "0");
        // console.log( argumentaire.etat);
        Data.put('AffectationPiece/' + argumentaire.id, argumentaire).then(function(result) {
            Data.toast(result);
        })

    }
    $scope.AffectationDroit = function(droit) {
        /* console.log(droit+ "ET" +idgroup);*/
        /* argumentaire.etat =(argumentaire.etat=="0" ? "1" : "0");console.log( argumentaire.etat);*/
        Data.put('AffectationDroit/' + droit.idgroup, droit).then(function(result) {
            Data.toast(result);
            // console.log(result);
        })

    }

    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };
    if (item.idprestation > 0) {
        $scope.title = 'Modifier l\'intitulé de la prestation';
        $scope.buttonText = 'Modifier la prestation';
    } else {
        $scope.title = 'Creation d\'une nouvelle prestation';
        $scope.buttonText = 'Ajouter une nouvelle prestation';
    };



    if (item.idprestation > 0) {
        Data.get('gestionPestationAdim/' + item.idprestation).then(function(results) {
            /* console.log(results);*/
            console.log(results);
            $scope.pieces = results.data;

        });
    } else {

    }
    var original = item;
    $scope.isClean = function() {
        return angular.equals(original, $scope.prestation);
    }
    $scope.savePrestation = function(prestation) {
        if ($rootScope.actionsMenue == 'ecriture') {
            // console.log(prestation);
            prestation.idetat = prestation.etatContratContent.idetat;
            prestation.etatContratLibelle = prestation.etatContratContent.libelle;
            if (prestation.idprestation > 0) {
                Data.put('prestationModif/' + prestation.idprestation, prestation).then(function(result) {
                    if (result.status == 'success') {
                        Data.toast(result);
                    };
                    if (result.status != 'error') {
                        console.log(result);
                        var x = angular.copy(prestation);
                        x.save = 'update';
                        x.verif = 'prestationModif';
                        $modalInstance.close(x);
                    } else {}
                });
            } else {
                // console.log(prestation);
                Data.post('prestationInsert', prestation).then(function(result) {
                    Data.toast(result);
                    if (result.status != 'error') {
                        var x = angular.copy(prestation);
                        x.save = 'insert';
                        x.verif = 'prestationInsert';
                        x.idprestation = result.data;
                        $modalInstance.close(x);
                    } else {}
                });
            }
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    };

});