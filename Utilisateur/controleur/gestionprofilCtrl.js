app.controller('ProfilCtrl', function($scope, $rootScope, $routeParams, $location, $http, Data2, Data, contratFactory, $modal, ngDialog, $timeout, $filter) {
    $scope.nomgrouputilisateur = {};
    $scope.listenamegroupe = {};
    $scope.ModelGroupe = {};
    $scope.gestionProfilObjet = {};
    var verification = '1';
    var cheminmenuedit = '';
    var controlmenuedit = '';
    $scope.sousmenusAction = function(verif) {
        verification = verif;

    }

    console.log($rootScope.actionsMenue);
    $scope.deleteMenue = function(sousmenuall) { // Cette fonction permet de supprimer un Sous Menus
        console.log(sousmenuall);
        if (confirm("Est vous sure de vouloir supprimer le sousmenu " + sousmenuall.libelleSousMenue + "?")) {
            Data.delete("effacersousmenus/" + sousmenuall.idsousmenu).then(function(results) {
                Data.toast(results);
                $scope.sousmenusAll = _.without($scope.sousmenusAll, _.findWhere($scope.sousmenusAll, {
                    idsousmenu: sousmenuall.idsousmenu
                }));
            });
        }
    };
    $scope.surpNomgrp = function(nomGroupSuppr) { // Cette fonction permet de supprimer le nom d'un groupe utilisateur.
        if (confirm("Est vous sure de vouloir supprimer le nom de ce groupe " + nomGroupSuppr.libelle + "?")) {
            Data.delete("nomGrpSupprPath/" + nomGroupSuppr.idnomgroup).then(function(results) {
                Data.toast(results);
                $scope.nomgrouputilisateurs = _.without($scope.nomgrouputilisateurs, _.findWhere($scope.nomgrouputilisateurs, {
                    idnomgroup: nomGroupSuppr.idnomgroup
                }));
            });
        }
    };
    $scope.surpGrpUsers = function(GroupUser) { // Cette fonction permet de supprimer le groupe utilisateur 
        if (confirm("Est vous sure de vouloir supprimer ce groupe " + GroupUser.libelle + "?")) {
            Data.delete("nomGrpUserPath/" + GroupUser.idgroup).then(function(results) {
                Data.toast(results);
                $scope.ListeNameGroupe = _.without($scope.ListeNameGroupe, _.findWhere($scope.ListeNameGroupe, {
                    idgroup: GroupUser.idgroup
                }));
            });
        }
    };
    $scope.surpProfilUsers = function(nomProfilUser) { // Cette fonction permet de supprimer un profil. 
        if (confirm("Est vous sure de vouloir supprimer ce profil " + nomProfilUser.libelleProfil + "?")) {
            Data.delete("delectProfil/" + nomProfilUser.idprofil).then(function(results) {
                Data.toast(results);
                $scope.ListeProfilName = _.without($scope.ListeProfilName, _.findWhere($scope.ListeProfilName, {
                    idprofil: nomProfilUser.idprofil
                }));
            });
        }
    };
    Data.get('gestionnomgroupeutilisateur').then(function(result) { // Ici nous recupérons la liste de groupes utilisateurs et gérons la pagination.
        /* verification=result.verification;*/
        console.log(result);
        if (result.data.length > 0) {
            $scope.nomgrouputilisateurs = result.data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 5; //max no of items to display in a page
            $scope.filteredItems = $scope.nomgrouputilisateurs.length; //Initially for no filter  
            $scope.totalItems = $scope.nomgrouputilisateurs.length;
        }
    });


    /*  Data.get('listenamegroupe').then(function (results) { // Ici nous recupérons la liste des noms de groupe utilisateur et gérons la pagination.
    /*   verification=results.verification;  
    if (results.data.length>0) {
    $scope.ListeNameGroupe  = results.data; 
    $scope.currentPage = 1; //current page
    $scope.entryLimit = 5; //max no of items to display in a page
    $scope.filteredItems =  $scope.ListeNameGroupe.length; //Initially for no filter  
    $scope.totalItems =  $scope.ListeNameGroupe.length;
    }


    }); */
    /* Data.get('Get_gestionProfil').then(function (results) { // Ici nous recupérons la liste de profils utilisateurs et gérons la pagination.
    /*   verification=results.verification;  
    if (results.data.length>0) {
    $scope.ListeProfilName  = results.data; 
    $scope.currentPage = 1; //current page
    $scope.entryLimit = 5; //max no of items to display in a page
    $scope.filteredItems =   $scope.ListeProfilName.length; //Initially for no filter  
    $scope.totalItems =   $scope.ListeProfilName.length;
    }

    });
    */
    $scope.sousmenusAction = function(verif) { // cette fonction nous permet quel url et controlleur
        /* verification =verif;*/
    }

    $scope.editNomgrp = function(p, size) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            var longeur = (p.idnomgroup > 0) ? 'lg' : size;
            if (verification == '1') {
                cheminmenuedit = 'Utilisateur/vue/nomgrpAdmin.html';
                controlmenuedit = 'editnomgrpCtrl';
            } else if (verification == '0') {
                cheminmenuedit = 'Utilisateur/vue/grputilisateurAdmin.html';
                controlmenuedit = 'GrputilisateurCtrl';
            } else {
                cheminmenuedit = 'Utilisateur/vue/gestionDeProfilAdmin.html';
                controlmenuedit = 'GestionProfilCtrl';
            }
            var modalInstance = $modal.open({
                templateUrl: cheminmenuedit,
                controller: controlmenuedit,
                size: longeur,
                resolve: {
                    item: function() {

                        return p;
                    }
                }
            });
            modalInstance.result.then(function(selectedObject) {
                if (selectedObject.save == "insert") {
                    if (selectedObject.verif == "saveGroupe") {
                        $scope.ListeNameGroupe.push(selectedObject);
                        $scope.ListeNameGroupe = $filter('orderBy')($scope.ListeNameGroupe, 'idgroup', 'reverse');
                    };
                    if (selectedObject.verif == "NomgrpInsert") {
                        $scope.nomgrouputilisateurs.push(selectedObject);
                        $scope.nomgrouputilisateurs = $filter('orderBy')($scope.nomgrouputilisateurs, 'idnomgroup', 'reverse');
                        console.log($scope.nomgrouputilisateurs);
                    }
                    if (selectedObject.verif == "ProfilInsert") {
                        $scope.ListeProfilName.push(selectedObject);
                        $scope.ListeProfilName = $filter('orderBy')($scope.ListeProfilName, 'idprofil', 'reverse');
                    };
                } else if (selectedObject.save == "update") {
                    if (selectedObject.verif == "NomgrpMofif") {
                        p.libelle = selectedObject.libelle;
                        p.idnomgroup = selectedObject.idnomgroup;
                        p.chemin = selectedObject.chemin;
                    }
                    if (selectedObject.verif == "udpdateGroupe") {
                        p.libelleSousMenue = selectedObject.libelleSousMenue;
                        p.libelle = selectedObject.libelle;
                        p.idgroup = selectedObject.idgroup;
                        p.idsousmenu = selectedObject.idsousmenu;
                        p.actionMenue = selectedObject.actionMenue;
                        p.idnomgroup = selectedObject.idnomgroup;
                    }
                    if (selectedObject.verif == "ProfilMofif") {
                        p.idprofil = selectedObject.idprofil;
                        p.idnomgroup = selectedObject.idnomgroup;
                        p.libelleNomGroupe = selectedObject.libelleNomGroupe;
                        p.libelleProfil = selectedObject.libelleProfil;
                        p.chemin = selectedObject.chemin;
                    };
                }

            });
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }
})