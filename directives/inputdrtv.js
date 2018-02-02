app.directive('formElement', function() {
    return {
        restrict: 'E',
        transclude: true,
        scope: {
            label : "@",
            model : "="
        },
        link: function(scope, element, attrs) {
          //block input-icon input-icon-right
            scope.disabled = attrs.hasOwnProperty('disabled');
            scope.required = attrs.hasOwnProperty('required');
            scope.pattern = attrs.pattern || '.*';
           
        },
        template: '<div class="form-group" style="margin:0 !important; padding:0px !important;"><label class="col-sm-3 control-label no-padding-right" >  {{label}}</label><span class="mui-textfield mui-textfield--float-label inputEditSize mui-select" ng-transclude ></span></div>'
      };
        
});

/*app.directive('sameUser', function() {
    return {
        restrict: 'E',
        transclude: true,
        scope: {
            label : "@",
            model : "="
        },
        link: function(scope, element, attrs) {
          //block input-icon input-icon-right
            scope.disabled = attrs.hasOwnProperty('disabled');
            scope.required = attrs.hasOwnProperty('required');
            scope.pattern = attrs.pattern || '.*';
           
        },
          if(scope.produit.etatCheck=='1'){
            template: '<div class="form-group" style="margin:0 !important; padding:0px !important;"><label class="col-sm-3 control-label no-padding-right" >  {{label}}</label><span class="mui-textfield mui-textfield--float-label inputEditSize mui-select" ng-transclude ></span></div>'
          }
      };
        
});*/

app.directive('onlyNumbers', function() {
    return function(scope, element, attrs) {
        var keyCode = [8,9,13,37,39,46,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,110,190];
        element.bind("keydown", function(event) {
            if($.inArray(event.which,keyCode) == -1) {
                scope.$apply(function(){
                    scope.$eval(attrs.onlyNum);
                    event.preventDefault();
                });
                event.preventDefault();
            }

        });
    };
});

app.directive('focus', function() {
    return function(scope, element) {
        element[0].focus();
    }      
});

app.directive('capitalize', function() {
    return {
      require: 'ngModel',
      link: function(scope, element, attrs, modelCtrl) {
        var capitalize = function(inputValue) {
          if (inputValue == undefined) inputValue = '';
          var capitalized = inputValue.toUpperCase();
          if (capitalized !== inputValue) {
            modelCtrl.$setViewValue(capitalized);
            modelCtrl.$render();
          }
          return capitalized;
        }
        modelCtrl.$parsers.push(capitalize);
        capitalize(scope[attrs.ngModel]); // capitalize initial value
      }
    };
  });
