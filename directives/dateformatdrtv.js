app.directive('validDate', function($filter, $window, $parse, $timeout, toaster) {
    return {
        require: '?ngModel',
        restrict: 'A',
        compile: function() {
            var moment = $window.moment;
            var getter, setter;
            return function(scope, element, attrs, ngModel) {
                //Declaring the getter and setter
                getter = $parse(attrs.ngModel);
                setter = getter.assign;
                if (ngModel) {
                    element.on('blur', function(event) {
                        var date = moment().utc($filter('date')(element.val(), "DD/MM/yyyy"));
                        var date1 = moment($filter('date')(element.val(), "DD/MM/yyyy"));
                        var dateinit = moment("01/01/1900");
                        if (date && moment(element.val(), "DD/MM/YYYY").isValid()) {
                            if (date1 < dateinit) {
                                element.css('background', 'pink');
                                toaster.pop('error', "Attention", 'Cette date est révolue');

                            } else {
                                element.css('background', 'white');
                                element[0].value = $filter('date')(element.val(), "dd/MM/yyyy");
                                // console.log('change value to ' +moment(date) + 'Encore' +dateinit);
                                var newValue = element.val();
                                scope.$apply(function() {
                                    setter(scope, newValue);
                                });
                            }

                        } else { //show an error and clear the value
                            /*toaster.pop('Info', "Information", 'Seul le format JJ/MM/AAAA est autorisé');*/

                            // console.log('INCORRECT VALUE ENTERED');
                            element.css('background', 'pink');
                            element[0].value = "";
                            scope.$apply(function() {
                                setter(scope, '');
                            });
                        }
                    });
                }
            };
        }
    };
});