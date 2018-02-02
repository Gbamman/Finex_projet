app.controller('editProduitCtrl', function($scope, $rootScope, $modalInstance, item, primeDataFact, Data2, Data, $modal, $window, datetime, $filter, toaster) {
    $scope.produit = angular.copy(item);
    console.log(item);
    /* if( $scope.produit.idcontrat > 0){
    $scope.produit.numcontrat=$scope.produit.numcontrat.replace('|num', '');
    }*/
    var original = item;
    $scope.produit.etatCheck = '0';
    $scope.questionnairemedicalsCheck = false;
    $scope.isClean = function() {
        return angular.equals(original, $scope.produit);
    }
    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };
    if (item.idproduit > 0) {

        // console.log('Objet contrat en édition: ',item);
        $scope.title = 'Modification d\'un produit';
        $scope.buttonText = 'Modifier le produit';
        //var savedMedicalQuizString=item.
    } else {
        $scope.title = 'Creation de produit';
        $scope.buttonText = 'Ajouter un produit';
    }
    $scope.AgenceId = function(banqueId, banqueEtat) {
        Data.get('getAgenceBanque').then(function(results) {
            // console.log(results);
            if (item.idproduit > 0) {
                $scope.agences = _.where(results.data, {
                    idbanque: banqueId
                });
                valeurDefault = _.where($scope.agences, {
                    libelle: $scope.produit.libelleagence
                });
                $scope.produit.idagence = valeurDefault[0];
            } else {
                $scope.agences = _.where(results.data, {
                    idbanque: banqueId
                });
                valeurDefault = _.where($scope.agences, {
                    idagence: $rootScope.idagence
                });
                $scope.produit.idagence = valeurDefault[0];
            }
        });
    }


    /*  $scope.libelleLabel= ($scope.produit.etatCheck=='0') ? '<label>':'<span>';
    $scope.libelleLabel1= ($scope.produit.etatCheck=='0') ? '</label>':'</span>'; ALTER TABLE `produitbanque` ADD COLUMN `telephoneAssure` int(40) DEFAULT NULL AFTER `prenom1`, ADD COLUMN `numpieceAssure` int(40) DEFAULT NULL AFTER `prenom1`, ADD COLUMN `civiliteAssure` varchar(100) DEFAULT NULL AFTER `prenom1`,ADD COLUMN `emailAssure` varchar(100) DEFAULT NULL AFTER `prenom1`, ADD COLUMN `datenaissanceAssure` date DEFAULT NULL AFTER `prenom1`,ADD COLUMN `prenomAssure` varchar(100) DEFAULT NULL AFTER `prenom1`,ADD COLUMN `nomAssure` varchar(100) DEFAULT NULL AFTER `prenom1`*/
    $scope.Affectation = function(produit) {
        produit.etatCheck = (produit.etatCheck == '1') ? '0' : '1';
        /* $scope.libelleLabel= ($scope.produit.etatCheck=='0') ? '<label>':'<span>';
        $scope.libelleLabel1= ($scope.produit.etatCheck=='0') ? '</label>':'</span>';*/
        if (produit.etatCheck == '1') {
            $scope.produit.nomAssure = produit.nom;
            $scope.produit.prenomAssure = produit.prenom;
            $scope.produit.emailAssure = produit.email;
            $scope.produit.civiliteAssure = produit.civilite;
            $scope.produit.numpieceAssure = produit.numpiece;
            $scope.produit.datenaissanceAssure = produit.datenaissance;
            $scope.produit.telephoneAssure = produit.telephone;
            $scope.produit.boitepostalAssure = produit.boitepostalAssure;

        } else {
            if (item.idproduit > 0) {
                $scope.produit.nomAssure = item.nomAssure;
                $scope.produit.prenomAssure = item.prenomAssure;
                $scope.produit.emailAssure = item.emailAssure;
                $scope.produit.civiliteAssure = item.civiliteAssure;
                $scope.produit.numpieceAssure = item.numpieceAssure;
                $scope.produit.datenaissanceAssure = item.datenaissanceAssure;
                $scope.produit.telephoneAssure = item.telephoneAssure;
                $scope.produit.boitepostalAssure = item.boitepostalAssure;
            } else {
                $scope.produit.nomAssure = '';
                $scope.produit.prenomAssure = '';
                $scope.produit.emailAssure = '';
                $scope.produit.civiliteAssure = '';
                $scope.produit.numpieceAssure = '';
                $scope.produit.datenaissanceAssure = '';
                $scope.produit.telephoneAssure = '';
                $scope.produit.boitepostalAssure = '';

            };

        }
    }
    if (item.idproduit > 0) {
        Data.get('gestionbanque').then(function(results) {
            var valeurDefaultbanque = _.where(results.data, {
                libelle: item.banquelibelle
            });
            if (valeurDefaultbanque[0].etat == "Inactif") {
                $scope.produit.idbanque = valeurDefaultbanque[0];
                $scope.AgenceId(valeurDefaultbanque[0].id, valeurDefaultbanque[0].etat);
                $scope.banqueContrat = valeurDefaultbanque;
            } else {
                $scope.banqueContrat = _.where(results.data, {
                    etat: 'Actif'
                });
                $scope.produit.idbanque = valeurDefaultbanque[0];
                $scope.AgenceId(valeurDefaultbanque[0].id, valeurDefaultbanque[0].etat);
            }
            /*console.log(valeurDefault);*/

        });
        $scope.produit.dateeffet = $filter('date')(item.dateeffet, "dd/MM/yyyy");
        $scope.produit.dateecheance = $filter('date')(item.dateecheance, "dd/MM/yyyy");
        $scope.produit.datenaissance = $filter('date')(item.datenaissance, "dd/MM/yyyy");
        $scope.produit.datenaissanceAssure = $filter('date')(item.datenaissanceAssure, "dd/MM/yyyy");
        $scope.produit.pourcentagerente = item.pourcentagerente;
    } else {
        Data.get('gestionbanque').then(function(results) {
            $scope.banqueContrat = _.where(results.data, {
                etat: 'Actif'
            });
            var valeurDefaultbanque = _.where($scope.banqueContrat, {
                id: $rootScope.idbanque
            });
            console.log($rootScope.idbanque);
            if (valeurDefaultbanque.length <= 0) {
                toaster.pop('error', "Attention", 'Votre êtes enrégistré sur une banque Inactive');
            } else {
                $scope.produit.idbanque = valeurDefaultbanque[0];
                // console.log(valeurDefaultbanque)
                $scope.AgenceId(valeurDefaultbanque[0].id, valeurDefaultbanque[0].etat);
            }
        });
        $scope.produit.dateecheance = 'jj/mm/yyyy';
        $scope.produit.civilite = 'Mr.';
        $scope.produit.typebeneficiaire1 = 'Enfant(s) nés et à naitre';
        $scope.produit.typebeneficiaire = 'Enfant(s) nés et à naitre';
        $scope.produit.periodicite = 'mensuelle';
        $scope.produit.pourcentagerente = '25';
        $scope.produit.typepersonne = 'Personne Physique';
        $scope.produit.libelleproduit = 'ASSURDECES';

        Data.get('numeducplusauto').then(function(numSend) {
            if (numSend.status == 'success') {
                num = parseInt(numSend.data[0].numeducplus) + 1;
                var date = $filter('date')(new Date(), "yyyy");
                $scope.produit.numsynchro = num;
                $scope.produit.numproduit = 'FIN/PROD/' + date + '/' + num;
                console.log(num)
            }
            console.log(numSend)

        });

    }

    $scope.saveProduit = function(produitSave) {
        if ($rootScope.actionsMenue == 'ecriture') {

            /* $scope.$broadcast('show-errors-check-validity');

            if ($scope.produitForm.nom.$valid) {
            alert('User saved');
            $scope.reset();
            }else{
            alert('Ready');
            }*/
            var valide = true;
            if ($scope.produit.nom == 'undefined' || !$scope.produit.nom) {
                toaster.pop('error', "Attention", 'Vous n\'avez renseigné le nom du souscripteur');
                valide = false;

            } else if ($scope.produit.nom == 'undefined' || !$scope.produit.nom) {
                toaster.pop('error', "Attention", 'Vous n\'avez renseigné le prenom du souscripteur');
                valide = false;

            } else if ($scope.questionnairemedicalsCheck === false && produitSave.numsynchro > 0) {
                toaster.pop('error', "Attention", 'Le questionnaire medical est obligatoire');
            } else {
                $scope.produit.prime = (!angular.isString($scope.produit.prime)) ? $scope.produit.prime : $scope.produit.prime.replace(/ /g, '');
                $scope.produit.renteannuelle = (!angular.isString($scope.produit.renteannuelle)) ? $scope.produit.renteannuelle : $scope.produit.renteannuelle.replace(/ /g, '');
                produitSave.banquelibelle = produitSave.idbanque.libelle;
                produitSave.idbanque = produitSave.idbanque.id;
                produitSave.libelleagence = produitSave.idagence.libelle;
                produitSave.idagence = produitSave.idagence.idagence;
                console.log(produitSave);
                if (produitSave.idproduit > 0) {
                    Data.put('updateProduit/' + produitSave.idproduit, produitSave).then(function(result) {
                        Data.toast(result);
                        if (result.status != 'error') {
                            /*   var Actionmene ='Modification du contrat N&deg;'+produit.numeropret;
                            Data.post('ActionmenePath', {Actionmene : Actionmene}).then(function (result) {
                            console.log(result);
                            })*/
                            var x = angular.copy(produitSave);
                            x.saveInsert = 'update';
                            console.log(x);
                            $modalInstance.close(x);
                        } else {
                            /*console.log(result);*/
                        }
                    });

                } else {
                    produitSave.statut = "SOUSCRIPTION";
                    Data.post('insertProduit', produitSave).then(function(result) {
                        Data.toast(result);
                        if (result.status != 'error') {
                            var x = angular.copy(produitSave);
                            x.saveInsert = 'insert';
                            x.idproduit = result.data;
                            /*var Actionmene ='Creation du contrat N&deg;'+produit.numeropret;
                            Data.post('ActionmenePath', {Actionmene : Actionmene}).then(function (result) {
                            console.log(result);
                            })*/
                            $modalInstance.close(x);
                        } else {
                            /*console.log(result);*/
                        }
                    });

                }
            }

        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }

    // Quetinnaire medical
    $scope.editQuestion = function(p, size) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            var cheminmenuedit = 'AskQuestions/vue/AskQuestion.html';
            var controlmenuedit = 'AskQuestionCtrl';

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
                $scope.produit.questionnairemedical = selectedObject.savingMedicalQuizString;
                $scope.produit.totalesupprime = selectedObject.totaleSupprime;
                $scope.questionnairemedicalsCheck = true;
                /*$scope.finalTotal().surprime=   (selectedObject.totaleSupprime != 'undefined') ? selectedObject.totaleSupprime : 0;
                $scope.ComputePrime();*/
                /*      if(item.idcontrat > 0){
                var Actionmene ='Modification du questionnaire medical N&deg;'+item.numeropret;
                }else{
                var Actionmene ='Creation du questionnaire medical';
                }
                Data.post('ActionmenePath', {Actionmene : Actionmene}).then(function (result) {
                console.log(result);
                })*/

            });
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }
    $scope.questionnaire = function(questionnaire) {
        $scope.produit.champs = 'questionnairemedical'
        $scope.editQuestion($scope.produit);
        $scope.qmchecked = true;
    }

})