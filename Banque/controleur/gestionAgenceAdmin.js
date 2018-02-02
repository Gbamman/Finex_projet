app.controller('AgenceAdminCtrl', function($scope, $rootScope, $modalInstance, item, Data2, Data, $modal, $window, datetime, $filter, toaster) {
    var valeurDefault = null;
    $scope.agence = angular.copy(item);
    // console.log($scope.agence);
    // 
    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };
    
    if (item.idagence > 0) {
        Data.get('gestionBanqueAdminActif').then(function(result) {
            valeurDefault = _.where(result.data, {
                libelle: item.liblleBanque
            });
            $scope.banqueAll = result.data;
            $scope.agence.allbanque = valeurDefault[0];

        });
    } else {
        Data.get('gestionBanqueAdminActif').then(function(result) {
            verification = result.verification;
            $scope.banqueAll = result.data;
            $scope.agence.allbanque = $scope.banqueAll[0];

        });
    }
    $scope.title = (item.idagence > 0) ? 'Modification d\'une agence' : 'Creation d\'une agence';
    $scope.buttonText = (item.idagence > 0) ? 'Modifier l\'agence' : 'Ajouter une agence';

    var original = item;
    $scope.isClean = function() {
        return angular.equals(original, $scope.agence);
    }
    $scope.saveAgence = function(agenceSend) {
        agenceSend.id = agenceSend.allbanque.id;
        agenceSend.liblleBanque = agenceSend.allbanque.libelle;
        if (agenceSend.idagence > 0) {
            // console.log(agenceSend);
            Data.put('agenceModif/' + agenceSend.idagence, agenceSend).then(function(result) {
                Data.toast(result);
                if (result.status != 'error') {
                    var x = angular.copy(agenceSend);
                    x.save = 'update';
                    x.verif = 'agenceUpdate';
                    $modalInstance.close(x);
                } else {

                }
            });
        } else {
            // console.log(agenceSend);
            Data.post('agenceInsert', agenceSend).then(function(result) {
                Data.toast(result);
                if (result.status != 'error') {
                    var x = angular.copy(agenceSend);
                    x.save = 'insert';
                    x.verif = 'agenceInsert';
                    x.idagence = result.data;
                    $modalInstance.close(x);
                } else {
                    // console.log(result);
                }
            });
        }
    };
});