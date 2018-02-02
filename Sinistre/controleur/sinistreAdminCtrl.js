app.controller('sinistreAdminCtrl', function($scope, $rootScope, $modalInstance, $modal, item, Data, $filter, toaster, $window) {
    $scope.piece = {};
    $scope.prestationdeclare = angular.copy(item);
    console.log($scope.prestationdeclare)
    var original = item;
    var moment = $window.moment;
    $scope.prestationdeclare.datedeclaration = moment().format("DD/MM/YYYY");
    $scope.prestationdeclare.montantattendu = 0;
    $scope.prestationdeclare.montantregle = 0;
    Data.get('getPrestationSinistre').then(function(result) {
        if (result.status == 'success') {
            $scope.prestations = result.data;
            var valeurPestationDefaut;
            if (item.idsinistre > 0) {
                valeurPestationDefaut = _.where($scope.prestations, {
                    idprestation: item.idprestation
                });
                $scope.prestationdeclare.prestationContent = valeurPestationDefaut[0];
            } else {
                $scope.prestationdeclare.prestationContent = $scope.prestations[0];
            };


        }
    });

    function piecesAfournirFunction(sinistres, taille) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {

            cheminPiecesEdit = 'Sinistre/vue/pieces.html';
            controlPiecesEdit = 'piecesCtrl';

            var modalInstance = $modal.open({
                templateUrl: cheminPiecesEdit,
                controller: controlPiecesEdit,
                size: taille,
                resolve: {
                    item: function() {

                        return sinistres;
                    }
                }
            });
            modalInstance.result.then(function(selectedObject) {
                $scope.prestationdeclare.piecesCoches = selectedObject.savingPiecesString;
                $scope.prestationdeclare.idprestation = selectedObject.idprestation;
                $scope.verifiacationIdprestation = selectedObject.idprestation;
                $scope.verifiacationIdEtat = selectedObject.idetat;
                $scope.pieceAjoindre = true;
                console.log($scope.prestationdeclare.piecesCoches);
                if (item.idsinistre > 0) {
                    var Actionmene = 'Modification des pieces a fournir pour la prestation N&deg;' + item.idsinistre;

                } else {
                    var Actionmene = 'Ajout des pieces a fournir';

                };
                Data.post('ActionmenePath', {
                    Actionmene: Actionmene
                }).then(function(result) {
                    console.log(result);
                })

            });


        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    };
    $scope.PiecesFournir = function() {
        $scope.prestationdeclare.pieces = $scope.prestationdeclare.prestationContent.idprestation;
        piecesAfournirFunction($scope.prestationdeclare);
    }


    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };
    $scope.isClean = function() {
        return angular.equals(original, $scope.prestationdeclare);
    }
    if (item.idsinistre > 0) {
        $scope.title = 'Modifier les informations sur le sinistre';
        $scope.buttonText = 'Modifier';
        if (item.coassureur === 'CO-ASSURANCE') {
            $scope.prestationdeclare.verification = 'oui';
        }
        $scope.prestationdeclare.dateeffet = $filter('date')(item.dateeffet, "dd/MM/yyyy");
        $scope.prestationdeclare.dateecheance = $filter('date')(item.dateecheance, "dd/MM/yyyy");
        $scope.prestationdeclare.datedeclaration = $filter('date')(item.datedeclaration, "dd/MM/yyyy");
        $scope.prestationdeclare.datereglement = $filter('date')(item.datereglement, "dd/MM/yyyy");
        $scope.prestationdeclare.datesurvenance = $filter('date')(item.datesurvenance, "dd/MM/yyyy");
        $scope.pieceAjoindre = true;
    } else {
        $scope.title = 'Déclarer un nouveau sinistre';
        $scope.buttonText = 'Ajouter une nouvelle sinistre';
        $scope.pieceAjoindre = false;
    };
    if (typeof $scope.prestationdeclare.datereglement == 'undefined') {
        $scope.prestationdeclare.coassureur = "Nom de l'assureur";
        $scope.prestationdeclare.capital = 0;
        $scope.prestationdeclare.primeassurance = 0;

    }

    $scope.saveSinistreInfo = function(sinistre) {
        if ($rootScope.actionsMenue == 'ecriture') {
            if ($scope.pieceAjoindre === true) {
                var dateeffet = moment(sinistre.dateeffet, 'DD/MM/YYYY').valueOf();
                var dateecheance = moment(sinistre.dateecheance, 'DD/MM/YYYY').valueOf();
                var datesurvenance = moment(sinistre.datesurvenance, 'DD/MM/YYYY').valueOf();
                sinistre.libelle = $scope.prestationdeclare.prestationContent.libelle;

                if ($scope.verifiacationIdprestation > '0') {
                    sinistre.idprestation = $scope.verifiacationIdprestation;
                    sinistre.idetat = $scope.verifiacationIdEtat;

                } else {
                    sinistre.idprestation = sinistre.prestationContent.idprestation;
                    sinistre.idetat = sinistre.prestationContent.idetat;
                }
                if (typeof sinistre.capital == 'undefined' || sinistre.capital <= 0) {
                    toaster.pop('error', "Attention", 'Veuillez entrer le capital');
                } else if (typeof sinistre.dateeffet == 'undefined') {
                    toaster.pop('error', "Attention", 'Veuillez entrer la date d\'effet');
                } else if (typeof sinistre.dateecheance == 'undefined') {
                    toaster.pop('error', "Attention", 'Veuillez entrer la date d\'echeance');
                } else if (typeof sinistre.primeassurance == 'undefined' || sinistre.primeassurance <= 0) {
                    toaster.pop('error', "Attention", 'Veuillez entrer la prime payée');
                } else if (typeof sinistre.coassureur == 'undefined') {
                    toaster.pop('error', "Attention", 'Veuillez entrer le nom de l\'assureur');
                } else if (typeof sinistre.identifiantassure == 'undefined') {
                    toaster.pop('error', "Attention", 'Veuillez entrer le nom de l\'assuré');
                } else {
                    if (dateeffet < datesurvenance && datesurvenance < dateecheance) {
                        sinistre.montantattendu = (!angular.isString(sinistre.montantattendu)) ? sinistre.montantattendu : sinistre.montantattendu.replace(/ /g, '');
                        sinistre.montantregle = (!angular.isString(sinistre.montantregle)) ? sinistre.montantregle : sinistre.montantregle.replace(/ /g, '');
                        sinistre.capital = (!angular.isString(sinistre.capital)) ? sinistre.capital : sinistre.capital.replace(/ /g, '');
                        sinistre.primeassurance = (!angular.isString(sinistre.primeassurance)) ? sinistre.primeassurance : sinistre.primeassurance.replace(/ /g, '');
                        if (sinistre.idsinistre > 0) {
                            console.log(sinistre);
                            Data.put('sinistreModif/' + sinistre.idsinistre, sinistre).then(function(result) {
                                if (result.status == 'success') {
                                    Data.toast(result);
                                };
                                if (result.status != 'error') {
                                    console.log(result);
                                    var x = angular.copy(sinistre);
                                    x.save = 'update';
                                    x.verif = 'sinistreModif';
                                    var Actionmene = 'Modification de la prestation N&deg;' + sinistre.idsinistre;
                                    Data.post('ActionmenePath', {
                                        Actionmene: Actionmene
                                    }).then(function(result) {
                                        console.log(result);
                                    })

                                    $modalInstance.close(x);
                                } else {}
                            });
                        } else {
                            console.log(sinistre);
                            Data.post('sinistreInsert', sinistre).then(function(result) {
                                Data.toast(result);
                                if (result.status != 'error') {
                                    var x = angular.copy(sinistre);
                                    x.save = 'insert';
                                    x.verif = 'sinistreInsert';
                                    x.idsinistre = result.data;
                                    var Actionmene = 'Creation de la prestation N&deg;' + x.idsinistre;
                                    Data.post('ActionmenePath', {
                                        Actionmene: Actionmene
                                    }).then(function(result) {
                                        console.log(result);
                                    })

                                    $modalInstance.close(x);
                                } else {}
                            });
                        }
                    } else {
                        toaster.pop('error', "Attention", 'La date de survenance doit est comprise entre la date d\'effet et la date d\'écheance');
                    }
                }
            } else {
                toaster.pop('error', "Attention", 'Les pieces sont obligatoires');
            }
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    };

})