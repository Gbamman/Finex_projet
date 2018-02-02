app.controller('coassureurAdmin', function ($scope,fileBankUpload,$rootScope,$modalInstance,item,Data,$modal,$window,$filter,toaster){
    var valeurDefault =null; 
     $scope.coassureur = angular.copy(item);
     console.log($scope.coassureur);
  $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };    
          $scope.title = (item.idcoass > 0) ? 'Modification d\'un co-assureur' : 'Creation d\'un Co-assureur';
        $scope.buttonText = (item.idcoass > 0) ? 'Modifier le Co-assureur' : 'Ajouter un Co-assureur';
         var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.coassureur);
        }

         $scope.saveNewCoassureur = function (NewCoAssureur) {
          NewCoAssureur.oldpicturepath=NewCoAssureur.logo;
             var file = NewCoAssureur.myFile;
             /* console.log(file);*/
               var uploadUrl = "api/v1/imageCoassureuruploader.php";
               fileBankUpload.uploadFileToUrl(file,uploadUrl);
              fileBankUpload.retourneValue(function(data) {
                console.log(data);
                     $scope.prep_time = data;
                     if (data.length>0) {
                       NewCoAssureur.logo =data;
                    }
               
            if(NewCoAssureur.idcoass > 0){
                Data.put('CoassuranceModif/'+NewCoAssureur.idcoass,NewCoAssureur).then(function (result) {
                    Data.toast(result);
                    if(result.status != 'error'){
                        var x = angular.copy(NewCoAssureur);
                        x.save = 'update';
                         x.verif = 'CoassureurModif';
                        $modalInstance.close(x);
                    }else{
                    }
                });
            }else{
            	console.log(NewCoAssureur);
               NewCoAssureur.etat='0';
                Data.post('CoassuranceInsert', NewCoAssureur).then(function (result) {
                    Data.toast(result);
                    console.log(result)
                    if(result.status != 'error'){
                        var x = angular.copy(NewCoAssureur);
                        x.save = 'insert';
                        x.verif = 'CoassureurInsert';
                        x.idcoass = result.data;
                        $modalInstance.close(x);

                    }else{
                    }
                });
            }
             });          
        };
});