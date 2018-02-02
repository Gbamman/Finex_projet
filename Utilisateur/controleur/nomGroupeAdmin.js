app.controller('editnomgrpCtrl', function($scope, $rootScope, $modalInstance, item, Data2, Data, $modal, $window, datetime, $filter, toaster) {
    $scope.checkvalue = false;
    $scope.nomgrouputilisateur = angular.copy(item);
    var listesousmenu = [];
    var valeurDefault = null;
    var droitTableau = [];
    /*function valeurDefault1(droit){
    console.log();
    };*/
    $scope.Affectation = function(argumentaire) {
        argumentaire.etat = (argumentaire.etat == "0" ? "1" : "0");
        console.log(argumentaire.etat);
        Data.put('AffectationEtat/' + argumentaire.idgroup, argumentaire).then(function(result) {
            Data.toast(result);
        })

    }
    $scope.AffectationDroit = function(droit) {
        /* console.log(droit+ "ET" +idgroup);*/
        /* argumentaire.etat =(argumentaire.etat=="0" ? "1" : "0");console.log( argumentaire.etat);*/
        Data.put('AffectationDroit/' + droit.idgroup, droit).then(function(result) {
            Data.toast(result);
            console.log(result);
        })

    }

    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };
    $scope.title = (item.idnomgroup > 0) ? 'Modifier le nom de groupe utilisateur' : 'Creation d\'un nom groupe utilisateur';
    $scope.buttonText = (item.idnomgroup > 0) ? 'Modifier le nom de groupe' : 'Ajouter un nom de groupe';

    if (item.idnomgroup > 0) {
        Data.get('gestionsousMenusAdim/' + item.idnomgroup).then(function(results) {
            /* console.log(results);*/
            $scope.nomgrouputilisateur.sousMenusUsers = results.data;

            $scope.pas = '5';
            $scope.taille = '10';
        });




    } else {
        $scope.pas = '1';
        $scope.taille = '6';
    }
    var original = item;
    $scope.isClean = function() {
        return angular.equals(original, $scope.nomgrouputilisateur);
    }
    $scope.saveNomgrp = function(nomgrputilisateurSend) {

        if (nomgrputilisateurSend.idnomgroup > 0) {
            Data.put('nomgrpmodif/' + nomgrputilisateurSend.idnomgroup, nomgrputilisateurSend).then(function(result) {
                if (result.status == 'success') {
                    Data.toast(result);
                };
                if (result.status != 'error') {
                    console.log(result);
                    var x = angular.copy(nomgrputilisateurSend);
                    x.save = 'update';
                    x.verif = 'NomgrpMofif';
                    $modalInstance.close(x);
                } else {}
            });
        } else {
            console.log(nomgrputilisateurSend);
            Data.post('nomgrpInsert', nomgrputilisateurSend).then(function(result) {
                Data.toast(result);
                if (result.status != 'error') {
                    var x = angular.copy(nomgrputilisateurSend);
                    x.save = 'insert';
                    x.verif = 'NomgrpInsert';
                    x.idnomgroup = result.data;
                    $modalInstance.close(x);
                } else {}
            });
        }

    };


});