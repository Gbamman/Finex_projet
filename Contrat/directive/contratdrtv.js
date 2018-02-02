app.directive('remumberName', function($filter, $window, $parse, $timeout, toaster, Data2, $interpolate) {
    return {
        require: '?ngModel',
        restrict: 'A',
        compile: function() {
            var moment = $window.moment;
            var getter, setter;
            var verif = false;
            return function(scope, element, attrs, ngModel) {
                getter = $parse(attrs.ngModel);
                setter = getter.assign;
                // If the ngModel directive is used, then set the initial value and keep it in sync 
                if (ngModel) {
                    element.on('blur', function(event) {
                        var numcontrat = scope.product.numcontrat;
                        console.log(numcontrat);
                        if (typeof scope.product.idcontrat == 'undefined') {
                            Data2.post('nomassocieauCompte', {
                                numcontrat
                            }).then(function(result) {
                                console.log(result);
                                if (result.status == 'success') {
                                    $parse('product.nom').assign(scope, result.data[0].nom);
                                    $parse('product.prenom').assign(scope, result.data[0].prenom);
                                    // $parse('product.capital').assign(scope,result.data[0].capital);
                                    //$parse('product.primeassurance').assign(scope,result.data[0].primeassurance);
                                    $parse('product.dateeffet').assign(scope, $filter('date')(result.data[0].dateeffet, "dd/MM/yyyy"));
                                    $parse('product.dateecheance').assign(scope, $filter('date')(result.data[0].dateecheance, "dd/MM/yyyy"));
                                    $parse('product.datenaissance').assign(scope, $filter('date')(result.data[0].datenaissance, "dd/MM/yyyy"));
                                } else {

                                    /* $parse('product.nom').assign(scope,'');
                                    $parse('product.prenom').assign(scope,'');
                                    $parse('product.capital').assign(scope,'');
                                    $parse('product.primeassurance').assign(scope,'');
                                    $parse('product.dateeffet').assign(scope,'');
                                    $parse('product.dateecheance').assign(scope,'');*/
                                }
                            })
                        }

                    })
                }
            }
        }
    }
});