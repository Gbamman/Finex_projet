app.directive("ngFileSelect", function() {

    return {
        link: function($scope, el) {

            el.bind("change", function(e) {

                $scope.file = (e.srcElement || e.target).files[0];

                $scope.getFile();
            })

        }

    }


})

app.directive("ngContratSelect", function() {
    return {
        restrict: 'A',
        link: function($scope, el) {
            el.bind("click", function(e) {
                $scope.ngContratSelect = function(contrat) {
                    $scope.product = angular.copy(contrat);
                    $scope.$apply();
                }
            })

        }
    }
});

app.directive('dateFormat', function($filter, $window, $parse, $timeout, toaster) {
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, ngModelController) {
            ngModelController.$parsers.push(function(data) {
                //View -> Model
                return data;
            });
            ngModelController.$formatters.push(function(data) {
                //Model -> View
                return $filter('date')(data, "DD/MM/YYYY");
            });
        }
    }
});
app.directive('dateField', function($filter) {
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, ngModelController) {
            ngModelController.$parsers.push(function(data) {
                var date = Date.parseExact(data, 'yyyy-MM-dd');
                ngModelController.$setValidity('date', date != null);
                return date;
            });
            ngModelController.$formatters.push(function(data) {

                return $filter('date')(data, "yyyy-MM-dd");
            });
        }
    }
});
app.directive('animateOnChange', function($animate) {
    return function(scope, elem, attr) {
        scope.$watch(attr.animateOnChange, function(nv, ov) {
            if (nv != ov) {
                /* console.log(nv +'******et******'+ov+'***');*/
                var c = 'change-up';
                $animate.addClass(elem, c, function() {
                    $animate.removeClass(elem, c);
                });
            } else if (nv === ov) {
                /* console.log($animate); */
            }
        });

    }
});

/*
app.directive('calculPrime',function(){
  // Runs during compile
  return  function(scope, elem, attr) {
    // name: '',
    // priority: 1,
    // terminal: true,
    // scope: {}, // {} = isolate, true = child, false/undefined = no change
    // controller: function($scope, $element, $attrs, $transclude) {},
    // require: 'ngModel', // Array = multiple requires, ? = optional, ^ = check parent elements
    // restrict: 'A', // E = Element, A = Attribute, C = Class, M = Comment
    // template: '',
    // templateUrl: '',
    // replace: true,
    // transclude: true,
    // compile: function(tElement, tAttrs, function transclude(function(scope, cloneLinkingFn){ return function linking(scope, elm, attrs){}})),
     scope.$watch(attr.calculPrime, function(nv,ov) {
          if (nv!=ov) {
              console.log(nv +'******et******'+ov+'***');
               /* var c = 'change-up';
                $animate.addClass(elem,c, function() {
                $animate.removeClass(elem,c);
            });
          }
        });
      
    }
  
});*/

app.directive('processOnEnter', function() {
    return {
        restrict: 'A',
        link: function($scope, el, attrs) {
            el.on('click', function() {
                var parent = el.toggleClass("open");
                var enfant = el.find('sidebar-nav-mini-hide').toggleClass("sidebar-nav-ripple animate");
            })
        }
    }
});

app.directive('logoutPop', function() {
    return {
        restrict: 'A',
        link: function($scope, el, attrs) {
            el.on('click', function() {

            })
        }
    }
});
app.directive('printPrecess', function() {
    return {
        restrict: 'A',
        link: function($scope, el, attrs) {
            el.on('click', function() {
                /* $scope.product = angular.copy(el);*/
                console.log();
            })
        }
    }
});
app.directive('admistrationAction', function() {
    return {
        restrict: 'A',
        link: function($scope, el, attrs) {
            el.on('click', function() {
                el.toggleClass('active');
            })
        }
    }
});
app.directive('themesClass', function() {
    return {
        restrict: 'A',
        link: function($scope, el, attrs) {
            el.on('click', function() {
                el.toggleClass('active');
                console.log('Ready');
            })
        }
    }
});
app.directive('validatePhone', function() {
    var PHONE_REGEXP = /^[789]\d{9}$/;
    return {
        link: function(scope, elm) {
            elm.on("keyup", function() {
                var isMatchRegex = PHONE_REGEXP.test(elm.val());
                if (isMatchRegex && elm.hasClass('warning') || elm.val() == '') {
                    elm.removeClass('warning');
                } else if (isMatchRegex == false && !elm.hasClass('warning')) {
                    elm.addClass('warning');
                }
            });
        }
    }
});
app.directive('dynamiqueAgence', function() {
    return {
        restrict: 'A',
        require: 'ngModel',
        scope: true, // to mimic your directive - doesn't have to be isolate scope
        link: function(scope, elm, attrs) {}
    }
});