app.controller('sinistreCtrl', function($scope, $http, $rootScope, Data, $modal, $filter) {
    $scope.prestationdeclare = {};
    $scope.etatprestation = {}

    $scope.imprimerPrestation = function(sinistre) {
        $http({
            url: 'vue/sinistre.php',
            method: 'GET',
            params: {
                idsinistre: sinistre.idsinistre
            },
            responseType: 'arraybuffer',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Content-type': 'application/json',
                'Accept': 'application/pdf, application/x-pdf, application/acrobat, applications/vnd.pdf, text/pdf, text/x-pdf'
            }
        }).success(function(data, status, headers, config) {
            var Actionmene = 'Tirage du prestation N&deg;' + sinistre.idsinistre;
            Data.post('ActionmenePath', {
                Actionmene: Actionmene
            }).then(function(result) {
                console.log(result);
            })
            console.log("Get report data: " + data);
            var blob = new Blob([data], {
                type: "application/pdf, application/x-pdf, application/acrobat, applications/vnd.pdf, text/pdf, text/x-pdf"
            });
            saveAs(blob, "PRESTATION_" + sinistre.identifiantassure + ".pdf");

        })

    }
    $scope.searchContrat = function(criteres) {
        console.log(criteres);
        Data.post('SearchSinistrePath', {
            criteres: criteres
        }).then(function(result) {
            console.log(result);
            if (result.status == 'success') {
                $scope.sinistres = result.data;
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 5; //max no of items to display in a page
                $scope.filteredItems = $scope.sinistres.length; //Initially for no filter  
                $scope.totalItems = $scope.sinistres.length;

            } else {
                Data.toast(result);
                $scope.sinistres = result.data;
            }

        });
    };
    $scope.deleteSinistre = function(SinistreDelete) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            // console.log(BanqueDelete);
            if (confirm("Est vous sure de vouloir supprimer cette prestation?")) {
                Data.delete('deleteSinistre/' + SinistreDelete.idsinistre).then(function(results) {
                    Data.toast(results);
                    var Actionmene = 'Suppression de la prestation N&deg;' + SinistreDelete.idsinistre;
                    Data.post('ActionmenePath', {
                        Actionmene: Actionmene
                    }).then(function(result) {
                        console.log(result);
                    })
                    $scope.sinistres = _.without($scope.sinistres, _.findWhere($scope.sinistres, {
                        idsinistre: SinistreDelete.idsinistre
                    }));
                    /* $scope.products = _.without($scope.products, _.findWhere($scope.products, {id:product.id})); deleteSinistre*/

                });
            }
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    };
    Data.get('ensemblepices').then(function(result) {
        if (result.status == 'success') {
            $scope.quetionsmedicales = result.data;
            /*FAIRE LE TRAITEMENT POUR INTEGRER item.save*/


        }

    });

    Data.get('GetSinistre').then(function(results) {
        $scope.sinistres = results.data;

        $scope.currentPage = 1; //current page
        $scope.entryLimit = 5; //max no of items to display in a page
        $scope.filteredItems = $scope.sinistres.length; //Initially for no filter  
        $scope.totalItems = $scope.sinistres.length;
        /*for (var i = 0; i <  $scope.sinistres.length; i++) {
        $scope.sinistres[i].pieces;
        console.log($scope.sinistres[i].pieces.split('@|'));

        };*/
    });
    $scope.etatprestation = function(etatprestationContent, taille) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {

            cheminsinistreEdit = 'EtatPrestation/vue/etatprestation.html';
            controlsinistreEdit = 'etatprestationCtrl';

            var modalInstance = $modal.open({
                templateUrl: cheminsinistreEdit,
                controller: controlsinistreEdit,
                size: taille,
                resolve: {
                    item: function() {

                        //return etatprestationContent;
                    }
                }
            });
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }

    //var pieces= .split('@|');
    console.log($scope.prestationdeclare.pieces);
    $scope.prestationDeclare = function(sinistres, taille) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {

            cheminsinistreEdit = 'Sinistre/vue/sinistreAdmin.html';
            controlsinistreEdit = 'sinistreAdminCtrl';

            var modalInstance = $modal.open({
                templateUrl: cheminsinistreEdit,
                controller: controlsinistreEdit,
                size: 'lg',
                resolve: {
                    item: function() {

                        return sinistres;
                    }
                }
            });

            modalInstance.result.then(function(selectedObject) {
                if (selectedObject.save == "insert") {

                    if (selectedObject.verif == "sinistreInsert") {
                        $scope.sinistres.push(selectedObject);
                        $scope.sinistres = $filter('orderBy')($scope.sinistres, 'idsinistre', 'reverse');
                    }
                } else if (selectedObject.save == "update") {

                    if (selectedObject.verif == "sinistreModif") {
                        //  coassureur datedeclaration dateecheance dateeffet datereglement datesurvenance identifiantassure idprestation idsinistre libelle montantattendu montantregle nomdeclarant numerocontrat observations pieces prestationContent primeassurance verification
                        sinistres.idprestation = selectedObject.idprestation;
                        sinistres.libelle = selectedObject.libelle;
                        sinistres.capital = selectedObject.capital;
                        sinistres.dateecheance = selectedObject.dateecheance;
                        sinistres.dateeffet = selectedObject.dateeffet;
                        sinistres.datereglement = selectedObject.datereglement;
                        sinistres.datesurvenance = selectedObject.datesurvenance;
                        sinistres.identifiantassure = selectedObject.identifiantassure;
                        sinistres.idprestation = selectedObject.idprestation;
                        sinistres.idsinistre = selectedObject.idsinistre;
                        sinistres.montantattendu = selectedObject.montantattendu;
                        sinistres.montantregle = selectedObject.montantregle;
                        sinistres.nomdeclarant = selectedObject.nomdeclarant;
                        sinistres.numerocontrat = selectedObject.numerocontrat;
                        sinistres.observations = selectedObject.observations;
                        sinistres.pieces = selectedObject.pieces;
                        sinistres.primeassurance = selectedObject.primeassurance;


                    };
                }

            });


        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }
})