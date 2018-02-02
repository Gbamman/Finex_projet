app.controller('ParametresAdmin', function($scope, $rootScope, $modalInstance, item, Data, $modal, $window, $filter, toaster, $timeout) {
    var valeurDefault = null;
    var valeurDefault1 = null;
    $scope.selectedBanqueTypePret = [];
    /*$scope.TypepretLibelle = function(banqueId) {
    valeur=banqueId
    Data.get('typepret/'+valeur).then(function (resultpret) {
    $scope.typPretAll.typepret=resultpret.data[0];
    $scope.typeprets = resultpret.data;
    console.log($scope.typeprets);
    });
    }*/
    Data.get('gestiontypepret').then(function(result) {
        $scope.typeprets = result.data;
    });

    $scope.TypepretFilter = function(idbanque) {


        /* $scope.selectedBanqueTypePret=[];*/
        // console.log(idbanque);
        /* if($scope.typeprets=='undefined')
        return;*/
        // console.log('Liste des type de prêts dispo: ', $scope.typeprets);
        for (var i = $scope.typeprets.length - 1; i >= 0; i--) {
            if ($scope.typeprets[i].idbanque == idbanque) {
                $scope.selectedBanqueTypePret.push($scope.typeprets[i]);
            }
        }
        if (item.idparam > 0) {
            valeurDefault1 = _.where($scope.selectedBanqueTypePret, {
                idtypepret: item.idtypepret
            });
            $scope.parametrePrime.typepretobj = valeurDefault1[0];
        } else {

            $scope.parametrePrime.typepretobj = $scope.selectedBanqueTypePret[0];
            // console.log('Regarde', $scope.parametrePrime.typepretobj);
        }
        // console.log('Liste des type de prêts de selected Banque: ', $scope.selectedBanqueTypePret);
        // console.log('Liste des type de prêts de selected Banque par defaut: ', $scope.parametrePrime.typepretobj);
    }


    $scope.parametrePrime = angular.copy(item);
    // console.log($scope.parametrePrime);
    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };
    $scope.title = (item.idparam > 0) ? 'Modification d\'un Parametre de Prime' : 'Creation d\'un parametre de prime';
    $scope.buttonText = (item.idparam > 0) ? 'Modifier le parametre de prime ' : 'Ajouter un parametre de prime';

    if (item.idparam > 0) {
        Data.get('gestionBanqueAdmin').then(function(results) {
            if (results.status == 'success') {
                $scope.banques = results.data;
                valeurDefault = _.where(results.data, {
                    libelle: item.libelleBanque
                });
                // console.log(valeurDefault)
                $scope.parametrePrime.banqueContent = valeurDefault[0];
                $scope.TypepretFilter(valeurDefault[0].id)
            }
        });

        valeurDefault1 = _.where($scope.typeprets, {
            idtypepret: item.idtypepret
        });
        // console.log(valeurDefault1)
        $scope.parametrePrime.typepretobj = valeurDefault1[0];

    } else {
        Data.get('gestionBanqueAdmin').then(function(results) {
            if (results.status == 'success') {
                $scope.banques = results.data;
                // console.log(valeurDefault)
                $scope.parametrePrime.banqueContent = results.data[0];
                $scope.TypepretFilter(results.data[0].id);
            }
        });

        /* $scope.selectedBanqueTypePret =  $scope.typeprets*/
        /* $scope.parametrePrime.typepretobj= $scope.selectedBanqueTypePret[0]; */

    }
    var original = item;
    $scope.isClean = function() {
        return angular.equals(original, $scope.ParametrePrime);
    }
    $scope.saveParametrePrime = function(saveParametreprime) {
        // console.log('Contenues des donnes de Parametre Prime', saveParametreprime);
        saveParametreprime.libelleBanque = saveParametreprime.banqueContent.libelle;
        saveParametreprime.idbanque = saveParametreprime.banqueContent.id;
        saveParametreprime.idtypepret = saveParametreprime.typepretobj.idtypepret;
        saveParametreprime.type_de_pret = saveParametreprime.typepretobj.libelle;
        saveParametreprime.capitalmax = (!angular.isString(saveParametreprime.capitalmax)) ? saveParametreprime.capitalmax : saveParametreprime.capitalmax.replace(/ /g, '');
        saveParametreprime.accessoires = (!angular.isString(saveParametreprime.accessoires)) ? saveParametreprime.accessoires : saveParametreprime.accessoires.replace(/ /g, '');
        saveParametreprime.primeplanchet = (!angular.isString(saveParametreprime.primeplanchet)) ? saveParametreprime.primeplanchet : saveParametreprime.primeplanchet.replace(/ /g, '');
        if (saveParametreprime.idparam > 0) {
            // console.log(saveParametreprime);
            Data.put('paramprimemodif/' + saveParametreprime.idparam, saveParametreprime).then(function(result) {
                Data.toast(result);
                console.log(result);
                if (result.status != 'error') {
                    var x = angular.copy(saveParametreprime);
                    x.save = 'update';
                    x.verif = 'paramprimeModif';
                    $modalInstance.close(x);
                } else {
                    // console.log(result);
                }
            });
        } else {
            // console.log(saveParametreprime);
            Data.post('paramprimeInsert', saveParametreprime).then(function(result) {
                Data.toast(result);
                if (result.status != 'error') {
                    var x = angular.copy(saveParametreprime);
                    x.save = 'insert';
                    x.verif = 'paramprimeInsertion';
                    x.idparam = result.data;
                    $modalInstance.close(x);
                } else {
                    // console.log(result);
                }
            });
        }

    };
});