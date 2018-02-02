app.controller('etatprestationCtrl', function($scope, $modalInstance, $http, Data, item, $window, $filter, toaster) {
    // $scope.etatprestation={}; ///= angular.copy(item);
    $scope.downloading = false;
    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };

    var original = item;
    $scope.isClean = function() {
        return angular.equals(original, $scope.etat);
    }

    $scope.saveEtatPrestation = function(etatprestation) {
        var debut = moment($scope.etatprestation.datedebut).valueOf();
        var fin = moment($scope.etatprestation.datefin).valueOf();
        tabdeb = ($scope.etatprestation.datedebut.split(/[- //]/));
        tabfin = ($scope.etatprestation.datefin.split(/[- //]/));
        Odeb = new Date(tabdeb[2], parseInt(tabdeb[1] - 1), tabdeb[0]);
        Ofin = new Date(tabfin[2], parseInt(tabdeb[1] - 1), tabfin[0]);
        /* console.log('Données enoyées en paramètres pour etat:', $scope.etatProduction);
        var data= {datefin: $scope.etatProduction.datefin
        ,datedebut:$scope.etatProduction.datedebut};
        console.log('Data:', data);arraybuffer*/
        if (Odeb <= Ofin) {
            $scope.downloading = true;
            $http({
                    url: 'EtatExcel/etatprestationExcel.php',
                    method: 'POST',
                    data: {
                        datefin: $scope.etatprestation.datefin,
                        datedebut: $scope.etatprestation.datedebut
                    },
                    responseType: 'arraybuffer',
                    headers: {
                        'Content-type': 'application/json',
                        'Accept': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    }
                })
                .success(function(data, status, headers, config) {
                    var Actionmene = 'Exportation de l\'etat de prestation';
                    Data.post('ActionmenePath', {
                        Actionmene: Actionmene
                    }).then(function(result) {
                        console.log(result);
                    });
                    $scope.downloading = false;
                    $modalInstance.close(data);
                    console.log("Get report data: " + data);
                    var blob = new Blob([data], {
                        type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                    });
                    saveAs(blob, "Etatprestation.xlsx");
                    /*var objectUrl = URL.createObjectURL(blob);
                    window.opeobjectUrl);*/
                })
        } else {
            // toaster.pop('error', "Attention", "La date de fin ne doit pas être antérieure à la date du début.");
        }
    }
});