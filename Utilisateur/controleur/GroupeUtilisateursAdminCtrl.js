app.controller('GrputilisateurCtrl', function($scope, $rootScope, $modalInstance, item, Data2, Data, $modal, $window, datetime, $filter, toaster) {
    $scope.grpvalToSend = null;
    var MenugrpObject = {
        idnomgroup: '',
        idsousmenu: '',
        libelle: '',
        libelleSousMenue: '',
        actionMenue: ''
    };
    var valeurDefault = null;
    $scope.ModelGroupe = angular.copy(item);
    console.log($scope.ModelGroupe);
    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };

    $scope.finish = function(argument) {
        $modalInstance.dismiss('Close');
    }
    if (item.idgroup > 0) {
        Data.get('gestionsousutilisteur').then(function(results) {
            valeurDefault = _.where(results.data, {
                idsousmenu: item.idsousmenu
            });
            $scope.ModelGroupe.sousmenusutilisateur = valeurDefault[0];
            $scope.sousmenusutilisateurs = results.data;
        });
        Data.get('gestionnomgroupeutilisateur').then(function(result) {
            $scope.nomgrouputilisateurs = result.data;
            $scope.ModelGroupe.grputilisateur = _.where(result.data, {
                idnomgroup: item.idnomgroup
            })[0];
        });

        /* Data.get('gestionmenus').then(function (result) { });*/


    } else {
        Data.get('gestionsousutilisteur').then(function(result) {
            $scope.sousmenusutilisateurs = result.data;
            $scope.ModelGroupe.sousmenusutilisateur = $scope.sousmenusutilisateurs[0];
        });
        Data.get('gestionnomgroupeutilisateur').then(function(result) {
            $scope.nomgrouputilisateurs = result.data;
            $scope.ModelGroupe.grputilisateur = $scope.nomgrouputilisateurs[0];
        });
        $scope.ModelGroupe.actionMenue = 'modification';
    }
    $scope.title = (item.idgroup > 0) ? 'Modification d\'un groupe utilisateur' : 'Creation d\'un Groupe utilisateur';
    $scope.buttonText = (item.idgroup > 0) ? 'Modifier le groupe utilisateur' : 'Ajouter un groupe utilisateur';

    var original = item;
    $scope.isClean = function() {
        return angular.equals(original, $scope.sousmenuall);
    }
    $scope.saveGroupeUsers = function(menue) {
        if ($rootScope.actionsMenue == 'ecriture') {
            console.log(menue);
            MenugrpObject = {
                idnomgroup: menue.grputilisateur.idnomgroup,
                idsousmenu: menue.sousmenusutilisateur.idsousmenu,
                libelle: menue.grputilisateur.libelle,
                libelleSousMenue: menue.sousmenusutilisateur.libelle,
                actionMenue: menue.actionMenue
            };
            if (menue.idgroup > 0) {
                MenugrpObject.idgroup = menue.idgroup;
                console.log(menue);
                Data.put('nomGrpUsermodif/' + menue.idgroup, MenugrpObject).then(function(result) {
                    Data.toast(result);
                    if (result.status != 'error') {
                        var x = angular.copy(MenugrpObject);
                        x.save = 'update';
                        x.verif = 'udpdateGroupe';
                        $modalInstance.close(x);
                    } else {
                        console.log(result);
                    }
                });
            } else {
                Data.post('namegroupeInsert', MenugrpObject).then(function(result) {
                    Data.toast(result);
                    if (result.status != 'error') {
                        var x = angular.copy(MenugrpObject);
                        x.save = 'insert';
                        x.verif = 'saveGroupe';
                        x.idgroup = result.data;
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