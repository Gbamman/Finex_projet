app.controller('QuestionMediCtrl', function($scope, $rootScope, $routeParams, $location, Data, contratFactory, $modal, $timeout, $filter) {
    $scope.questionmedicale = {};
    console.log($rootScope.actionsMenue);
    $scope.deleteQuestion = function(questionmedicale) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            console.log(questionmedicale);
            if (confirm("Est vous sure de vouloir supprimer le question : " + questionmedicale.libelle)) {
                Data.delete("deleteQuestions/" + questionmedicale.idm).then(function(results) {
                    Data.toast(results);
                    $scope.quetionsmedicales = _.without($scope.quetionsmedicales, _.findWhere($scope.quetionsmedicales, {
                        idm: questionmedicale.idm
                    }));

                    /* $scope.products = _.without($scope.products, _.findWhere($scope.products, {id:product.id}));*/

                });
            }
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    };


    $scope.changerEtatQuestion = function(quetionsmedicales) {
        quetionsmedicales.etat = (quetionsmedicales.etat == "Actif" ? "Inactif" : "Actif");
        Data.put('BanqueStatusUpdate/' + quetionsmedicales.idm, {
            etat: quetionsmedicales.etat,
            table: 'questions_medicales'
        }).then(function(result) {
            Data.toast(result)
        });;
    };
    /* $scope.sousmenusAction= function () {
    Data.get('gestionsousMenue').then(function (results) {
    verification=results.verification;  

    console.log(results);

    $scope.sousmenusAll = results.data;
    $scope.currentPage = 1; //current page
    $scope.entryLimit = 5; //max no of items to display in a page
    $scope.filteredItems =   $scope.sousmenusAll.length; //Initially for no filter  
    $scope.totalItems =  $scope.sousmenusAll.length;
    });
    }
    */
    Data.get('getquetionsmedicales').then(function(result) {

        /* $scope.menusAll = result.data;
        console.log(result);*/
        if (result.data.length > 0) {
            $scope.quetionsmedicales = result.data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 5; //max no of items to display in a page
            $scope.filteredItems = $scope.quetionsmedicales.length; //Initially for no filter  
            $scope.totalItems = $scope.quetionsmedicales.length;
        }
    });
    $scope.editQuestion = function(p, size) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            var cheminmenuedit = 'questionsMedi/vue/questionMediAdmin.html';
            var controlmenuedit = 'editQuestionMediCtrl';

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
                if (selectedObject.save == "insert") {
                    if (selectedObject.verif == "questionInsert") {
                        $scope.quetionsmedicales.push(selectedObject);
                        $scope.quetionsmedicales = $filter('orderBy')($scope.quetionsmedicales, 'idm', 'reverse');
                    };

                } else if (selectedObject.save == "update") {
                    if (selectedObject.verif == "questionModif") {
                        p.libelle = selectedObject.libelle;
                        p.tauxsup = selectedObject.tauxsup;
                    }

                }
            });
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }
})