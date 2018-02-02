/*
Ce controlleur permet d'enrégistrer un nouveau utilisateur

*/
app.controller('AdminiController', function($scope, $rootScope, $routeParams, $location, $http, Data, $modalInstance, toaster, item) {
    var valeur = null;
    var valeurDefault = null;
    var valeurDefault1 = null;
    $scope.AgenceId = function(banqueId) { // Cette fonction agit dynamiquement charge les agences d'une banque.!
        valeur = banqueId
        /*console.log($scope.utilisateur.idagence);*/
        Data.get('agence/' + valeur).then(function(results) {

            if ($scope.utilisateur.uid > 0) {
                valeurDefault = _.where(results.data, {
                    idagence: $scope.utilisateur.idagence
                });
                $scope.utilisateur.idagence = valeurDefault[0];
                $scope.agences = results.data;
                console.log($scope.agences)
            } else {
                $scope.agences = results.data;
                $scope.utilisateur.idagence = $scope.agences[0];
            }
        });
    }
    $scope.utilisateur = angular.copy(item);
    $scope.cancel = function() {
        $modalInstance.dismiss('Close');
    };

    $scope.buttonText = (item.uid > 0) ? 'Modification des informations' : 'Inscription';
    $scope.utilisateur.password = (item.uid > 0) ? 'saham' : '';
    $scope.utilisateur.password2 = (item.uid > 0) ? 'saham' : '';

    var original = item;
    $scope.isClean = function() {
        return angular.equals(original, $scope.utilisateur);
    }
    if (item.uid > 0) {
        Data.get('gestionbanqueActif').then(function(results) { // Cette fonction charge la banque et l'agence par defaut de l'utilisateur. 
            if (results.status == 'success') {
                console.log($scope.utilisateur.idbanque);
                valeurDefault = _.where(results.data, {
                    id: $scope.utilisateur.idbanque
                });
                $scope.utilisateur.idbanque = valeurDefault[0];
                $scope.AgenceId(valeurDefault[0].id);
                $scope.banques = results.data;
            }
        });
        Data.get('nomgroupeutilisateurProfil').then(function(results) { // Cette fonction charge le profil par defaut pour l'utilisateur 
            $scope.nomgroups = results.data;
            valeurDefault1 = _.where(results.data, {
                idnomgroup: $scope.utilisateur.idnomgroup
            });
            $scope.utilisateur.idnomgroup = valeurDefault1[0];
            console.log($scope.nomgroups);
        });
    } else {
        Data.get('gestionbanqueActif').then(function(results) {
            $scope.banques = results.data;
            $scope.AgenceId($scope.banques[0].id);
            $scope.utilisateur.idbanque = $scope.banques[0];
            $scope.AgenceId($scope.banques[0].id);
            console.log(results);
        });
        Data.get('nomgroupeutilisateurProfil').then(function(results) {
            $scope.nomgroups = results.data;
            $scope.utilisateur.idnomgroup = $scope.nomgroups[0];
            console.log(results);
        });
        $scope.utilisateur.sexe = 'M';
    }
    $scope.Enregistrement = {
        pseudo: '',
        name: '',
        surname: '',
        sexe: '',
        phone: '',
        fonction: '',
        email: ''
    }
    $scope.Enregistrement = function(utilisateur) { // Ici on enrégistre ou on modifie un utilisateur
        if ($rootScope.actionsMenue == 'ecriture') {
            console.log(utilisateur);
            $scope.utilisateur.uid = utilisateur.uid;
            $scope.utilisateur.idbanque = utilisateur.idbanque.id;
            $scope.utilisateur.idagence = utilisateur.idagence.idagence;
            $scope.utilisateur.idnomgroup = utilisateur.idnomgroup.idnomgroup;
            if (utilisateur.uid > 0) {
                console.log($scope.utilisateur.idbanque);
                Data.put('ModificationUsures/' + $scope.utilisateur.uid, utilisateur).then(function(result) {
                    Data.toast(result);
                    /*Data2.toast(results);*/
                    console.log(result);
                    if (result.status != 'error') {
                        var x = angular.copy(utilisateur);
                        x.save = 'update';
                        $modalInstance.close(x);
                    }
                });
            } else {
                console.log(utilisateur);
                utilisateur.etat = 'Actif';
                Data.post('newcount', {
                    customer: utilisateur
                }).then(function(result) {
                    Data.toast(result);
                    if (result.status != 'error') {
                        var x = angular.copy(utilisateur);
                        x.save = 'insert';
                        x.uid = result.data;
                        $modalInstance.close(x);
                    }
                });
            }
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    };
})