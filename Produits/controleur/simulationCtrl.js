app.controller('simulationCtrl', function ($scope,$rootScope,$modalInstance,item,primeDataFact,Data2,Data,$modal,$window,datetime,$filter,toaster){
 $scope.produit = angular.copy(item);
 console.log(item);
   /* if( $scope.produit.idcontrat > 0){
    $scope.produit.numcontrat=$scope.produit.numcontrat.replace('|num', '');
  }*/
    var original = item;
    $scope.isClean = function() {
        return angular.equals(original, $scope.produit);
    }
    console.log($scope.produit);
    $scope.cancel = function () {
        $modalInstance.dismiss('Close');
    };
    if(item.idproduit > 0){

    }
    else{
     
    }

  });