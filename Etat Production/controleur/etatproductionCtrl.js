app.controller('etatproductionCtrl', function($scope, $rootScope, $location, $modalInstance, $http, item, Data2, Data, $modal, $window, datetime, $filter, toaster) {
    $scope.etatproduction = {}; ///= 
    $scope.criteres = {};
    $scope.listeAgence = [];
    $scope.downloading = false;
    $scope.etatProduction = angular.copy(item);
    $scope.etatProduction.typedate = "dateeffet";
    $scope.detail = {
        'statut': false,
        'buttonText': 'Plus de détails'
    };
    var moment = $window.moment;
    console.log($scope.etatProduction);
    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };

    var original = item;
    $scope.isClean = function() {
        return angular.equals(original, $scope.etatProduction);
    }
    $scope.changeDetail = function() {
        console.log('Avant $scope.detail.statut: ', $scope.detail.statut)

        if ($scope.detail.statut === false) {
            $scope.detail.buttonText = 'Moins de détails';
            $scope.detail.statut = true;
        } else {
            $scope.detail.buttonText = 'Plus de détails';
            $scope.detail.statut = false;
        }
        console.log('$scope.detail.statut: ', $scope.detail.statut)
    };

    $scope.filtrerAgence = function(banque) {
        console.log('LIste des agences', $scope.agences);
        console.log('Selected banque:', banque);
        console.log('$scope.etatproduction.idbanque', $scope.etatProduction.idbanque);
        //$scope.etatProduction.idbanque=banque.idbanque;
        $scope.listeAgence = [];
        for (var i = $scope.agences.length - 1; i >= 0; i--) {
            if ($scope.agences[i].idbanque == banque.id) {
                $scope.listeAgence.push($scope.agences[i]);
            }
        }
        console.log('Liste des agences', $scope.listeAgence)
    }
    Data.get('gestionbanqueActif').then(function(result) {
        $scope.banqueAll = result.data;

    });
    Data.get('getAgenceBanque').then(function(results) {
        $scope.agences = results.data;
    });
    Data.get('gestionutilisteur').then(function(results) {
        if (results.status == "success") {

            $scope.utilisateurs = results.data;
        }
    });



    $scope.saveEtatProduction = function(etatproduction) {
        var debut = moment(etatproduction.datedebut).valueOf();
        var fin = moment(etatproduction.datefin).valueOf();
        tabdeb = (etatproduction.datedebut.split(/[- //]/));
        tabfin = (etatproduction.datefin.split(/[- //]/));
        Odeb = new Date(tabdeb[2], parseInt(tabdeb[1] - 1), tabdeb[0]);
        Ofin = new Date(tabfin[2], parseInt(tabdeb[1] - 1), tabfin[0]);
        console.log('Données enoyées en paramètres pour etat:', etatproduction);
        var data = {
            datefin: $scope.etatProduction.datefin,
            datedebut: $scope.etatProduction.datedebut,
            niveau: $scope.etatProduction.niveau,
            typedate: etatproduction.typedate,
            banque: ($scope.etatProduction.idbanque !== undefined) ? $scope.etatProduction.idbanque.id : undefined,
            agence: ($scope.etatProduction.idagence !== undefined) ? $scope.etatProduction.idagence.idagence : undefined,
            utilisateur: $scope.etatProduction.uid
        };
        console.log('Data:', data);
        if (Odeb <= Ofin) {
            $scope.downloading = true;
            $http({
                    url: 'EtatExcel/etatProductionExcel.php',
                    method: 'POST',
                    data: {
                        datefin: $scope.etatProduction.datefin,
                        datedebut: $scope.etatProduction.datedebut,
                        niveau: $scope.etatProduction.niveau,
                        typedate: etatproduction.typedate,
                        banque: ($scope.etatProduction.idbanque !== undefined) ? $scope.etatProduction.idbanque.id : undefined,
                        agence: ($scope.etatProduction.idagence !== undefined) ? $scope.etatProduction.idagence.idagence : undefined,
                        utilisateur: $scope.etatProduction.uid
                    },
                    responseType: 'arraybuffer',
                    headers: {
                        'Content-type': 'application/json',
                        'Accept': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    }
                })
                .success(function(data, status, headers, config) {
                    $scope.downloading = false;
                    var Actionmene = 'Exportation de l\'etat de production';
                    Data.post('ActionmenePath', {
                        Actionmene: Actionmene
                    }).then(function(result) {
                        console.log(result);
                    })
                    $modalInstance.close(data);
                    console.log("Get report data: " + data);
                    var blob = new Blob([data], {
                        type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                    });
                    saveAs(blob, "RecapProduction.xlsx");
                    /*var objectUrl = URL.createObjectURL(blob);
                    window.opeobjectUrl);*/
                })
        } else {
            // toaster.pop('error', "Attention", 'la date de debut doit être inférieure à la date de fin');
        }
    }
    $scope.CreerBordereau = function(etatproduction) {
        console.log(etatproduction);
        var debut = moment(etatproduction.datedebut).valueOf();
        var fin = moment(etatproduction.datefin).valueOf();

        if (moment(etatproduction.datedebut, "DD/MM/YYYY").isValid() && moment(etatproduction.datefin, "DD-MM-YYYY").isValid() && etatproduction.typedate == 'datevalidation' ||
            moment(etatproduction.datedebut, "DD/MM/YYYY").isValid() && moment(etatproduction.datefin, "DD-MM-YYYY").isValid() && etatproduction.typedate == 'datereglement') {
            Data.post('createBordPath', etatproduction).then(function(result) {
                console.log(result);
                Data2.toast(result);
                $scope.saveEtatProduction(etatproduction);
            });
        } else {
            toaster.pop('error', "", 'Vous devez choisir comme type de date, la date de validation ou la date de reglement.');
        }
    }
});