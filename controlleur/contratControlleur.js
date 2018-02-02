app.controller('contratControlleur', function($scope, $rootScope, ActionSurMenue, $routeParams, $location,
    $http, toaster, Data, Data2, contratFactory, contratFactoryTraitement, $modal, $timeout, ngDialog, $filter, $window, datetime) {
    
    /*var lastval=$cookieStore.get('lastVal');*/
   
    console.log($rootScope.actionsMenue);
    var moment = $window.moment;
    $scope.login = {};
    $scope.signup = {};
    $scope.agence = '';
    $scope.product = {};
    $scope.product.capital = '';
    $scope.product.dateeffet = moment().format("DD/MM/YYYY");
    $scope.product.userchoice = 'NON';
    $scope.product.niveauText = '';
    $scope.etatProduction = {};
    $scope.fichier = {};
    var MesCntratsArray = [];
    $scope.bordereauEtatButton = false;
    /* var Droit= ActionSurMenue.DroitUtilisateur;
    console.log(Droit);*/
    /*$scope.contratImprimer = {};*/

    /*$scope.product.duree='';*/
    $scope.valeur = 0;
    $scope.mainScope = {};

    if ($scope.product.idcontrat > 0) {


    } else {
        /*  $scope.product.dateeffet='jj/mm/yyyy';*/

    };
    $scope.IsClickEnable = ($scope.product.niveau <= 3) ? true : false;
    console.log($scope.idnomgroup);
    // Fonction pour rechercher les contrats au niveau de la base

    $scope.searchContrat = function(criteres) {
        Data2.post('SearchContratPath', {
            criteres: criteres
        }).then(function(result) {
            console.log(result);
            if (result.status != 'success') {
                Data2.toast(result);
            }
            if (result.status == 'success') {
                $scope.products = result.data;
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 5; //max no of items to display in a page
                $scope.filteredItems = $scope.products.length; //Initially for no filter  
                $scope.totalItems = $scope.products.length;
            };
        })
    }

    function _calculateAge(birthday) { // birthday is a date
        var ageDifMs = Date.now() - birthday.getTime();
        var ageDate = new Date(ageDifMs); // miliseconds from epoch
        return Math.abs(ageDate.getUTCFullYear() - 1970);
    }
    /*var a = moment([2015, 0, 29]);
    var b = moment([2016, 0, 29]);
    a.from(b)
    console.log(a.from(b));*/
    /*var age = moment('29/04/1987',"DD/MM/YYYY").dayOfYear();
    console.log('l\'âge est :' , _calculateAge(age));*/
    $scope.getNiveauClass = function(niveau) {
        var niveauClass = '';
        if (niveau == 1)
            niveauClass = 'label label-danger';
        if (niveau == 2)
            niveauClass = 'label label-warning';
        if (niveau == 3)
            niveauClass = 'label label-info';
        if (niveau == 4)
            niveauClass = 'label label-success';
        if (niveau == 5)
            niveauClass = 'label label-primary';
        if (niveau == 6)
            niveauClass = 'niveau6';
        if (niveau == 7)
            niveauClass = 'niveau7';
        if (niveau == 8)
            niveauClass = 'niveau8';
        if (niveau == 9)
            niveauClass = 'niveau9';
        if (niveau == 10)
            niveauClass = 'niveau10';


        return niveauClass;
    };
    $scope.getNiveauText = function(niveau) {
        var niveauText = '';
        if (niveau == 1)
            niveauText = 'Rejet';
        if (niveau == 2)
            niveauText = 'Alerte';
        if (niveau == 3)
            niveauText = 'PROPOSITION';
        if (niveau == 4)
            niveauText = 'Validé';
        if (niveau == 5)
            niveauText = 'Payé';
        if (niveau == 6)
            niveauText = 'Terme';
        if (niveau == 7)
            niveauText = 'Remboursé';
        if (niveau == 8)
            niveauText = 'Déces';
        if (niveau == 9)
            niveauText = 'Invalidité';
        if (niveau == 10)
            niveauText = 'Perte emploi';


        return niveauText;
    };

    $scope.getNiveauTextPlace = function(niveau) {
        var niveauTextPlace = '';
        if (niveau == 1)
            niveauTextPlace = 'Rejet';
        if (niveau == 2)
            niveauTextPlace = 'Alerte';
        if (niveau == 3)
            niveauTextPlace = 'PROPOSITION';
        if (niveau == 4)
            niveauTextPlace = 'Validé';
        if (niveau == 5)
            niveauTextPlace = 'Payé';
        if (niveau == 6)
            niveauTextPlace = 'Terme';
        if (niveau == 7)
            niveauTextPlace = 'Remboursé';
        if (niveau == 8)
            niveauTextPlace = 'Déces';
        if (niveau == 9)
            niveauTextPlace = 'Invalidité';
        if (niveau == 10)
            niveauTextPlace = 'Perte emploi';


        return niveauTextPlace;
    };

    //initially set those objects to null to avoid undefined error
    Data.get('gestionCoassuranceActif').then(function(results) {
        console.log(results);
        $scope.coassureurs = results.data;
    })
    /* Fonction de question Medicale au niveau du BIA*/
    function questionmedicaleBia(savedQMString, listeQM) {
        /*FAIRE LE TRAITEMENT POUR INTEGRER item.save*/
        var savedQMs = savedQMString.split('|');
        console.log('SavedQMs objects: ', savedQMs);
        //Définir unn tableau pour contenir tous les id de QM du contrat courant
        var tabOfId = [];
        for (var i = 0; i < savedQMs.length; i++) {
            tabOfId.push(savedQMs[i].substring(0, 1));
        }
        console.log(tabOfId);


        for (var i = 0; i < listeQM.length; i++) {

            if (tabOfId.indexOf(listeQM[i].idm.toString()) >= 0) {
                listeQM[i].reponses = "OUI";
            }


        }
        return listeQM;
    }

    // Permettre à l'utilisateur de ne voir que ses contrats dejà saisis.
    $scope.UserChoiceButton = function(argument) {
        $scope.product.userchoice = (argument.userchoice == "NON" ? "OUI" : "NON");

        if ($scope.product.userchoice === 'OUI') {
            $scope.products = _.where($scope.products, {
                iduser: parseInt($rootScope.uid)
            });

            if (!$scope.products.length) {
                toaster.pop('warning', 'Aucun contrat n\'a été retrouvé.');
            }
        } else {
            $scope.products = MesCntratsArray;
        }
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 5; //max no of items to display in a page
        $scope.filteredItems = $scope.products.length; //Initially for no filter  /getContratPdf
        $scope.totalItems = $scope.products.length;

    }
    contratFactory.getContrats().then(function(data) {

        /* $scope.list = data.data;*/
        console.log(data);

        if (data.status == 'success') {
            $scope.products = data.data;
            MesCntratsArray = data.data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 5; //max no of items to display in a page
            $scope.filteredItems = $scope.products.length; //Initially for no filter  /getContratPdf
            $scope.totalItems = $scope.products.length;
        };
    });

    // Recuperation de la liste des contrats pour traitement;
    contratFactoryTraitement.getContratsTraitement().then(function(data) {

        /* $scope.list = data.data;*/
        console.log(data);

        if (data.status == 'success') {
            $scope.productsTraitement = data.data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 50; //max no of items to display in a page
            $scope.filteredItems = $scope.productsTraitement.length; //Initially for no filter  /getContratPdf
            $scope.totalItems = $scope.productsTraitement.length;
        };
    });

    // Recherche des contrats pour tritement

    $scope.searchContratTraitement = function(criteres) {
        Data2.post('SearchContratPath', {
            criteres: criteres
        }).then(function(result) {
            console.log(result);
            if (result.status != 'success') {
                Data2.toast(result);
            }
            if (result.status == 'success') {
                $scope.productsTraitement = result.data;
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 50; //max no of items to display in a page
                $scope.filteredItems = $scope.productsTraitement.length; //Initially for no filter  
                $scope.totalItems = $scope.productsTraitement.length;
            };
        })
    }
    $scope.setcontrat = function(contrat) {
        /*  Data2.post('getContratPdf',contrat).then(function (result) {
        console.log('BIAPDF', result);
        })*/
        $scope.contratImprimer = contrat;
        $scope.contratImprimer.sexe = (contrat.sexe == 'M') ? 'Masculin' : 'Feminin';
        Data.get('getquetionsmedicales').then(function(result) {
            if (result.status == 'success') {
                $scope.quetionsmedicales = result.data;
                $scope.printingQM = questionmedicaleBia(contrat.save, $scope.quetionsmedicales);
                console.log('PrintingQM: ', $scope.printingQM);
                /*  
                $scope.$apply(function() { 

                });*/
                if ($scope.printingQM.length > 0) {

                    //popupWin = window.open( '' ,'_blank');
                    /*   setTimeout(function() {
                    printUrl = window.location.origin + '/sahgescredit/#/bia';
                    printContents = document.getElementById('BIAFICHIER').innerHTML;
                    originalContents = document.body.innerHTML;     
                    popupWin = window.open();
                    popupWin.document.open();
                    popupWin.document.write('<style type="text/css">table{border-collapse:collapse;font-size:8.5px !important}.main{ border-top:1px solid black;border-right:1px solid black;border-left:1px solid black; border-bottom:1px solid black;font-size:8.5px !important}table  .first  td{ border-bottom:1px solid black;font-size:8.5px !important } table  .lg  td { border-bottom:1px solid black;font-size:8.5px !important }</style><div id="main-container" style="min-height:600px;"<div id="page-content"> <div class="block full" > <page backtop="5mm" backbottom="5mm" backleft="1mm" style="font-size:8.5px !important"><div class="main">'+printContents+'</div></page></div></div>');
                    popupWin.print();
                    popupWin.document.clear();
                    popupWin.document.close();
                    }, 2000);*/

                }
            }
        })
        // BIA avec utilisation de HTML2Pdf'arraybuffer',
        $http({
            url: 'vue/BIA.php',
            method: 'GET',
            params: {
                idcontrat: contrat.idcontrat,
                idtypepret: contrat.idtypepret
            },
            responseType: 'arraybuffer',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Content-type': 'application/json',
                'Accept': 'application/pdf, application/x-pdf, application/acrobat, applications/vnd.pdf, text/pdf, text/x-pdf'
            }
        }).success(function(data, status, headers, config) {
            console.log("Get report data: " + data);
            var Actionmene = 'Tirage du BIA N&deg; ' + contrat.numeropret;
            Data.post('ActionmenePath', {
                Actionmene: Actionmene
            }).then(function(result) {
                console.log(result);
            })
            var blob = new Blob([data], {
                type: "application/pdf, application/x-pdf, application/acrobat, applications/vnd.pdf, text/pdf, text/x-pdf"
            });
            saveAs(blob, "BIA_" + contrat.nom + "_" + contrat.prenom + ".pdf", data.base64mime);
            /*var objectUrl = URL.createObjectURL(blob);
            window.open(objectUrl);*/
        })
        console.log(contrat.idcontrat);
    };

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

    $scope.open = function(donnesSaisies) {
        Data.post('newcount', {
            customer: donnesSaisies
        }).then(function(results) {
            Data.toast(results);
            if (results.status == "success") {
                $location.path('/welcome');
            }
        });
    };
    $scope.effacercontrat = function(product) {
        if (confirm("Est vous sure de vouloir supprimer ce contrat")) {
            Data2.delete("effacer/" + product.idcontrat).then(function(results) {
                Data2.toast(results);
                var Actionmene = 'Suppression du contrat N&deg;' + product.numeropret;
                Data.post('ActionmenePath', {
                    Actionmene: Actionmene
                }).then(function(result) {
                    console.log(result);
                })
                $scope.products = _.without($scope.filtered, _.findWhere($scope.products, {
                    idcontrat: product.idcontrat
                }));

            });
        }
    };
    $scope.etatProductionAdd = function(p, size) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            var modalInstance = $modal.open({
                templateUrl: 'Etat Production/vue/etatproduction.html',
                controller: 'etatproductionCtrl',
                size: size,
                resolve: {
                    item: function() {
                        return p;
                    }
                }
            });
        } else {

            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');

        };
    }
    $scope.importation = function(p, size) {
        var modalInstance = $modal.open({
            templateUrl: 'importExcel/vue/importSql.html',
            controller: 'importSqlCtrl',
            size: size,
            resolve: {
                item: function() {
                    return p;
                }
            }
        });
    }

    $scope.open = function(p, size) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            var modalInstance = $modal.open({
                templateUrl: 'Contrat/vue/contratedith.html',
                controller: 'edithController',
                size: 'lg',
                resolve: {
                    item: function() {

                        return p;
                    }
                }
            });
            modalInstance.result.then(function(selectedObject) {
                if (selectedObject.saveInsert == "insert") {
                    $scope.products.push(selectedObject);
                    $scope.products = $filter('orderBy')($scope.products, 'id', 'reverse');
                } else if (selectedObject.saveInsert == "update") {
                    p.idcontrat = selectedObject.idcontrat;
                    p.numcontrat = selectedObject.numcontrat;
                    p.nom = selectedObject.nom;
                    p.prenom = selectedObject.prenom;
                    p.dateeffet = selectedObject.dateeffet;
                    p.capital = selectedObject.capital;
                    p.duree = selectedObject.duree;
                    p.primeassurance = selectedObject.primeassurance;
                    p.status = selectedObject.status;
                    p.banquelibelle = selectedObject.banquelibelle;
                    p.libelleagence = selectedObject.libelleagence;
                    p.datenaissance = selectedObject.datenaissance;
                    p.differe = selectedObject.differe;
                    p.reglementprime = selectedObject.reglementprime;
                    p.remboursement = selectedObject.remboursement;
                    p.profession = selectedObject.profession;
                    p.tauxprimes = selectedObject.tauxprimes;
                    p.periodicite = selectedObject.periodicite;
                    p.sexe = selectedObject.sexe;
                    p.tauxemprunt = selectedObject.tauxemprunt;
                    p.dateecheance = selectedObject.dateecheance;
                    p.tauxemprunt = selectedObject.tauxemprunt;
                    p.remboursement = selectedObject.remboursement;
                    p.primetotale = selectedObject.primetotale;
                    p.primedeces = selectedObject.primedeces;
                    p.primeperte = selectedObject.primeperte;
                    p.accessoires = selectedObject.accessoires;
                    p.tauxbanquaire = selectedObject.tauxbanquaire;
                    p.primedeces = selectedObject.primedeces;
                    p.totalesupprime = selectedObject.totalesupprime;
                    p.niveau = selectedObject.niveau;
                    p.save = selectedObject.save;
                    p.idtypepret = selectedObject.idtypepret;
                    p.montantsupprime = selectedObject.montantsupprime;
                }
            });
        } else {

            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');

        };
    }




    $scope.changerStatusContrat = function(product) {
        if ($rootScope.actionsMenue == 'modification' && product.niveau < 4 || $rootScope.actionsMenue == 'ecriture' && product.niveau < 4) {
            product.status = (product.status == "SOUSCRIPTION" ? "ANNULATION" : "SOUSCRIPTION");
            Data2.put('contratstatus/' + product.idcontrat, {
                table: 'contrat',
                status: product.status
            }).then(function(result) {
                Data2.toast(result);
                var Actionmene = 'Modification du statut du contrat N&deg;' + product.numeropret;
                Data.post('ActionmenePath', {
                    Actionmene: Actionmene
                }).then(function(result) {
                    console.log(result);
                })
            });
        } else {
            if (product.niveau >= 4) {
                toaster.pop('error', "Attention", 'Impossible d\'annuler un contrat deja validé');
            } else {
                if ($rootScope.actionsMenue != 'modification' || $rootScope.actionsMenue != 'ecriture') {
                    toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
                };
            }




        };

    }

    $scope.changerNiveauContrat = function(product) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            /* if (product.niveauText !='OUI' && product.niveauText !='') { };  */
            if (product.status == 'ANNULATION') {
                toaster.pop('error', "Attention", 'Impossible de valider un contrat annulé');
            } else {
                if (product.niveauTextPlace != 'OUI') {
                    toaster.pop('error', "Attention", 'Ce crédit n\'a pas été encore mis en place');
                } else {
                    product.niveau = (product.niveau === 5) ? 4 : (product.niveau === 4) ? 5 : product.niveau;
                    typedate = (product.niveau === 4) ? 'datevalidation' : 'dateregelement';
                    if (product.niveau >= 3) {
                        Data2.put('contratniveauPath/' + product.idcontrat, {
                            table: 'contrat',
                            niveau: product.niveau,
                            typedate: typedate
                        }).then(function(result) {
                            console.log(result)
                            Data2.toast(result);
                            if (product.niveau == 5) {
                                $scope.productsTraitement = _.without($scope.filtered, _.findWhere($scope.productsTraitement, {
                                    niveau: 5
                                }));
                            };
                        });
                    }

                }
            }

        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }

    $scope.changerNiveauContratPlace = function(product) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            if (product.status == 'ANNULATION') {
                toaster.pop('error', "Attention", 'Impossible de valider un contrat annulé');
            } else {
                /* if (product.niveauTextPlace !='OUI') {

                }*/
                product.niveau = (product.niveau <= 3) ? 4 : 3;
                console.log(product.niveau);
                typedate = 'datevalidation';
                if (product.niveau >= 3) {
                    Data2.put('contratniveauPath/' + product.idcontrat, {
                        table: 'contrat',
                        niveau: product.niveau,
                        typedate: typedate
                    }).then(function(result) {
                        console.log(result)
                        Data2.toast(result);
                    });
                }
            }


        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }
    $scope.utilisateur = null;
    $scope.interface = function() {
        $scope.utilisateur = !$scope.utilisateur;
    };
    $scope.simulation = function(p, size) {
        var modalInstance = $modal.open({
            templateUrl: 'simulation/vue/simulation.html',
            controller: 'SimulationCtrl',
            size: 'lg',
            resolve: {
                item: function() {
                    return p;
                }
            }
        });
        modalInstance.result.then(function(selectedObject) {
            if (selectedObject.save == "insert") {
                p.primetotale = selectedObject.primetotale;
                p.primedeces = selectedObject.primedeces;
                p.primePE = selectedObject.primePE;
                p.Accessoires = selectedObject.Accessoires;
                $timeout(function() {
                    $scope.open(selectedObject, size);
                }, 2000);
            }
        })

    };

});