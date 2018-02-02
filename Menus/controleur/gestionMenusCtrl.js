app.controller('MenusCtrl', function($scope, $rootScope, $routeParams, $location, Data, $modal, $filter, toaster) {
    $scope.menuall = {};
    $scope.sousmenuall = {};
    var verification = '0';
    // console.log($rootScope.actionsMenue);
    $scope.deleteMenue = function(sousmenuall) {
        // console.log(sousmenuall);
        if (confirm("Est vous sure de vouloir supprimer le sousmenu " + sousmenuall.libelleSousMenue + "?")) {
            Data.delete("effacersousmenus/" + sousmenuall.idsousmenu).then(function(results) {
                Data.toast(results);
                $scope.sousmenusAll = _.without($scope.sousmenusAll, _.findWhere($scope.sousmenusAll, {
                    idsousmenu: sousmenuall.idsousmenu
                }));
                /* $scope.products = _.without($scope.products, _.findWhere($scope.products, {id:product.id}));*/

            });
        }
    };

    $scope.deleteMenueAll = function(menuAlldelete) {
        // console.log(menuAlldelete);
        if (confirm("Est vous sure de vouloir supprimer le sousmenu " + menuAlldelete.libelle + "?")) {
            Data.delete("clear_in_menus/" + menuAlldelete.idmenue).then(function(results) {
                Data.toast(results);
                $scope.menusAll = _.without($scope.menusAll, _.findWhere($scope.menusAll, {
                    idmenue: menuAlldelete.idmenue
                }));
                /* $scope.products = _.without($scope.products, _.findWhere($scope.products, {id:product.id}));*/

            });
        }
    };

    $scope.sousmenusAction = function() {
        Data.get('gestionsousMenue').then(function(results) {
            verification = results.verification;

            // console.log(results);

            $scope.sousmenusAll = results.data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 5; //max no of items to display in a page
            $scope.filteredItems = $scope.sousmenusAll.length; //Initially for no filter  
            $scope.totalItems = $scope.sousmenusAll.length;
        });
    }
    $scope.menusAction = function() {
        verification = '0';
    }
    Data.get('gestionmenus').then(function(result) {
        verification = result.verification;
        /* $scope.menusAll = result.data;
        console.log(result);*/
        if (result.data.length > 0) {
            $scope.menusAll = result.data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 5; //max no of items to display in a page
            $scope.filteredItems = $scope.menusAll.length; //Initially for no filter  
            $scope.totalItems = $scope.menusAll.length;
        }
    });
    $scope.editMenu = function(p, size) {
        if ($rootScope.actionsMenue == 'modification' || $rootScope.actionsMenue == 'ecriture') {
            if (verification == '1') {
                var cheminmenuedit = 'Menus/vue/sousmenusAdmin.html';
                var controlmenuedit = 'editSousMenus';
            } else {
                var cheminmenuedit = 'Menus/vue/menusAdmin.html';
                var controlmenuedit = 'editMenus';
            }
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
                    if (selectedObject.verif == "Menus") {
                        $scope.menusAll.push(selectedObject);
                        $scope.menusAll = $filter('orderBy')($scope.menusAll, 'idmenue', 'reverse');
                    };
                    if (selectedObject.verif == "Sousmenus") {
                        $scope.sousmenusAll.push(selectedObject);
                        $scope.sousmenusAll = $filter('orderBy')($scope.sousmenusAll, 'idsousmenu', 'reverse');

                    }

                } else if (selectedObject.save == "update") {
                    if (selectedObject.verif == "Menus") {
                        p.libelle = selectedObject.libelle;
                        p.icon = selectedObject.icon;
                    }
                    if (selectedObject.verif == "Sousmenus") {
                        p.libelleSousMenue = selectedObject.libelleSousMenue;
                        p.allsousmenus = selectedObject.allsousmenus;
                        p.nomcourt = selectedObject.nomcourt;
                    }

                }
            });
        } else {
            toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
        }

    }
})