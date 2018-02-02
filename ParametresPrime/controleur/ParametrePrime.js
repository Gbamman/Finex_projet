app.controller('ParamPrimeCtrl', function($scope, $rootScope, $routeParams, $location, Data, contratFactory, $modal, ngDialog, $timeout, $filter, toaster) {
    $scope.parametrePrime = {};
    var verification = '0';
    $scope.DeleteParametrePrime = function(DeleteParametrePrime) {
        // console.log(DeleteParametrePrime);
        if (confirm("Est vous sure de vouloir supprimer cette Parametre de Prime ?")) {
            Data.delete("DeleteParamePrimePath/" + DeleteParametrePrime.idparam).then(function(results) {
                Data.toast(results);
                $scope.paramateresPrimes = _.without($scope.paramateresPrimes, _.findWhere($scope.paramateresPrimes, {
                    idparam: DeleteParametrePrime.idparam
                }));
                /* $scope.products = _.without($scope.products, _.findWhere($scope.products, {id:product.id}));*/

            });
        }
    };


    $scope.changerEtatTypePret = function(TypePretStatus) {
        TypePretStatus.etat = (TypePretStatus.etat == 0 ? 1 : 0);
        Data.put('TypePretUpdate/' + TypePretStatus.idtypepret, {
            etat: TypePretStatus.etat,
            table: 'typepret'
        }).then(function(result) {
            Data.toast(result)
        });;
    };


    Data.get('gestionParametrePrime').then(function(results) {


        // console.log(results);

        $scope.paramateresPrimes = results.data;
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 5; //max no of items to display in a page
        $scope.filteredItems = $scope.paramateresPrimes.length; //Initially for no filter  
        $scope.totalItems = $scope.paramateresPrimes.length;
    });


    $scope.menusAction = function(valeur) {
        verification = valeur;
        // console.log(valeur);
    }

    $scope.editParametrePrime = function(p, size) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            var cheminmenuedit = 'ParametresPrime/vue/ParametrePrimeEdit.html';
            var controlmenuedit = 'ParametresAdmin';
            var modalInstance = $modal.open({
                templateUrl: cheminmenuedit,
                controller: controlmenuedit,
                size: size,
                resolve: {
                    item: function() {

                        return p;
                    }
                }
            });
            modalInstance.result.then(function(selectedObject) {
                if (selectedObject.save == "insert") {
                    if (selectedObject.verif == 'paramprimeInsertion') {
                        $scope.paramateresPrimes.push(selectedObject);
                        $scope.paramateresPrimes = $filter('orderBy')($scope.paramateresPrimes, 'idparam', 'reverse');
                    };
                } else if (selectedObject.save == "update") {
                    if (selectedObject.verif == 'paramprimeModif') {
                        p.idparam = selectedObject.idparam;
                        p.accessoires = selectedObject.accessoires;
                        p.capitalmax = selectedObject.capitalmax;
                        p.fraisacquisition = selectedObject.fraisacquisition;
                        p.fraisgestion = selectedObject.fraisgestion;
                        p.idbanque = selectedObject.idbanque;
                        p.idtypepret = selectedObject.idtypepret;
                        p.libelleBanque = selectedObject.libelleBanque;
                        p.primeplanchet = selectedObject.primeplanchet;
                        p.tauxprime = selectedObject.tauxprime;
                        p.tauxperteemploi = selectedObject.tauxperteemploi;
                        p.type_de_pret = selectedObject.type_de_pret;
                        p.agemaxi = selectedObject.agemaxi;
                        p.agemini = selectedObject.agemini;
                        p.commission = selectedObject.commission;
                        p.quotepartaccessoires = selectedObject.quotepartaccessoires;
                        p.fraisaperition = selectedObject.fraisaperition;

                    }
                }
            });
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }
})