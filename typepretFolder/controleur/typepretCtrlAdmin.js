app.controller('typeprteCrtlEdith', function ($scope,$rootScope,$modalInstance,item,Data,$modal,$window,$filter,toaster){
    var valeurDefault =null;     
/*$scope.TypepretLibelle = function(banqueId) {
    	valeur=banqueId
   		 Data.get('typepret/'+valeur).then(function (resultpret) {
  	 $scope.typPretAll.typepret=resultpret.data[0];
  	$scope.typeprets = resultpret.data;
  		console.log($scope.typeprets);
});
}*/

  $scope.typPretAll = angular.copy(item);
  $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.idtypepret > 0) ? 'Modification d\'un type de pret' : 'Creation d\'un type de pret';
        $scope.buttonText = (item.idtypepret > 0) ? 'Modifier le type de pret' : 'Ajouter un type de pret';

         if(item.idtypepret>0){
                               Data.get('gestionBanqueAdmin').then(function (results) {
                                if(results.status=='success'){
                                  $scope.banques = results.data;
                                  valeurDefault = _.where(results.data, {libelle:item.libelleBanque});
                                  console.log(valeurDefault)
                                  $scope.typPretAll.idbanque=valeurDefault[0]; 
                                }
                                });
                                                          
        }else{
           Data.get('gestionBanqueAdmin').then(function (results) {
                                if(results.status=='success'){
                                  $scope.banques = results.data;
                                  valeurDefault = _.where(results.data, {libelle:item.libelleBanque});
                                  console.log(valeurDefault)
                                  $scope.typPretAll.idbanque=results.data[0]; 
                                }
                                });
        }
        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.typPretAll);
        }
          $scope.saveTypePret = function (saveTypePret) {
            saveTypePret.libelleBanque=saveTypePret.idbanque.libelle;
            saveTypePret.idbanque=saveTypePret.idbanque.id;
            if(saveTypePret.idtypepret > 0){
               console.log(saveTypePret);
                Data.put('TypeProfilmodif/'+saveTypePret.idtypepret, saveTypePret).then(function (result) {
                    Data.toast(result);
                    console.log(result);
                    if(result.status != 'error'){
                        var x = angular.copy(saveTypePret);
                        x.save = 'update';
                         x.verif = 'typepretModif';
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }else{
               console.log(saveTypePret);
                saveTypePret.etat=0;
                Data.post('SaveTypeProfil', saveTypePret).then(function (result) {
                    Data.toast(result);
                    if(result.status != 'error'){
                        var x = angular.copy(saveTypePret);
                        x.save = 'insert';
                        x.verif = 'typepretInsert';
                        x.idtypepret = result.data;
                        $modalInstance.close(x);
                    }else{
                        console.log(result);
                    }
                });
            }
           
        };
});