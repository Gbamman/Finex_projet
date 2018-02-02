app.controller('prestationCtrl', function($scope, $rootScope, Data, $modal, $filter) {
    $scope.prestation = {};
    Data.get('getPrestation').then(function(result) { // Ici nous recupérons la liste de groupes utilisateurs et gérons la pagination.
        /* verification=result.verification;*/
        // console.log(result)
        if (result.status == 'success') {
            $scope.prestations = result.data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 5; //max no of items to display in a page
            $scope.filteredItems = $scope.prestations.length; //Initially for no filter  
            $scope.totalItems = $scope.prestations.length;
        }
    });
    //deletaPrestation
    $scope.deletaPrestation = function(prestationDelete) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            console.log(prestationDelete);
            if (confirm("Est vous sure de vouloir supprimer la prestation : " + prestationDelete.libelle + "?")) {
                Data.delete("deletePresatation/" + prestationDelete.idprestation).then(function(results) {
                    Data.toast(results);
                    $scope.prestations = _.without($scope.prestations, _.findWhere($scope.prestations, {
                        idprestation: prestationDelete.idprestation
                    }));
                    /* $scope.products = _.without($scope.products, _.findWhere($scope.products, {id:product.id}));*/

                });
            }
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    };
    $scope.addPrestation = function(prestations, taille) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {

            cheminPrestationEdit = 'Prestation/vue/prestationAdmin.html';
            controlPrestationEdit = 'prestationAdminCtrl';

            var modalInstance = $modal.open({
                templateUrl: cheminPrestationEdit,
                controller: controlPrestationEdit,
                size: taille,
                resolve: {
                    item: function() {

                        return prestations;
                    }
                }
            });

            modalInstance.result.then(function(selectedObject) {
                if (selectedObject.save == "insert") {

                    if (selectedObject.verif == "prestationInsert") {
                        $scope.prestations.push(selectedObject);
                        $scope.prestations = $filter('orderBy')($scope.prestations, 'idprestation', 'reverse');
                    }
                } else if (selectedObject.save == "update") {

                    if (selectedObject.verif == "prestationModif") {
                        prestations.idprestation = selectedObject.idprestation;
                        prestations.libelle = selectedObject.libelle;
                        prestations.idetat = selectedObject.idetat;
                        prestations.etatContratLibelle = selectedObject.etatContratLibelle;

                    };
                }

            });


        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }


})