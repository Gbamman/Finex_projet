app.controller('banqueCtrl', function($scope, $rootScope, $routeParams, $location, $http, Data2, Data, contratFactory, $modal, ngDialog, $timeout, $filter) {
    $scope.banque = {};
    /*$scope.ImageBanque='Banque/imagesBanque/Banque398d6abe516d49d82c5e6bd6d27dcc90.jpg';*/
    $scope.banqueDelete = function(BanqueDelete) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            // console.log(BanqueDelete);
            if (confirm("Est vous sure de vouloir supprimer cette banque " + BanqueDelete.libelle + "?")) {
                Data.post("effacerbanque", BanqueDelete).then(function(results) {
                    Data.toast(results);
                    $scope.banques = _.without($scope.banques, _.findWhere($scope.banques, {
                        id: BanqueDelete.id
                    }));
                    /* $scope.products = _.without($scope.products, _.findWhere($scope.products, {id:product.id}));*/

                });
            }
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    };
    var cheminBanqueEdit = '';
    var controlBanqueEdit = '';
    var verification = '1';

    $scope.Agencelist = function(banqueId) {
        $scope.valeur = banqueId;
        Data.get('agence/' + banqueId).then(function(results) {
            $scope.agences = results.data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 5; //max no of items to display in a page
            $scope.filteredItems = $scope.agences.length; //Initially for no filter  
            $scope.totalItems = $scope.agences.length;
        });
    }

    $scope.changerEtatBanque = function(banque) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            banque.etat = (banque.etat == "Actif" ? "Inactif" : "Actif");
            Data.put('banqueUpdate/' + banque.id, {
                etat: banque.etat,
                table: 'banque'
            }).then(function(result) {
                Data.toast(result)
            })
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        };
    }
    $timeout(function() {}, 5000);

    Data.get('gestionBanqueAdmin').then(function(results) {
        if (results.status == 'success') {
            $scope.banques = results.data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 5; //max no of items to display in a page
            $scope.filteredItems = $scope.banques.length; //Initially for no filter  
            $scope.totalItems = $scope.banques.length;
        }
    });

    $scope.banqueEtat = function(verif) {
        verification = verif;

    }

    $scope.saveBanque = function(p, size) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            if (verification == '1') {
                cheminBanqueEdit = 'Banque/vue/gestionBanqueAdmin.html';
                controlBanqueEdit = 'gestionBanqueAdminCtrl';
            } else if (verification == '2') {
                cheminBanqueEdit = 'Banque/vue/gestionAgenceAdmin.html';
                controlBanqueEdit = 'AgenceAdminCtrl';
            }
            var modalInstance = $modal.open({
                templateUrl: cheminBanqueEdit,
                controller: controlBanqueEdit,
                size: size,
                resolve: {
                    item: function() {

                        return p;
                    }
                }
            });
            modalInstance.result.then(function(selectedObject) {
                if (selectedObject.save == "insert") {
                    if (selectedObject.verif == "BanqueInsert") {
                        $scope.banques.push(selectedObject);
                        $scope.banques = $filter('orderBy')($scope.banques, 'id', 'reverse');
                    }
                    if (selectedObject.verif == "agenceInsert") {
                        $scope.agences.push(selectedObject);
                        $scope.agences = $filter('orderBy')($scope.agences, 'idagence', 'reverse');
                    }
                } else if (selectedObject.save == "update") {
                    if (selectedObject.verif == "BanqueModif") {
                        p.id = selectedObject.id;
                        p.libelle = selectedObject.libelle;
                        p.etat = selectedObject.etat;
                        p.logo = selectedObject.logo;
                    };
                    if (selectedObject.verif == "agenceUpdate") {
                        p.idagence = selectedObject.idagence;
                        p.libelleagence = selectedObject.libelleagence;
                        p.libellebanque = selectedObject.libellebanque;
                        p.ville = selectedObject.ville;
                    };
                }

            });


        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    };
});