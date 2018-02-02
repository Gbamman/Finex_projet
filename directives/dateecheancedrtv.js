app.directive('echeanceDate', function($filter, $window, $parse, toaster) {
    return {
        require: '?ngModel',
        restrict: 'A',
        compile: function() {
            var moment = $window.moment;
            var getter, setter;
            return function(scope, element, attrs, ngModel) {

                // If the ngModel directive is used, then set the initial value and keep it in sync   
                if (ngModel) {
                    element.on('blur', function(event) {

                        var dateactualise1 = moment().add(element.val(), 'month').format('DD/MM/YYYY');
                        var duree = parseInt(scope.product.duree) + 2;
                        var dateactualise = moment(scope.product.dateeffet, 'DD/MM/YYYY').add(duree, 'month').format('DD/MM/YYYY');
                        if (moment(scope.product.dateeffet, "DD/MM/YYYY").isValid()) {
                            scope.$apply(function() {
                                var date2 = $parse('product.dateecheance').assign(scope, dateactualise);
                            });
                        };
                        tabdeb = (scope.product.dateeffet.split(/[- //]/));
                        Odeb = new Date(tabdeb[2], parseInt(tabdeb[1] - 1), tabdeb[0]);
                        Ofin = new Date();

                        console.log('Date debut', Odeb);
                        console.log('Date fin', Ofin);
                        if (Odeb < Ofin) {
                            scope.$apply(function() {
                                var date2 = $parse('product.dateeffet').assign(scope, scope.product.dateeffet);
                            });
                        }

                        /*scope.product.duree=(parseInt(moment(scope.product.dateecheance,'DD/MM/YYYY').get('month'))-parseInt(moment(scope.product.dateeffet,'DD/MM/YYYY').get('month')))*/
                        // console.log(dateactualise);
                        var verif = ["2", "36"];
                        if (verif.indexOf(scope.idnomgroup) === -1) {
                            var date2, effet_day, effet_month, effet_year;
                            date2 = scope.product.dateeffet.split('/');
                            var date = scope.finalTotal().datenaissance.split('/'),
                                exepnse_day, expense_month, expense_year;
                            effet_day = parseInt(date2[0]);
                            effet_month = parseInt(date2[1]);
                            effet_year = parseInt(date2[2]);
                            expnse_day = parseInt(date[0]);
                            expense_month = parseInt(date[1]);
                            expense_year = parseInt(date[2]);
                            DateEffetReel = parseInt(effet_year)
                            /*scope.$watch(scope.product.duree, function(nv,ov) { })
                            if (nv!=ov) { }*/
                            var birth = moment([expense_year, expense_month, expnse_day]);
                            var effet = moment([effet_year, effet_month, effet_day]);
                            var age = parseInt(birth.from(effet));
                            var ageInferieureValid = (isNaN(age) === true) ? 1 : age;

                            if (ageInferieureValid < parseInt(scope.parametre[0].agemini)) {
                                toaster.pop('error', "Attention", 'Cette Personne est encore mineure');
                                element.css('background', 'pink');
                                element[0].value = "";


                            } else {
                                scope.product.datenaissance = $filter('date')(scope.product.datenaissance, "dd/MM/yyyy");
                                element.css('background', '#ffffff');
                            }
                            if (moment(scope.product.dateecheance, "DD/MM/YYYY").isValid()) {
                                var Echeancedate = scope.product.dateecheance.split('/'),
                                    echeanceDay, echeanceMonth, echeanceYear;
                                echeanceDay = parseInt(Echeancedate[0]);
                                echeanceMonth = parseInt(Echeancedate[1]);
                                echeanceYear = parseInt(Echeancedate[2]);
                                var echeanceVerificaton = moment([echeanceYear, echeanceMonth, echeanceDay]);
                                var verificationNombreContrat = parseInt(birth.from(echeanceVerificaton));
                                var ageSuprerieureValid = (isNaN(verificationNombreContrat) === true) ? 1 : verificationNombreContrat;
                                if (ageSuprerieureValid >= parseInt(scope.parametre[0].agemaxi)) {
                                    toaster.pop('error', "Attention", 'Personne trop âgée');
                                    element.css('background', 'pink');
                                    element[0].value = "";


                                } else {
                                    scope.product.datenaissance = $filter('date')(scope.product.datenaissance, "dd/MM/yyyy");
                                    element.css('background', '#ffffff');
                                }
                            }
                        }

                        // console.log(age+'Et le temps restant'+ verificationNombreContrat );

                    })
                }
            }
        }
    }
});