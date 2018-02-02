app.controller('gestionBanqueAdminCtrl', function($scope, fileReader, fileBankUpload, $rootScope, $modalInstance, item, Data2, Data, $modal, $window, datetime, $filter, toaster) {
    $scope.banque = angular.copy(item);
    $scope.prep_time = '';


    console.log(fileReader)
    $scope.getFile = function() {
        console.log("Ready");
        $scope.progress = 0;
        fileReader.readAsDataUrl($scope.file, $scope)
            .then(function(result) {
                $scope.imageSrc = result;
                console.log($scope.imageSrc);
            });
    };

    $scope.$on("fileProgress", function(e, progress) {
        $scope.progress = progress.loaded / progress.total;
    });



    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };
    
    $scope.title = (item.id > 0) ? 'Modifier le nom de la banque' : 'Enrégistrer une banque';
    $scope.buttonText = (item.id > 0) ? 'Modifier le nom de la banque' : 'Enrégistrer une banque';

    var original = item;
    $scope.isClean = function() {
        return angular.equals(original, $scope.banque);
    }

    $scope.saveNewBanque = function(banqueSend) {
        if ($rootScope.actionsMenue == 'ecriture') {
            banqueSend.oldpicturepath = banqueSend.logo;
            var file = banqueSend.myFile;
            /* console.log(file);*/
            var uploadUrl = "api/v1/imageuploader.php";
            fileBankUpload.uploadFileToUrl(file, uploadUrl);
            fileBankUpload.retourneValue(function(data) {
                console.log(data);
                $scope.prep_time = data;
                if (data.length > 0) {
                    banqueSend.logo = data;
                }
                console.log(banqueSend);
                if (banqueSend.id > 0) {
                    Data.put('banqueModif/' + banqueSend.id, banqueSend).then(function(result) {
                        Data.toast(result);
                        if (result.status != 'error') {
                            var x = angular.copy(banqueSend);
                            x.save = 'update';
                            x.verif = 'BanqueModif';
                            $modalInstance.close(x);
                        } else {}
                    });
                } else {
                    banqueSend.etat = 'Actif';
                    Data.post('banqueInsert', banqueSend).then(function(result) {
                        Data.toast(result);
                        console.log(result)
                        if (result.status != 'error') {
                            var x = angular.copy(banqueSend);
                            x.save = 'insert';
                            x.verif = 'BanqueInsert';
                            x.id = result.data;
                            $modalInstance.close(x);

                        } else {}
                    });
                }
            });
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    };
});