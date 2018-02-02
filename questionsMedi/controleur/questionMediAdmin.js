app.controller('editQuestionMediCtrl', function ($scope,$rootScope,$modalInstance,item,Data,$modal,$window,datetime,$filter,toaster) {
 $scope.questionmedicale = angular.copy(item);
  $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        };
        $scope.title = (item.idm > 0) ? 'Modifier la question medicale' : 'Enregistrement d\'une question médicale';
        $scope.buttonText = (item.idm > 0) ? 'Modifier cette question medicale' : 'Enrégistrer la question';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.questionmedicale );
        }
         
          $scope.saveQuestion = function (questionSend) {
           if($rootScope.actionsMenue=='ecriture' ){
            if(questionSend.idm > 0){
                Data.put('questionModif/'+questionSend.idm,questionSend).then(function (result) {
                    Data.toast(result);
                    if(result.status != 'error'){
                        var x = angular.copy(questionSend);
                        x.save = 'update';
                         x.verif = 'questionModif';
                        $modalInstance.close(x);
                    }else{
                    }
                });
            }else{
               questionSend.etat='Actif';
                Data.post('questionInsert', questionSend).then(function (result) {
                    Data.toast(result);
                    console.log(result)
                    if(result.status != 'error'){
                        var x = angular.copy(questionSend);
                        x.save = 'insert';
                        x.verif = 'questionInsert';
                        x.idm = result.data;
                        $modalInstance.close(x);

                    }else{
                    }
                });
            }
                    
      }else{
         toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
      }

    };
});