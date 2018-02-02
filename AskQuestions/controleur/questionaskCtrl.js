app.controller('AskQuestionCtrl', function($scope, $rootScope, $modalInstance, item, Data2, Data, $modal, $window, datetime, $filter, toaster) {
    //console.log('Contenu du String QM: ', item.save);
    $scope.product = angular.copy(item); //Code inutile

    var original = item;


    var tableau = [];
    $scope.isClean = function() {
        return angular.equals(original, $scope.product);
    }
    
    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };

    Data.get('getquetionsmedicales').then(function(result) {
        if (result.status == 'success') {
            $scope.quetionsmedicales = result.data;
            /*FAIRE LE TRAITEMENT POUR INTEGRER item.save*/
            var chaine_a_spliter = (item.champs == 'save') ? item.save : item.questionnairemedical;
            var savedQMs = chaine_a_spliter.split('|');
            // console.log('SavedQMs objects: ',item.save);
            //Définir unn tableau pour contenir tous les id de QM du contrat courant
            var tabOfId = [];
            for (var i = 0; i < savedQMs.length; i++) {
                //tabOfId.push(savedQMs[i].substring(0, 1));
                tabOfId.push(savedQMs[i].substring(savedQMs[i].length - 9, savedQMs[i].length - 7));
                //DernierChiffre = duree.substring(duree.length-2, duree.length);
            }
            //console.log(tabOfId);
        }

        for (var i = 0; i < $scope.quetionsmedicales.length; i++) {

            if (tabOfId.indexOf($scope.quetionsmedicales[i].idm.toString()) >= 0) {
                $scope.quetionsmedicales[i].reponses = "OUI";
                tableau.push($scope.quetionsmedicales[i]);
            }


        }
        //console.log('Contenu de la variable tableau avant modif:',tableau);
    });

    $scope.changerEtatQuestion = function(quetionmedicale) {

        quetionmedicale.reponses = (quetionmedicale.reponses == "OUI" ? "NON" : "OUI");

        if (quetionmedicale.reponses == "OUI") {
            tableau.push(quetionmedicale)
            // console.log('Questionnaire: ',tableau);
        } else {
            var indexToRemove = -1;
            for (var i = tableau.length - 1; i >= 0; i--) {
                if (tableau[i].idm == quetionmedicale.idm) {

                    indexToRemove = i;
                    // console.log('Objet trouvé à lindex: ',indexToRemove);
                }
            }
            tableau.splice(indexToRemove, 1);
            // console.log('Nouveau tableau: ',tableau);
        }
    };

    $scope.saveQuestion = function(argument1) {
        // console.log('Contenu de la variable tableau après modif:',tableau);
        var savingMedicalQuizString = '';
        var totaleSupprime = 0;
        for (i = 0; i < tableau.length; i++) {
            $scope.product.save
            savingMedicalQuizString += tableau[i].idm + '@' + tableau[i].reponses + '@' + tableau[i].tauxsup + '|';
            totaleSupprime += parseInt(tableau[i].tauxsup);
        }

        // console.log('Questionnaire médicale sauvegardé: ', savingMedicalQuizString);
        // console.log('Questionnaire médicale supprimetotale sauvegardée: ', totaleSupprime);
        var x = {};
        x.totaleSupprime = totaleSupprime;
        x.savingMedicalQuizString = savingMedicalQuizString;




        $modalInstance.close(x);

    }
})