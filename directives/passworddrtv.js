app.directive('focus', function() {
    return function(scope, element) {
        element[0].focus();
    }      
});

app.directive('passwordMatch', [function () {
    return {
        restrict: 'A',
        scope:true,
        require: 'ngModel',
        link: function (scope, elem , attrs,control) {
            var checker = function () {
 
                //get the value of the first password
                var e1 = scope.$eval(attrs.ngModel); 
 
                //get the value of the other password  
                var e2 = scope.$eval(attrs.passwordMatch);
                if(e2!=null)
                return e1 == e2;
            };
            scope.$watch(checker, function (n) {
                control.$setValidity("passwordNoMatch", n);
            });
        }
    };
}]);
app.directive('ngUpdateHidden',function() {
    return function(scope, el, attr) {
        var model = attr['ngModel'];
        scope.$watch(model, function(nv) {
            el.val(nv);
           
        });
      
    }; 
})

app.directive('effetDateValide', function ($filter, $window, $parse,toaster) {
    return {
    require: '?ngModel',
    restrict: 'A',
    compile: function () {
        var moment = $window.moment;
        var getter, setter;
        return function (scope, element, attrs, ngModel) {

            // If the ngModel directive is used, then set the initial value and keep it in sync ,Ofin.getHours(),Ofin.getMinutes(),Ofin.getSeconds()  
            if (ngModel) {
                            element.on('blur', function (event) {
                        tabdeb = (scope.product.dateeffet.split(/[- //]/));
                        Ofin = new Date();
                        Ofin2 = new Date(Ofin.getFullYear(),Ofin.getMonth(),Ofin.getDate());
                         Odeb = new Date(tabdeb[2],parseInt(tabdeb[1]-1),tabdeb[0]);
                          var Iso= Ofin.toISOString().split('T')[0]
                    console.log('Date debut', Odeb);
                    console.log('Date fin', Ofin);
                    console.log('Iso', Ofin2);
                  if(Odeb >= Ofin2) {
                       scope.$apply(function () {
                                          var date2=  $parse('product.dateeffet').assign(scope,scope.product.dateeffet);
                                        });
                  }else{
                    toaster.pop('error', "Information", 'La date d\'effet ne doit pas être antérieure à la date du jour.');
                    scope.product.dateeffet='';
                  }
              })

        }
    }
    }
}

})