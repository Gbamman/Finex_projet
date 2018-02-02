app.controller('produitCtrl', function($scope, $rootScope, ActionSurMenue, $routeParams, $location, $http, toaster, Data, $modal, $filter, $window, datetime) {
    /*var lastval=$cookieStore.get('lastVal');*/
    console.log($rootScope.actionsMenue);
    var moment = $window.moment;
    $scope.login = {};
    $scope.signup = {};
    $scope.agence = '';
    $scope.produit = {};
    $scope.produit.dateeffet = moment().format("DD/MM/YYYY");
    //Selection des produits educplus
    Data.get('getEducPlusPath').then(function(results) {
        console.log(results);
        if (results.status == 'success') {
            $scope.produits = results.data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 5; //max no of items to display in a page
            $scope.filteredItems = $scope.produits.length; //Initially for no filter  
            $scope.totalItems = $scope.produits.length;
        }
    });
    $scope.openproduitPop = function(p, size) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            var modalInstance = $modal.open({
                templateUrl: 'Produits/vue/editProduit.html',
                controller: 'editProduitCtrl',
                size: 'lg',
                resolve: {
                    item: function() {
                        return p;
                    }
                }
            });
            modalInstance.result.then(function(selectedObject) {
                if (selectedObject.saveInsert == "insert") {
                    $scope.produits.push(selectedObject);
                    $scope.produits = $filter('orderBy')($scope.produits, 'idproduit', 'reverse');
                } else if (selectedObject.saveInsert == "update") {
                    // p  = selectedObject;
                    p.boitepostalAssure = selectedObject.boitepostalAssure
                    p.libelleproduit = selectedObject.libelleproduit;
                    p.statut = selectedObject.statut;
                    p.datesignature = selectedObject.datesignature;
                    p.dateeffet = selectedObject.dateeffet;
                    p.dureediffere = selectedObject.dureediffere;
                    p.dateecheance = selectedObject.dateecheance;
                    p.codeapporteur = selectedObject.codeapporteur;
                    p.apporteur = selectedObject.apporteur;
                    p.typepersonne = selectedObject.typepersonne;
                    p.civilite = selectedObject.civilite;
                    p.actenaissance = selectedObject.actenaissance;
                    p.nom = selectedObject.nom;
                    p.prenom = selectedObject.prenom;
                    p.datenaissance = selectedObject.datenaissance;
                    p.telephone = selectedObject.telephone;
                    p.profession = selectedObject.profession;
                    p.boitepostal = selectedObject.boitepostal;
                    p.email = selectedObject.email;
                    p.typeprelevement = selectedObject.typeprelevement;
                    p.banque = selectedObject.banque;
                    p.numerocompte = selectedObject.numerocompte;
                    p.matricule = selectedObject.matricule;
                    p.rib = selectedObject.rib;
                    p.intitulecompte = selectedObject.intitulecompte;
                    p.ville = selectedObject.ville;
                    p.numpiece = selectedObject.numpiece;
                    p.cumulcapitaux = selectedObject.cumulcapitaux;
                    p.periodicite = selectedObject.periodicite;
                    p.dureerente = selectedObject.dureerente;
                    p.pourcentagerente = selectedObject.pourcentagerente;
                    p.prime = selectedObject.prime;
                    p.renteannuelle = selectedObject.renteannuelle;
                    p.nomAssure = selectedObject.nomAssure;
                    p.prenomAssure = selectedObject.prenomAssure;
                    p.datenaissanceAssure = selectedObject.datenaissanceAssure;
                    p.emailAssure = selectedObject.emailAssure;
                    p.civiliteAssure = selectedObject.civiliteAssure;
                    p.numpieceAssure = selectedObject.numpieceAssure;
                    p.telephoneAssure = selectedObject.telephoneAssure;
                    p.boitepostalAssure = selectedObject.boitepostalAssure;
                }
            })
        } else {

            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');

        };
    };




    $scope.simulationProduit = function(p, size) {
        var modalInstance = $modal.open({
            templateUrl: 'Produits/vue/simulation.html',
            controller: 'simulationCtrl',
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

    //Impression du BIA
    $scope.printEducBia = function(produit) {
        $http({
            url: 'vue/educPlus.php',
            method: 'GET',
            params: {
                idproduit: produit.idproduit
            },
            responseType: 'arraybuffer',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Content-type': 'application/json',
                'Accept': 'application/pdf, application/x-pdf, application/acrobat, applications/vnd.pdf, text/pdf, text/x-pdf'
            }
        }).success(function(data, status, headers, config) {
            console.log("Get report data: " + data);
            /* var Actionmene ='Tirage du BIA N&deg; '+produit.idproduit;
            Data.post('ActionmenePath', {Actionmene : Actionmene}).then(function (result) {
            console.log(result); })*/

            var blob = new Blob([data], {
                type: "application/pdf, application/x-pdf, application/acrobat, applications/vnd.pdf, text/pdf, text/x-pdf"
            });
            saveAs(blob, "BIA_EDUCPLUS_" + produit.nom + "_" + produit.prenom + ".pdf", data.base64mime);
            /*var objectUrl = URL.createObjectURL(blob);
            window.open(objectUrl);*/
        })
        console.log(produit.idproduit);
    };

    // Statut educplus
    $scope.changerStatusProduit = function(produitStatut) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            produitStatut.statut = (produitStatut.statut == "SOUSCRIPTION" ? "ANNULATION" : "SOUSCRIPTION");
            console.log(produitStatut.statut);
            Data.put('educplusStatut/' + produitStatut.idproduit, {
                table: 'produitbanque',
                statut: produitStatut.statut
            }).then(function(result) {
                Data.toast(result);
                /*var Actionmene ='Modification du statut du contrat N&deg;'+product.numeropret;
                Data.post('ActionmenePath', {Actionmene : Actionmene}).then(function (result) {
                console.log(result);
                })*/
            });
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
            /* if (product.niveau >=4) {
            toaster.pop('error', "Attention", 'Impossible d\'annuler un contrat deja validé');
            }else{
            if ($rootScope.actionsMenue !='modification'  || $rootScope.actionsMenue!='ecriture') {

            };
            }*/




        };
    }
    // Recherche EducPlus
    $scope.searchContrat = function(criteres) {
        Data.post('SearchProduitPath', {
            criteres: criteres
        }).then(function(result) {
            console.log(result);
            if (result.status != 'success') {
                Data.toast(result);
            }
            if (result.status == 'success') {
                $scope.produits = result.data;
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 5; //max no of items to display in a page
                $scope.filteredItems = $scope.produits.length; //Initially for no filter  
                $scope.totalItems = $scope.produits.length;
            };
        })
    }



});