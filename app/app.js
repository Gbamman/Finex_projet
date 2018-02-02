var app = angular.module('myApp', ['ngRoute', 'ngAnimate', 'toaster', 'ui.bootstrap', 'ngMessages', 'ngDialog', 'ui.mask', 'datetime', 'ngCookies', 'countTo',
    'ngSanitize', 'com.2fdevs.videogular',
    'com.2fdevs.videogular.plugins.controls'
]);
app.filter('startFrom', function() {
    return function(input, start) {
        if (input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});

app.filter('groupBy', function() {
    var results = {};
    return function(data, key) {
        if (!(data && key)) return;
        var result;
        if (!this.$id) {
            result = {};
        } else {
            var scopeId = this.$id;
            if (!results[scopeId]) {
                results[scopeId] = {};
                this.$on("$destroy", function() {
                    delete results[scopeId];
                });
            }
            result = results[scopeId];
        }

        for (var groupKey in result)
            result[groupKey].splice(0, result[groupKey].length);

        for (var i = 0; i < data.length; i++) {
            if (!result[data[i][key]])
                result[data[i][key]] = [];
            result[data[i][key]].push(data[i]);
        }

        var keys = Object.keys(result);
        for (var k = 0; k < keys.length; k++) {
            if (result[keys[k]].length === 0)
                delete result[keys[k]];
        }
        return result;
    };
});
/*app.config(['ngDialogProvider', function (ngDialogProvider) {
ngDialogProvider.setDefaults({
className: 'ngdialog-theme-default',
plain: false,    
showClose: true,
closeByDocument: true,
closeByEscape: true,
appendTo: false,
preCloseCallback: function () {
console.log('default pre-close callback');
}
});
}]);
*/
app.filter('spaceless', function() {
    return function(li) {
        if (li) {
            return li.replace(/\s+/g, '-');
        }
    }
});
app.config(['$routeProvider',
        function($routeProvider) {
            $routeProvider.
            when('/login', {
                    title: 'App1',
                    templateUrl: 'Connexion/vue/page_special_login.html',
                    controller: 'authCtrl'
                }).when('/passwordinit', {
                    title: 'App1',
                    templateUrl: 'Utilisateur/vue/passwordinit.html',
                    controller: 'passwordinitCtrl'
                }).when('/dashbord', {
                    title: 'App1',
                    templateUrl: 'dashbord/vue/dashbord.html',
                    controller: 'dashbordCtrl'
                }).when('/logout', {
                    title: 'App1',
                    templateUrl: 'Utilisateur/vue/logout.html',
                    controller: 'logout'
                }).when('/bia', {
                    title: 'App1',
                    templateUrl: 'vue/BIA.html',
                    controller: 'contratControlleur'
                }).when('/etatproduction', {
                    title: 'App1',
                    templateUrl: 'vue/etatProduction.php',
                    controller: 'etatproductionCtrl'
                }).when('/gestiondesmenus', {
                    title: 'App1',
                    templateUrl: 'Menus/vue/gestionMenus.html',
                    controller: 'MenusCtrl'
                }).when('/gestionprofil', {
                    title: 'App1',
                    templateUrl: 'Utilisateur/vue/profil.html',
                    controller: 'ProfilCtrl'
                }).when('/typepretpath', {
                    title: 'App1',
                    templateUrl: 'typepretFolder/vue/typepret.html',
                    controller: 'TypePretCtrl'
                }).when('/gestioncoassureur', {
                    title: 'App1',
                    templateUrl: 'Gestion_CoAss/vue/GestionCoAss.html',
                    controller: 'coassureurCtrl'
                }).when('/listedescontrats', {
                    title: 'App1',
                    templateUrl: 'vue/home.html',
                    controller: 'contratControlleur'
                }).when('/traitementdescontrats', {
                    title: 'App1',
                    templateUrl: 'vue/home2.html',
                    controller: 'contratControlleur'
                })
                .when('/parametrescalculprime', {
                    title: 'App1',
                    templateUrl: 'ParametresPrime/vue/ParametrePrime.html',
                    controller: 'ParamPrimeCtrl'
                }).when('/questionsmedicales', {
                    title: 'App1',
                    templateUrl: 'questionsMedi/vue/questionMedi.html',
                    controller: 'QuestionMediCtrl'
                }).when('/menus', {
                    title: 'App1',
                    templateUrl: 'vue/menues.html',
                    controller: 'contratCtrl'
                }).when('/sinistre', {
                    title: 'App1',
                    templateUrl: 'Sinistre/vue/sinistre.html',
                    controller: 'sinistreCtrl'
                }).when('/prestation', {
                    title: 'App1',
                    templateUrl: 'Prestation/vue/prestation.html',
                    controller: 'prestationCtrl'
                }).when('/utilisateurs', {
                    title: 'App1',
                    templateUrl: 'Utilisateur/vue/utilisateurs.html',
                    controller: 'userMannageCtrl'
                })
                .when('/listebanque', {
                    title: 'App1',
                    templateUrl: 'Banque/vue/banque.html',
                    controller: 'banqueCtrl'
                }).when('/importation', {
                    title: 'App1',
                    templateUrl: 'importExcel/vue/importContent.html',
                    controller: 'importsCtrl'
                }).when('/help', {
                    title: 'App1',
                    templateUrl: 'help/vue/help.html',
                    controller: 'helpCtrl'
                }).when('/videosinistre', {
                    title: 'App1',
                    templateUrl: 'help/vue/help.html',
                    controller: 'helpCtrl'
                }).when('/gestionbanquesvideos', {
                    title: 'App1',
                    templateUrl: 'help/vue/help.html',
                    controller: 'helpCtrl'
                }).when('/gestiondesagences', {
                    title: 'App1',
                    templateUrl: 'Banque/vue/gestionAgence.html',
                    controller: 'gestionAgenceCtrl'
                }).when('/produits', {
                    title: 'App1',
                    templateUrl: 'Produits/vue/produits.html',
                    controller: 'produitCtrl'
                }).when('/statistique', {
                    title: 'App1',
                    templateUrl: 'PHPExcel/Examples/01simple-download-xlsx.php',
                    controller: 'etatproductionCtrl'
                }).otherwise({
                    redirectTo: '/login'
                });
        }
    ])
    .run(function($rootScope, $location, Data, $routeParams, $timeout, ActionSurMenue, $cookies, $cookieStore) {
        $rootScope.$on("$routeChangeStart", function(event, next, current) {
            $rootScope.authenticated = false;
            var rootPathTrue = false;
            var rootPathFalse = false;
            var menus = [];
            $rootScope.changerStatusUsers = function(utilisateur) {
                utilisateur.etat = (utilisateur.etat == "Actif" ? "Inactif" : "Actif");
                Data.put('ModificationUsures/' + utilisateur.uid, {
                    etat: utilisateur.etat
                });
            };

            $rootScope.logout = function(uid) {
                if (confirm("Etes-vous sure de vouloir vous deconnecter?")) {
                    Data.put('logout/' + uid, {
                        table: 'user_auth'
                    }).then(function(results) {
                        $rootScope.actionsMenue = 'undefined';
                        $rootScope.uid = 'undefined';
                        $rootScope.etat = 'undefined';
                        $rootScope.name = 'undefined';
                        $rootScope.pseudo = 'undefined';
                        $rootScope.surname = 'undefined';
                        $rootScope.etat = 'undefined';
                        $rootScope.idnomgroup = 'undefined';
                        $rootScope.idbanque = 'undefined';
                        $rootScope.idagence = 'undefined';
                        $rootScope.droit = 'undefined';
                        $rootScope.action = 'undefined';
                        $rootScope.menuUnique = 'undefined';
                        $rootScope.sousmenus = 'undefined';
                        console.log($rootScope.actionsMenue);
                        Data.toast(results);
                        $rootScope.authenticated = false;
                        $rootScope.menus = "";

                        rootPathFalse = false;
                        $location.path("/login");
                    });
                }
            }

            Data.get('session').then(function(results) {
                if (results.uid > 0) {
                    var fullRoute = next.$$route.originalPath;
                    $rootScope.authenticated = true;
                    $rootScope.uid = results.uid;
                    $rootScope.name = results.name;
                    $rootScope.pseudo = results.pseudo;
                    $rootScope.surname = results.surname;
                    $rootScope.etat = results.etat;
                    $rootScope.idnomgroup = results.idnomgroup;
                    $rootScope.idbanque = results.idbanque;
                    $rootScope.idagence = results.idagence;
                    $rootScope.droit = results.droit;
                    $rootScope.action = results.action;
                    $rootScope.menuUnique = results.menuUnique;
                    $rootScope.sousmenus = results.sousmenus;
                    $timeout(function() {});
                    Data.get('leftMenues').then(function(results) {
                        menus = results.data;
                        $rootScope.menus = menus;
                        if (typeof $rootScope.actionsMenue == 'undefined' && $rootScope.uid > 0) {
                            var cheminParDefaut = _.where(menus, {
                                nomcourt: fullRoute.replace('/', '')
                            });
                            $rootScope.nomcourt = cheminParDefaut[0].nomcourt;
                            $rootScope.menu = cheminParDefaut[0].menu;
                            $rootScope.actionsMenue = cheminParDefaut[0].actionMenue;
                            $rootScope.sousmenu = '/' + cheminParDefaut[0].libelleSousMenue;
                            console.log(cheminParDefaut);

                        };
                    })
                    angular.forEach($rootScope.menus, function(value, key) {
                        if (fullRoute == '/' + value.nomcourt) {
                            $location.path("/" + value.nomcourt)
                            $rootScope.nomcourt = value.nomcourt;
                            $rootScope.menu = value.menu;
                            $rootScope.actionsMenue = value.actionMenue;

                            $rootScope.sousmenu = '/' + value.libelleSousMenue;
                            rootPathTrue = true;
                            return rootPathTrue;
                        }

                    })

                    if (rootPathTrue == true) {

                    } else {
                        angular.forEach($rootScope.menus, function(value, key) {
                            if (fullRoute != '/' + value.nomcourt) {
                                $rootScope.menu = value.menu;
                                $rootScope.nomcourt = value.nomcourt;
                                $rootScope.actionsMenue = value.actionMenue;
                                /* $cookieStore.put('lastVal',$rootScope.actionsMenue);*/
                                $rootScope.sousmenu = '/' + value.libelleSousMenue;
                                $location.path("/" + value.chemin);
                                rootPathFalse = true;
                                return rootPathFalse;
                            }

                        })

                    }
                } else if (results.uidVerif > 0) {
                    $location.path("/passwordinit");
                    $rootScope.pseudoVerif = results.pseudoVerif;
                    $rootScope.uidVerif = results.uidVerif;
                    $rootScope.passwordVerifNumber = results.passwordVerifNumber;
                    console.log(results);
                } else {
                    var nextUrl = next.$$route.originalPath;
                    if (nextUrl == '/bia' || nextUrl == '/etatproduction' || nextUrl == '/passwordinit') {

                    } else {
                        $location.path("/login");

                    }

                }

            });

        });
  });