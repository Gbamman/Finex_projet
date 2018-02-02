app.controller('GestionProfilCtrl', function($scope, $rootScope, $modalInstance, item, Data2, Data, $modal, $window, datetime, $filter, toaster) {
    var valeurDefault = null;
    $scope.gestionProfilObjet = angular.copy(item);
    console.log(item);
    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };
    $scope.title = (item.idprofil > 0) ? 'Modifier le Profil' : 'Creation d\'un Profil';
    $scope.buttonText = (item.idprofil > 0) ? 'Modifier le Profil' : 'Ajouter un Profil';

    var original = item;

    if (item.idprofil > 0) {
        Data.get('GetAll_UserGroup').then(function(results) {
            console.log(results.data);
            valeurDefault = _.where(results.data, {
                idnomgroup: item.idnomgroup
            });
            $scope.gestionProfilObjet.get_all_group = valeurDefault[0];

            console.log(valeurDefault);
            $scope.GetAllGroup = results.data;
        });
    } else {
        Data.get('GetAll_UserGroup').then(function(result) {
            $scope.GetAllGroup = result.data;
            $scope.gestionProfilObjet.get_all_group = $scope.GetAllGroup[0];

        });
    }


    $scope.isClean = function() {
        return angular.equals(original, $scope.nomgrouputilisateur);
    }
    $scope.saveProfilUsers = function(profilSend) {
        if ($rootScope.actionsMenue == 'ecriture') {
            profilSend.idnomgroup = profilSend.get_all_group.idnomgroup;
            profilSend.libelleNomGroupe = profilSend.get_all_group.libelle;
            if (profilSend.idprofil > 0) {
                console.log(profilSend);
                Data.put('profilmodif/' + profilSend.idprofil, profilSend).then(function(result) {
                    Data.toast(result);
                    if (result.status != 'error') {
                        console.log(result);
                        var x = angular.copy(profilSend);
                        x.save = 'update';
                        x.verif = 'ProfilMofif';
                        $modalInstance.close(x);
                    } else {
                        console.log(result);
                    }
                });
            } else {
                console.log(profilSend);
                Data.post('profilInsert', profilSend).then(function(result) {
                    Data.toast(result);
                    if (result.status != 'error') {
                        var x = angular.copy(profilSend);
                        x.save = 'insert';
                        x.verif = 'ProfilInsert';
                        x.idprofil = result.data;
                        $modalInstance.close(x);
                    } else {
                        console.log(result);
                    }
                });
            }
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    };
});