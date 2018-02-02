app.controller('editMenus', function ($scope,$rootScope,$modalInstance,item, Data2,Data,$modal,$window,datetime,$filter,toaster) {
  $scope.menuall = angular.copy(item);
  // console.log($scope.menuall);
  $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.idmenue > 0) ? 'Modification d\'un menu' : 'Creation d\'un menu';
        $scope.buttonText = (item.idmenue > 0) ? 'Modifier le menu' : 'Ajouter un menu';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.menuall);
        }
          $scope.saveMenus = function (menue) {
            if(menue.idmenue > 0){
               // console.log(menue);
                Data.put('menusmodif/'+menue.idmenue, menue).then(function (result) {
                    Data.toast(result);
                    if(result.status != 'error'){
                        var x = angular.copy(menue);
                        x.save = 'update';
                         x.verif = 'Menus';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{
               // console.log(menue);
                Data.post('menusInsert', menue).then(function (result) {
                    Data.toast(result);
                    if(result.status != 'error'){
                        var x = angular.copy(menue);
                        x.save = 'insert';
                        x.verif = 'Menus';
                        x.idmenue = result.data;
                        $modalInstance.close(x);
                    }else{
                        // console.log(result);
                    }
                });
            }
           
        };
});