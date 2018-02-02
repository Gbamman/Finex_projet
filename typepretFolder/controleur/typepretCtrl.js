app.controller('TypePretCtrl', function ($scope, $rootScope, $routeParams, $location,Data,contratFactory,$modal,ngDialog, $timeout,$filter) {
$scope.typPretAll={};
 var verification='0';
 $scope.DeleteTypePret = function(TypePretDelete){
    console.log(TypePretDelete);
        if(confirm("Est vous sure de vouloir supprimer cette banque " + TypePretDelete.libelle + "?")){
             Data.delete("DeleteTypePretPath/"+TypePretDelete.idtypepret).then(function(results){
                Data.toast(results);
              $scope.typePretsAll = _.without($scope.typePretsAll, _.findWhere($scope.typePretsAll, {idtypepret:TypePretDelete.idtypepret}));
               /* $scope.products = _.without($scope.products, _.findWhere($scope.products, {id:product.id}));*/

            });
        }
    }; 

    $scope.DeleteCoassureur = function(CoassureurDelete){
    console.log(CoassureurDelete);
        if(confirm("Est vous sure de vouloir supprimer cette banque " + CoassureurDelete.nomcoassureur + "?")){
            Data.post("DeleteCoassureurPath",CoassureurDelete).then(function(results){
                Data.toast(results);
               $scope.coassureurs= _.without($scope.coassureurs, _.findWhere($scope.coassureurs, {idcoass:CoassureurDelete.idcoass}));
               /* $scope.products = _.without($scope.products, _.findWhere($scope.products, {id:product.id}));*/

            });
        }
    }; 
     $scope.changerEtatTypePret = function(TypePretStatus){
                              TypePretStatus.etat= (TypePretStatus.etat==0 ? 1 : 0);
                              Data.put('TypePretUpdate/'+TypePretStatus.idtypepret,{etat:TypePretStatus.etat,table:'typepret'}).then(function(result){ 
                                Data.toast(result)
                              });;
                          };

    $scope.changerEtatCoassureur = function(CoassureurStatus){
                             CoassureurStatus.etat= (CoassureurStatus.etat==0 ? 1 : 0);
                              Data.put('CoassureurUpdate/'+CoassureurStatus.idcoass,{etat:CoassureurStatus.etat,table:'coassureur'}).then(function(result){ 
                                Data.toast(result)
                              });;
                          };

  Data.get('gestiontypePretsAll').then(function (results) {
                 
                                 verification='0';
                                 console.log(results);
                            
               $scope.typePretsAll = results.data;
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 5; //max no of items to display in a page
                $scope.filteredItems =   $scope.typePretsAll.length; //Initially for no filter  
                $scope.totalItems =  $scope.typePretsAll.length;
                    });
  Data.get('gestionCoassurance').then(function (results) {
                 
                                 verification='0';
                                 console.log(results);
                           if (results.data.length>0) {
                               $scope.coassureurs = results.data;
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 5; //max no of items to display in a page
                $scope.filteredItems =   $scope.coassureurs.length; //Initially for no filter  
                $scope.totalItems =   $scope.coassureurs.length;

                           }; 
               
                    });
  
  $scope.menusAction= function(valeur){
     verification=valeur;
console.log(valeur);
  }

   $scope.editTypePret = function (p,size) {
      if(verification=='1'){
        var cheminmenuedit='typepretFolder/vue/coassureurAdmin.html';
        var controlmenuedit ='coassureurAdmin';
      }else{
        var cheminmenuedit='typepretFolder/vue/typespretAdmin.html';
        var controlmenuedit ='typeprteCrtlEdith';
      }
        var modalInstance = $modal.open({
          templateUrl: cheminmenuedit,
          controller: controlmenuedit,
          size: size,
          resolve: {
            item: function () {
              
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
              if (selectedObject.verif =='typepretInsert') {
                 $scope.typePretsAll.push(selectedObject);
                $scope.typePretsAll = $filter('orderBy')($scope.typePretsAll, 'idtypepret', 'reverse');
              };
               if(selectedObject.verif =='CoassureurInsert'){
                 $scope.coassureurs.push(selectedObject);
                $scope.coassureurs = $filter('orderBy')($scope.coassureurs, 'idcoass', 'reverse');
               }
            }else if(selectedObject.save == "update"){
               if (selectedObject.verif =='typepretModif') {
              p.id = selectedObject.id;
              p.libelleBanque = selectedObject.libelleBanque;
              p.libelle = selectedObject.libelle;
              p.etat = selectedObject.etat;
              }
              if(selectedObject.verif=='CoassureurModif') {
                p.idcoass = selectedObject.idcoass;
              p.nomcoassureur = selectedObject.nomcoassureur;
              p.part = selectedObject.part;
              p.logo = selectedObject.logo;
              p.etat = selectedObject.etat;

              } 
            }
        }); 

}
})