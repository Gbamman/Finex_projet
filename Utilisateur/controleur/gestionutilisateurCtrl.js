app.controller('userMannageCtrl', function($scope, $rootScope, $routeParams, $location, $http, Data2, Data, contratFactory, $modal, ngDialog, $timeout, $filter, toaster) {
    $scope.utilisateur = {};
    $scope.actionmene = {};
    console.log($rootScope.actionsMenue);

    Data.get('gestionutilisteur').then(function(results) {
        if (results.status == "success") {

            $scope.utilisateurs = results.data;


            $scope.currentPage = 1; //current page
            $scope.entryLimit = 5; //max no of items to display in a page
            $scope.filteredItems = $scope.utilisateurs.length; //Initially for no filter  
            $scope.totalItems = $scope.utilisateurs.length;
            console.log($scope.totalItems);

        }
    });

    $scope.deleteUsers = function(utilisateur) {
        console.log(utilisateur);
        if (confirm("Est vous sure de vouloir supprimer cet utilisateur ?")) {
            Data.delete("effacerusers/" + utilisateur.uid).then(function(results) {
                Data.toast(results);
                $scope.utilisateurs = _.without($scope.utilisateurs, _.findWhere($scope.utilisateurs, {
                    uid: utilisateur.uid
                }));
                /* $scope.products = _.without($scope.products, _.findWhere($scope.products, {id:product.id}));*/

            });
        }
    };
    $scope.changerStatusUsers = function(utilisateur) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            utilisateur.etat = (utilisateur.etat == "Actif" ? "Inactif" : "Actif");
            Data.put('StatutUserUpdate/' + utilisateur.uid, {
                etat: utilisateur.etat,
                table: 'user_auth'
            }).then(function(result) {
                Data.toast(result)
            })
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        };
    }
    $scope.ReenisialierMdp = function(utilisateur) {
        console.log(utilisateur)
        Data.put('mdpmodifpath/' + utilisateur.uid, utilisateur).then(function(result) {
            Data.toast(result);
        })
    }

    $scope.ActionMeneButton = function(p, size) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            var modalInstance = $modal.open({
                templateUrl: 'actionMene/vue/actionmene.html',
                controller: 'actionmeneCtrl',
                size: size,
                resolve: {
                    item: function() {
                        return p;
                    }
                }
            });
            modalInstance.result.then(function(selectedObject) {

            });
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }
    $scope.newutilisteur = function(p, size) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            var modalInstance = $modal.open({
                templateUrl: 'Utilisateur/vue/inscription.html',
                controller: 'AdminiController',
                size: 'lg',
                resolve: {
                    item: function() {
                        return p;
                    }
                }
            });
            modalInstance.result.then(function(selectedObject) {
                if (selectedObject.save == "insert") {
                    $scope.utilisateurs.push(selectedObject);
                    $scope.utilisateurs = $filter('orderBy')($scope.utilisateurs, 'uid', 'reverse');
                    console.log(selectedObject);
                } else if (selectedObject.save == "update") {
                    p.uid = selectedObject.uid;
                    p.pseudo = selectedObject.pseudo;
                    p.name = selectedObject.name;
                    p.surname = selectedObject.surname;
                    p.sexe = selectedObject.sexe;
                    p.fonction = selectedObject.fonction;
                    p.email = selectedObject.email;
                    p.etat = selectedObject.etat;
                    p.droit = selectedObject.droit;
                    p.action = selectedObject.action;
                    p.phone = selectedObject.phone;
                    p.idbanque = selectedObject.idbanque;
                    p.idagence = selectedObject.idagence;
                    p.idnomgroup = selectedObject.idnomgroup;
                    console.log(p.name);
                    /* p.duree = selectedObject.duree;
                    p.primeassurance = selectedObject.primeassurance;*/

                }
            });
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    };
})