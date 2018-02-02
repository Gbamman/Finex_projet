app.controller('logout', function($scope, $rootScope, Data) {
    Data.put('logout/' + $rootScope.uid, {
        table: 'user_auth'
    }).then(function(results) {
        if (results.status == 'success') {

            Data.toast(results);
        }
        $rootScope.authenticated = false;
        $rootScope.menus = "";
        rootPathFalse = false;
        $location.path("/login");
    })

});

/*if ($rootScope.uid >0) {}*/
/*</tr>*/