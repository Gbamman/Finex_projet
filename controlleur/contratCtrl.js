app.controller('contratCtrl', function($scope, $rootScope, $routeParams, $location, $http, Data2, Data, contratFactory, $modal, ngDialog, $timeout) {
    $scope.openDefault = function() {
        ngDialog.open({
            template: 'firstDialogId',
            controller: 'authCtrl',
            className: 'ngdialog-theme-default'
        });

    };


    $scope.effacercontrat = function(product) {
        if (confirm("Est vous sure de vouloir supprimer ce contrat")) {
            Data2.delete("effacer/" + product.idcontrat).then(function(result) {
                /* Data2.toast(results);*/
                $scope.products = _.without($scope.filtered, _.findWhere($scope.filtered, {
                    idcontrat: product.idcontrat
                }));

            });
        }
    };


    $scope.modifier = function(p, size) {
        var modalInstance = $modal.open({
            templateUrl: 'vue/contratedith.html',
            controller: 'edithController',
            size: 'lg',
            resolve: {
                item: function() {
                    return p;
                }
            }
        });
        modalInstance.result.then(function(selectedObject) {
            if (selectedObject.save == "insert") {
                $scope.products.push(selectedObject);
                $scope.products = $filter('orderBy')($scope.products, 'idcontrat', 'reverse');
            } else if (selectedObject.save == "update") {
                p.idcontrat = selectedObject.idcontrat;
                p.numcontrat = selectedObject.numcontrat;
                p.nom = selectedObject.nom;
                p.prenom = selectedObject.prenom;
                p.dateeffet = selectedObject.dateeffet;
                p.capital = selectedObject.capital;
                p.duree = selectedObject.duree;
                p.primeassurance = selectedObject.primeassurance;
                p.status = selectedObject.status;
            }
        });

    };



    $scope.enregistrement = function(contrat) {
        Data2.post('menus', contrat).then(function(data) {
            if (data.status == "succes") {
                $location.path('listecontrat');
            }

        });
    }
    contratFactory.getContrats().then(function(data) {

        $scope.products = data.data;
        console.log(data);
        /* $scope.list = data.data;*/

        $scope.currentPage = 1; //current page
        $scope.entryLimit = 5; //max no of items to display in a page
        $scope.filteredItems = $scope.products.length; //Initially for no filter  
        $scope.totalItems = $scope.products.length;


    });

    $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
    };
    $scope.filter = function() {
        $timeout(function() {
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };

});