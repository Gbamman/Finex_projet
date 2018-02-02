app.controller('edithController', function($scope, $rootScope, $modalInstance, item, primeDataFact, Data2, Data, $modal, $window, datetime, $filter, toaster) {
    $scope.detailprime = {};
    var moment = $window.moment;
    var num = '';
    var userAction = {
        iduser: '',
        action: ''
    }
    // console.log($rootScope.actionsMenue);

    Data.get('gestionParametrePrime').then(function(results) {
        $scope.parametre = results.data;

    })
    Data.get('gestiontypepret').then(function(resultpret) {
        $scope.typeprets = resultpret.data;
        // console.log($scope.typeprets);
    });

    if (item.idcontrat > 0) {

        // console.log('Objet contrat en édition: ',item);
        $scope.title = 'Modification d\'une souscription';
        $scope.buttonText = 'Modifier la souscription';
        $scope.qmchecked = true;
        //var savedMedicalQuizString=item.
    } else {
        $scope.title = 'Creation d\'une souscription';
        $scope.buttonText = 'Ajouter une souscription';
        $scope.qmchecked = false;
    }

    $scope.product = angular.copy(item);
    /* if( $scope.product.idcontrat > 0){
    $scope.product.numcontrat=$scope.product.numcontrat.replace('|num', '');
    }*/
    var original = item;
    $scope.isClean = function() {
        return angular.equals(original, $scope.product);
    }
    console.log($scope.product);
    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };

    /* Data.get('gestiontypepret').then(function (result) {
    if(result.status=='success'){
    $scope.typeprets = result.data; $scope.selectedBanqueTypePret*/
    Data.get('banqueutilisateur').then(function(results) {
        $rootScope.banques = results.data;
    });
    var valeur = null;
    var valeurDefault = null;
    var valeurDefaultPret = null;
    $scope.AgenceId = function(banqueId, banqueEtat) {
        Data.get('getAgenceBanque').then(function(results) {
            // console.log(results);
            if ($scope.product.idagence > 0) {
                $scope.agences = _.where(results.data, {
                    idbanque: banqueId
                });
                valeurDefault = _.where($scope.agences, {
                    libelle: $scope.product.libelleagence
                });
                $scope.product.idagence = valeurDefault[0];
            } else {
                $scope.agences = _.where(results.data, {
                    idbanque: banqueId
                });
                valeurDefault = _.where($scope.agences, {
                    idagence: $rootScope.idagence
                });
                $scope.product.idagence = valeurDefault[0];
            }
        });
        Data.get('gestiontypepret').then(function(resultpret) {
            $scope.typeprets = resultpret.data;
            $scope.selectedBanqueTypePret = _.where($scope.typeprets, {
                idbanque: banqueId
            });
            if (item.idcontrat > 0) {
                var idtypepretParDefaut = _.where($scope.selectedBanqueTypePret, {
                    idtypepret: item.idtypepret.toString()
                });
                $scope.product.typepret = idtypepretParDefaut[0];
                // console.log(item.idtypepret.toString());
                // console.log($scope.selectedBanqueTypePret);
            } else {
                $scope.product.typepret = $scope.selectedBanqueTypePret[0];
                // console.log($scope.selectedBanqueTypePret);
            }

        });

        /*console.log($rootScope.valeur);*/

    }

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
                $scope.product.save = selectedObject.savingMedicalQuizString;
                $scope.product.totalesupprime = selectedObject.totaleSupprime;
                $scope.finalTotal().surprime = (selectedObject.totaleSupprime != 'undefined') ? selectedObject.totaleSupprime : 0;
                $scope.ComputePrime();
                if (item.idcontrat > 0) {
                    var Actionmene = 'Modification du questionnaire medical N&deg;' + item.numeropret;
                } else {
                    var Actionmene = 'Creation du questionnaire medical';
                }
                Data.post('ActionmenePath', {
                    Actionmene: Actionmene
                }).then(function(result) {
                    console.log(result);
                })

            });
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }
    $scope.QuestionPrime = function(p, size) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            var cheminmenuedit = 'DetailPrime/vue/detailprime.html';
            var controlmenuedit = 'detailprimeCtrl';
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
                /*Object {primedeces: 76996, primeperte: 0, montantsupprime: 19249, accessoires: "2500"}*/
                var primeassurance = parseInt(selectedObject.primedeces) + parseInt(selectedObject.primeperte) + parseInt(selectedObject.montantsupprime) + parseInt(selectedObject.accessoires);
                $scope.product.primedeces = selectedObject.primedeces;
                $scope.product.primeperte = selectedObject.primeperte;
                $scope.product.montantsupprime = selectedObject.montantsupprime;
                $scope.product.accessoires = selectedObject.accessoires;
                $scope.product.primeassurance = primeassurance;
                var n = parseInt($scope.product.primeassurance) / parseInt($scope.product.capital) * 100;
                $scope.product.tauxprimes = n.toFixed(2);
                if (item.idcontrat > 0) {
                    var Actionmene = 'Modification des details sur les primes du contrat N&deg;' + item.numeropret;
                } else {
                    var Actionmene = 'Ajustement des montant des primes';
                }
                Data.post('ActionmenePath', {
                    Actionmene: Actionmene
                }).then(function(result) {
                    console.log(result);
                })

            });
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }

    }
    $scope.detailprimeQuestion = function() {
        $scope.QuestionPrime($scope.product);
    }

    $scope.questionnaire = function(questionnaire) {
        $scope.product.champs = 'save';
        $scope.editQuestion($scope.product);
        $scope.qmchecked = true;
    }

    if (item.idcontrat > 0) {
        Data.get('gestionbanque').then(function(results) {
            var valeurDefaultbanque = _.where(results.data, {
                libelle: item.banquelibelle
            });
            if (valeurDefaultbanque[0].etat == "Inactif") {
                $scope.product.idbanque = valeurDefaultbanque[0];
                $scope.AgenceId(valeurDefaultbanque[0].id, valeurDefaultbanque[0].etat);
                $scope.banqueContrat = valeurDefaultbanque;
            } else {
                $scope.banqueContrat = _.where(results.data, {
                    etat: 'Actif'
                });
                $scope.product.idbanque = valeurDefaultbanque[0];
                $scope.AgenceId(valeurDefaultbanque[0].id, valeurDefaultbanque[0].etat);
            }
            /*console.log(valeurDefault);*/

        });
        $scope.product.dateeffet = $filter('date')(item.dateeffet, "dd/MM/yyyy");
        $scope.product.dateecheance = $filter('date')(item.dateecheance, "dd/MM/yyyy");
        $scope.product.datenaissance = $filter('date')(item.datenaissance, "dd/MM/yyyy");
        $scope.product.numcontrat = (!angular.isString(item.numcontrat)) ? item.numcontrat : item.numcontrat.trim();
        $scope.product.banquelibelle = item.banquelibelle;
        $scope.product.libelleagence = item.libelleagence;
        $scope.product.sexe = item.sexe;
        $scope.product.numcontrat = item.numcontrat;
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
                $scope.product.idbanque = valeurDefaultbanque[0];
                // console.log(valeurDefaultbanque)
                $scope.AgenceId(valeurDefaultbanque[0].id, valeurDefaultbanque[0].etat);
            }
        });
        Data2.get('numcontratauto').then(function(numSend) {
            if (numSend.status == 'success') {
                num = parseInt(numSend.data[0].contratnum) + 1;
                var date = $filter('date')(new Date(), "yyyy");
                $scope.product.numeropret = 'FINBEN' + date + '/' + num;
                // console.log(numSend)
            }

        });
        $scope.product.status = "SOUSCRIPTION";
        $scope.product.reglementprime = "UNIQUE";


        if (typeof $scope.product.tauxemprunt == 'undefined' && typeof $scope.product.duree == 'undefined') {

            $scope.product.periodicite = "mensuelle";
            $scope.product.differe = 0;
            $scope.product.perteemploi = 'non';
            $scope.product.remboursement = 'PERIODIQUE';
            // $scope.product.idtypepret=1
            $scope.product.primeassurance = 0;
            $scope.product.tauxprimes = 0;
            $scope.product.dateecheance = 'jj/mm/yyyy';
            $scope.product.totalesupprime = 0;
            $scope.product.sexe = "M";
        }


    }

    $scope.product.i = 0;

    $scope.finalTotal = function() {
        var primeData = {
            action: $scope.product.i,
            idtypepret: $scope.product.idtypepret,
            datenaissance: $scope.product.datenaissance,
            capital: $scope.product.capital,
            duree: $scope.product.duree,
            dateeffet: $scope.product.dateeffet,
            periodicite: $scope.product.periodicite,
            perteemploi: $scope.product.perteemploi,
            remboursement: $scope.product.remboursement,
            tauxbanquaire: $scope.product.tauxemprunt,
            differe: $scope.product.differe,
            surprime: $scope.product.totalesupprime
        };
        return primeData;
    };


    $scope.ComputePrime = function() {
        // Calcul de parametre prime en utilisant un Factory;
        primeDataFact.getprimeData($scope.finalTotal()).then(function(result) {
            // console.log('Resultat de calcul au niveau de Factory des Primes',result);
            $scope.product.primeassurance = result.Primetotale;
            var n = (result.Primetotale / $scope.finalTotal().capital) * 100;
            /* (Math.round((n*100)/100)).toString();*/
            $scope.product.tauxprimes = n.toFixed(2);
            $scope.product.primeperte = result.PrimePE;
            $scope.product.accessoires = result.Accessoires;
            $scope.product.primedeces = result.Primedeces;
            $scope.product.montantsupprime = result.surprime;
        })
    };



    $scope.saveProduct = function(product) {
        if ($rootScope.actionsMenue == 'ecriture') {
            if ($scope.product.primeassurance > 0) {
                if ($scope.qmchecked === true) {
                    /*  $scope.product.PrimePE=0;*/
                    /*product.banquelibelle=$scope.idbanque.libelle;
                    product.libelleagence=$scope.idagence.libelle;*/
                    if (!product.idbanque) {
                        toaster.pop('error', "Attention", 'Vous n\'avez pas renseigné la banque');

                    } else if (!product.datenaissance) {
                        toaster.pop('error', "Attention", 'Vous n\'avez pas renseigné la date de naissance');

                    } else if (product.niveau >= 4) {
                        toaster.pop('error', "Attention", 'Vous ne pouvez plus modifier ce contrat car il est déjà en cours.');

                    } else {
                        product.idcontrat = product.idcontrat;
                        product.iduser = $rootScope.uid;
                        $scope.product.primeassurance = (!angular.isString($scope.product.primeassurance)) ? $scope.product.primeassurance : $scope.product.primeassurance.replace(/ /g, '');
                        product.numcontrat = product.numcontrat.trim();
                        // console.log(product);
                        if (product.idcontrat > 0) {
                            /*   if(product.save){
                            var index = product.indexOf(save);test = tesT.trim();
                            product.splice(index, 1); 
                            }*/

                            product.banquelibelle = product.idbanque.libelle;
                            product.idbanque = product.idbanque.id;
                            product.libelleagence = product.idagence.libelle;
                            product.idagence = product.idagence.idagence;
                            /* console.log(product);*/
                            Data2.put('contrat/' + product.idcontrat, product).then(function(result) {
                                Data2.toast(result);
                                if (result.status != 'error') {
                                    var Actionmene = 'Modification du contrat N&deg;' + product.numeropret;
                                    Data.post('ActionmenePath', {
                                        Actionmene: Actionmene
                                    }).then(function(result) {
                                        console.log(result);
                                    })
                                    var x = angular.copy(product);
                                    x.saveInsert = 'update';
                                    $modalInstance.close(x);
                                } else {
                                    /*console.log(result);*/
                                }
                            });

                        } else {

                            product.status = 'SOUSCRIPTION';
                            product.niveau = 3;
                            product.numsynchro = num;
                            product.banquelibelle = product.idbanque.libelle;
                            product.idbanque = product.idbanque.id;
                            product.libelleagence = product.idagence.libelle;
                            product.idagence = product.idagence.idagence;
                            // console.log(product);
                            Data2.post('menus', product).then(function(result) {
                                Data2.toast(result);
                                if (result.status != 'error') {
                                    var x = angular.copy(product);
                                    x.saveInsert = 'insert';
                                    x.idcontrat = result.data;
                                    var Actionmene = 'Creation du contrat N&deg;' + product.numeropret;
                                    Data.post('ActionmenePath', {
                                        Actionmene: Actionmene
                                    }).then(function(result) {
                                        console.log(result);
                                    })
                                    $modalInstance.close(x);
                                } else {
                                    /*console.log(result);*/
                                }
                            });

                        }

                    }
                } else {
                    toaster.pop('error', "Attention", 'Le questionnaire medical est obligatoire');
                }
            } else {
                toaster.pop('error', "Attention", 'La prime assurance ne peut être nulle');
            }
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }

});