app.controller('piecesCtrl', function($scope, $rootScope, $modalInstance, item, Data, $filter, toaster) {
    $scope.piece = angular.copy(item);
    console.log(item.piecesCoches);
    tableau = [];
    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };
    $scope.isClean = function() {
        return angular.equals(original, $scope.prestationdeclare);
    }
    Data.get('piecesAfournir/' + item.pieces).then(function(resultspieces) {
        console.log(resultspieces);

        if (resultspieces.status == 'success') {
            $scope.pieces = resultspieces.data;
            /*FAIRE LE TRAITEMENT POUR INTEGRER item.save*/
            var savedQMs = item.piecesCoches.split('@|');
            console.log('SavedQMs objects: ', savedQMs);
            //Définir unn tableau pour contenir tous les id de QM du contrat courant
            var tabOfId = [];
            for (var i = 0; i < savedQMs.length; i++) {
                //tabOfId.push(savedQMs[i].substring(0, 1));
                tabOfId.push(savedQMs[i]);
                //DernierChiffre = duree.substring(duree.length-2, duree.length);
            }
            console.log(tabOfId);
        }

        for (var i = 0; i < $scope.pieces.length; i++) {

            if (tabOfId.indexOf($scope.pieces[i].idpiece.toString()) >= 0) {
                $scope.pieces[i].reponses = "OUI";
                tableau.push($scope.pieces[i]);
            }


        }
    })


    $scope.changerEtatPiece = function(piecesCoche) {
        piecesCoche.reponses = (piecesCoche.reponses == "OUI" ? "NON" : "OUI");

        if (piecesCoche.reponses == "OUI") {
            tableau.push(piecesCoche)
            console.log('Questionnaire: ', tableau);
        } else {
            var indexToRemove = -1;
            for (var i = tableau.length - 1; i >= 0; i--) {
                if (tableau[i].idpiece == piecesCoche.idpiece) {

                    indexToRemove = i;
                    console.log('Objet trouvé à lindex: ', indexToRemove);
                }
            }
            tableau.splice(indexToRemove, 1);
            console.log('Nouveau tableau: ', tableau);
        }
    };



    $scope.savePieces = function(argument1) {
        console.log('Contenu de la variable tableau après modif:', tableau);
        var savingPiecesString = '';
        var totaleSupprime = 0;
        for (i = 0; i < tableau.length; i++) {
            savingPiecesString += tableau[i].idpiece + '@|';

        }

        console.log('Questionnaire médicale sauvegardé: ', savingPiecesString);
        var x = {};
        x.savingPiecesString = savingPiecesString;
        x.idprestation = item.pieces;
        x.idetat = item.prestationContent.idetat;
        x.libelle = item.prestationContent.libelle;
        $modalInstance.close(x);
    }
})