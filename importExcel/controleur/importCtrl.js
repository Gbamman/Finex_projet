app.controller('importsCtrl', function($scope, fileUpload, $rootScope, $location, $http, $modal, $window, Data, toaster) {
    //app.controller('importSqlCtrl',  function ($scope,fileUpload,$rootScope,$location,$modalInstance,$http,item, Data2,Data,$modal,$window,datetime,$filter,toaster)
    $scope.importProgress = false;
    $scope.modifierSouscription = function() {
        $scope.importProgress = true;
        Data.get('gestiondesimports').then(function(resultats) {
            $scope.importProgress = false;
            console.log(resultats);
            Data.toast(resultats);
            /*   Data.get('affichageFichier').then(function(resultatTable)console.log(resultatTable); })*/
            if (resultats.status == 'success') {
                $http({
                        url: 'EtatExcel/ExportationDonneesExcel.php',
                        method: 'GET',
                        data: {},
                        responseType: 'arraybuffer',
                        headers: {
                            'Content-type': 'application/json',
                            'Accept': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                        }
                    })
                    .success(function(data, status, headers, config) {
                        console.log("Get report data: " + data);
                        var blob = new Blob([data], {
                            type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                        });
                        $scope.importProgress = false;
                        saveAs(blob, "Exportation.xlsx");

                    })
            } else {
                $scope.importProgress = false;
            }

        })
    }

    $scope.uploadFile = function(file) {
        var file = file;
        $scope.importProgress = true;
        // console.log('file is ');
        // console.dir(file);
        // console.log(filename.replace(/C:\\fakepath\\/i, ''));
        var filename = $('input[type=file]').val();
        var uploadUrl = "uploader/fileUpload/traitement.php";
        var retourFile = fileUpload.uploadFileToUrl(file, uploadUrl);
        // console.log(retourFile);
        fileUpload.retourneValue(function(valeur) {
            if (valeur.status == 'success') {
                Data.get('affichageFichier').then(function(resultats) {
                    // console.log(resultats);
                    $scope.affichageFichier = resultats.data
                    $scope.currentPage = 1; //current page
                    $scope.entryLimit = 100; //max no of items to display in a page
                    $scope.filteredItems = $scope.affichageFichier.length; //Initially for no filter  
                    $scope.totalItems = $scope.affichageFichier.length;
                    $scope.importProgress = false;
                });

            } else {
                $scope.importProgress = false;
            }
        })

    }
    $scope.uploadFileReglement = function(filereglement) {
        $scope.importProgress = true;
        var file = filereglement;
        var fichierExcel = file.name;
        // console.log('file is ' );
        // console.dir(file);
        var uploadUrl = "Reglement/traitement/traitement.php";
        var retourFile = fileUpload.uploadFileToUrl(file, uploadUrl);
        fileUpload.retourneValue(function(valeur) {
            if (valeur.status == 'success') {
                Data.get('affichageReglement').then(function(resultats) {
                    $scope.affichageReglement = resultats.data
                    $scope.currentPage = 1; //current page
                    $scope.entryLimit = 100; //max no of items to display in a page
                    $scope.filteredItems = $scope.affichageReglement.length; //Initially for no filter  
                    $scope.totalItems = $scope.affichageReglement.length;
                    $scope.importProgress = false;
                });

            } else {
                $scope.importProgress = false;
            }
        })
    }

    // Passage de contrat validé à  payé.
    $scope.ReglementSubmit = function() {
        $scope.importProgress = true;
        Data.get('gestiondesregelementspath').then(function(resultats) {
            console.log(resultats);
            Data.toast(resultats);
            $scope.importProgress = false;

        })
    }

})