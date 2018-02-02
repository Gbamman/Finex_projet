app.directive('verifParamPrim', function ($filter, $window, $parse, $timeout,toaster,Data) {
    return {
    require: '?ngModel',
    restrict: 'A',
    compile: function () {
        var moment = $window.moment;
        var getter, setter;
        var verif=false;
        return function (scope,element, attrs, ngModel) {

            // If the ngModel directive is used, then set the initial value and keep it in sync 
            if (ngModel) {
                element.on('blur', function (event) {
               if (scope.parametrePrime.agemaxi<0) {
                     toaster.pop('error', "Attention", 'Age invalide');
                     scope.parametrePrime.agemaxi='';
               } else if (scope.parametrePrime.agemaxi>65) {
                   toaster.pop('error', "Attention", 'Cette tranche d\'age n\'est pas prise en compte');
                   scope.parametrePrime.agemaxi='';
               }else if (scope.parametrePrime.agemini<18) {
                   toaster.pop('error', "Attention", 'Cette tranche d\'age n\'est pas prise en compte');
                   scope.parametrePrime.agemini='';
               }else if (scope.parametrePrime.agemini>scope.parametrePrime.agemaxi) {
                   toaster.pop('error', "Attention", 'L\'âge minimal doit être inferieur à l\'âge maximal');
                   scope.parametrePrime.agemaxi='';
                   scope.parametrePrime.agemini='';
               }else{
                 
               }
                  /*else if (typeof scope.parametrePrime.agemini == 'undefined') {
                   toaster.pop('error', "Attention", 'Vous n\'avez pas renseigné l\'age minimal');
                   scope.parametrePrime.agemini='';
                    }  if(typeof scope.parametrePrime.agemaxi == 'undefined'){
                 toaster.pop('error', "Attention", 'Vous n\'avez pas renseigné l\'age maximal');
                  scope.parametrePrime.agemaxi='';        
               }else*/
                
                })
          }
        }
      }
    }
});