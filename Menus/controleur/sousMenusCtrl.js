app.controller('editSousMenus', function($scope, $rootScope, $modalInstance, item, Data2, Data, $modal, $window, datetime, $filter, toaster) {
    var valeurDefault = null;
    $scope.sousmenuall = angular.copy(item);
    // console.log(item);
    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };
    if (item.idsousmenu > 0) {
        Data.get('gestionmenus').then(function(result) {
            verification = result.verification;
            valeurDefault = _.where(result.data, {
                libelle: item.allsousmenus
            });
            $scope.menusAll = result.data;
            $scope.sousmenuall.allmenus = valeurDefault[0];

        });
    } else {
        Data.get('gestionmenus').then(function(result) {
            verification = result.verification;
            $scope.menusAll = result.data;
            $scope.sousmenuall.allmenus = $scope.menusAll[0];

        });
        /* Data.get('gestionbanque').then(function (results) {
        $rootScope.banques = results.data;
        });*/
    }
    $scope.title = (item.idsousmenu > 0) ? 'Modification d\'un sousmenu' : 'Creation d\'un sousmenu';
    $scope.buttonText = (item.idsousmenu > 0) ? 'Modifier le sousmenu' : 'Ajouter un sousmenu';

    var original = item;
    $scope.isClean = function() {
        return angular.equals(original, $scope.sousmenuall);
    }
    $scope.saveMenus = function(menue) {
        if (menue.idsousmenu > 0) {
            menue.allsousmenus = menue.allmenus.libelle;
            menue.idmenu = menue.allmenus.idmenue;
            // console.log(menue);
            Data.put('sousmenusmodif/' + menue.idsousmenu, menue).then(function(result) {
                Data.toast(result);
                if (result.status != 'error') {
                    var x = angular.copy(menue);
                    x.save = 'update';
                    x.verif = 'Sousmenus';
                    $modalInstance.close(x);
                } else {

                }
            });
        } else {

            menue.allsousmenus = menue.allmenus.libelle;
            menue.idmenu = menue.allmenus.idmenue;
            // console.log(menue.allmenus);
            Data.post('sousmenusInsert', menue).then(function(result) {
                Data.toast(result);
                if (result.status != 'error') {
                    var x = angular.copy(menue);
                    x.save = 'insert';
                    x.verif = 'Sousmenus';
                    x.idsousmenu = result.data;
                    $modalInstance.close(x);
                } else {
                    // console.log(result);
                }
            });
        }
    };
});