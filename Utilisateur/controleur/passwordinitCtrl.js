app.controller('passwordinitCtrl', function($scope, $rootScope, $routeParams, $location, toaster, Data, $modal) {
    $scope.utilisateurPass = {};
    $scope.ConnexionWithNewMdp = {
        email: '',
        password: ''
    }
    $scope.ConnexionWithNewMdp = function(customer) {
        Data.post('connectUser', {
            customer: customer
        }).then(function(results) {
            Data.toast(results);
            console.log(results)
            $location.path("/" + results.chemin);
            $rootScope.menu = '' + results.menuUnique;
            /* $rootScope.actionsMenue = results.actionMenue;*/
            $rootScope.sousmenu = '/' + results.sousmenu;
            /* $cookieStore.put('lastVal', $rootScope.actionsMenue); */

        })
    };

    $scope.EnregistrementPassword = function(password) {
        if (password.password === 'saham' || password.password === 'SAHAM') {
            toaster.pop('error', "Désolé", 'Vous ne pouvez utiliser ce mot de passe. Veuillez choisir un autre');
        } else {
            var connexionPass = {
                pseudo: $rootScope.pseudoVerif,
                password: password.password
            }
            console.log(connexionPass);
            Data.put('passwordModif/' + $rootScope.uidVerif, connexionPass).then(function(result) {
                Data.toast(result);
                $scope.ConnexionWithNewMdp(connexionPass);
            })
        }
    };
    $scope.cancelPasswordInit = function(uidVerif) {
        console.log(uidVerif);
        Data.put('logoutPassword/' + uidVerif, {
            table: 'user_auth'
        }).then(function(resultPwd) {
            console.log(resultPwd);
            if (resultPwd.status == 'success') {

                Data.toast(results);
            }
            $rootScope.authenticated = false;
            $rootScope.menus = "";
            rootPathFalse = false;
            $rootScope.pseudoVerif = 'undefined';
            $rootScope.uidVerif = 'undefined';
            $rootScope.passwordVerifNumber = 'undefined';
            $location.path("/login");
        })

    }

});