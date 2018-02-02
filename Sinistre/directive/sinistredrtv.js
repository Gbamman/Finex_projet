app.directive('sinistreInfo', function ($filter, $window, $parse, $timeout,toaster,Data,$interpolate) {
    return {
        require: '?ngModel',
        restrict: 'A',
        compile: function () {
            var moment = $window.moment;
            var getter, setter;
            var verif=false;
            return function (scope,element, attrs, ngModel) {
                       getter = $parse(attrs.ngModel);
                     setter = getter.assign;
                // If the ngModel directive is used, then set the initial value and keep it in sync 
                if (ngModel) {
                 element.on('blur', function (event) {
                                                        var numeropret=scope.prestationdeclare.numerocontrat;
                                                        Data.post('assuresinistrePath', {numeropret}).then(function (result) {
                                                          if (result.status=='success') {
                                                          scope.prestationdeclare.verification='oui';
                                                          scope.prestationdeclare.identifiantassure=result.data[0].nom+' '+result.data[0].prenom;
                                                          scope.prestationdeclare.capital=result.data[0].capital;
                                                          scope.prestationdeclare.primeassurance=result.data[0].primeassurance;
                                                          scope.prestationdeclare.coassureur='ARGG';
                                                          scope.prestationdeclare.coassureurName='ARGG';
                                                          console.log(scope.prestationdeclare.dateeffet);
                                                          scope.prestationdeclare.dateeffet=$filter('date')(result.data[0].dateeffet, "dd/MM/yyyy");
                                                          scope.prestationdeclare.dateecheance=$filter('date')(result.data[0].dateecheance, "dd/MM/yyyy");
                                                          }else{
                                                             scope.prestationdeclare.verification='non';
                                                          scope.prestationdeclare.identifiantassure='';
                                                          scope.prestationdeclare.capital='';
                                                          scope.prestationdeclare.primeassurance='';
                                                          scope.prestationdeclare.coassureur='NOM DE L\'ASSUREUR';
                                                          scope.prestationdeclare.coassureurName='NOM DE L\'ASSUREUR';
                                                          scope.prestationdeclare.dateeffet='';
                                                          scope.prestationdeclare.dateecheance='';

                                                             toaster.pop('error', "Information", 'Aucun assuré ne correspond à ce numero de contrat. Veuillez saisir les informations sur cet assuré');
                                                          }
                                                          

                                            
                                                      })
                                                  
                          })
          }
        }
      }
    }
});                                        

app.filter('numCompte', function(){
        return function(text) {
            return text.replace('|num', '');
        };
    });
app.filter("comeBack", function ($filter,$window) {
var moment = $window.moment; 
        return function ( value ) {

            if( moment(value,"YYYY-MM-DD").isValid() ){
                return true;
            }else{
                  return false;
            }
             

          

        }

});