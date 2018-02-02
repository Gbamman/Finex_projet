app.controller('detailprimeCtrl', function($scope, $modalInstance, item, $window, toaster) {
    $scope.detailprime = angular.copy(item);
    var original = item;
    $scope.title = 'Details de la prime';
    $scope.buttonText = 'Modifier les détails de la prime';
    $scope.isClean = function() {
        return angular.equals(original, $scope.detailprime);
    }
    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };
    console.log($scope.detailprime);
    $scope.saveDetailsPrime = function(detailprime) {
        detailprime.primedeces = (!angular.isString(detailprime.primedeces)) ? detailprime.primedeces : detailprime.primedeces.replace(/ /g, '');
        detailprime.primeperte = (!angular.isString(detailprime.primeperte)) ? detailprime.primeperte : detailprime.primeperte.replace(/ /g, '');
        detailprime.montantsupprime = (!angular.isString(detailprime.montantsupprime)) ? detailprime.montantsupprime : detailprime.montantsupprime.replace(/ /g, '');
        detailprime.accessoires = (!angular.isString(detailprime.accessoires)) ? detailprime.accessoires : detailprime.accessoires.replace(/ /g, '');
        if (parseInt(detailprime.primedeces) < parseInt(item.primedeces)) {
            toaster.pop('error', "Attention", 'La prime décès modifiée ne peut être inférieure à la prime déjà calculée');
        } else if (parseInt(detailprime.primeperte) < parseInt(item.primeperte)) {
            toaster.pop('error', "Attention", 'La prime perte emploi modifiée ne peut être inférieure à la prime déjà calculée');
        } else if (parseInt(detailprime.montantsupprime) < parseInt(item.montantsupprime)) {
            toaster.pop('error', "Attention", 'Le montant surprime ne peut être inférieure à celui déjà calculé');
        } else if (parseInt(detailprime.accessoires) < parseInt(item.accessoires)) {
            toaster.pop('error', "Attention", 'Le montant de l\'accessoires ne peut être inférieure à celui déjà calculée');
        } else {

            var x = {};
            x.primedeces = detailprime.primedeces;
            x.primeperte = detailprime.primeperte;
            x.montantsupprime = detailprime.montantsupprime;
            x.accessoires = detailprime.accessoires;
            console.log(detailprime);
            console.log(x);
            $modalInstance.close(x);
        }

    };
})