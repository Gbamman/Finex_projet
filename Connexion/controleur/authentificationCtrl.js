app.controller('authCtrl', function($scope, $rootScope, $routeParams, $location, toaster, Data, Data2, contratFactory, $modal, $timeout, ngDialog, $filter, $window, datetime) {
    
    if ($rootScope.uid > 0) {
        Data.put('logout/' + $rootScope.uid, {
            table: 'user_auth'
        }).then(function(results) {
            /* Data.toast(results);*/
            $rootScope.authenticated = false;
            /*$cookieStore.remove('lastVal');*/
            $rootScope.menus = "";
            $rootScope.uid = "undefined";
            rootPathFalse = false;
            $location.path("/login");
        });
    };

    /*sahgescredit*/
    $scope.connexion = {
        email: '',
        password: ''
    }
    
    $scope.connexion = function(customer) {
        var passwordUserInput = customer.password;
        Data.post('connectUser', {
            customer: customer
        }).then(function(results) {
            if (results.uidVerif > 0) {
                $location.path("/passwordinit");
            } else {
                if (results.status != 'success') {
                    Data.toast(results);
                };
                console.log(results)
                $location.path("/" + results.chemin);
                $rootScope.menu = '' + results.menuUnique;
                /* $rootScope.actionsMenue = results.actionMenue;*/
                $rootScope.sousmenu = '/' + results.sousmenu;
                /* $cookieStore.put('lastVal', $rootScope.actionsMenue); */
            }
        })
    };
});