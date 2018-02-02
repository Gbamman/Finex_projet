app.controller('coassureurCtrl', function ($scope, $rootScope, $routeParams, $location,Data,contratFactory,$modal,toaster, $timeout,$filter) {
$scope.coassureur={};
Data.get('gestionCoassurance').then(function (results) {
                 
                                 verification='0';
                                 // console.log(results);
                           if (results.data.length>0) {
                               $scope.coassureurs = results.data;
                $scope.currentPage = 1; //current page
                $scope.entryLimit = 5; //max no of items to display in a page
                $scope.filteredItems =   $scope.coassureurs.length; //Initially for no filter  
                $scope.totalItems =   $scope.coassureurs.length;

                           }; 
               
                    });
 $scope.DeleteCoassureur = function(CoassureurDelete){
  if($rootScope.actionsMenue=='modification' ||$rootScope.actionsMenue=='ecriture' ){ 
    // console.log(CoassureurDelete);
        if(confirm("Est vous sure de vouloir supprimer cette banque " + CoassureurDelete.nomcoassureur + "?")){
            Data.post("DeleteCoassureurPath",CoassureurDelete).then(function(results){
                Data.toast(results);
               $scope.coassureurs= _.without($scope.coassureurs, _.findWhere($scope.coassureurs, {idcoass:CoassureurDelete.idcoass}));
               /* $scope.products = _.without($scope.products, _.findWhere($scope.products, {id:product.id}));*/

            });
        } 
      }else{
                 toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
         }
    }; 

     $scope.changerEtatCoassureur = function(CoassureurStatus){
                              if($rootScope.actionsMenue=='modification' ||$rootScope.actionsMenue=='ecriture' ){  
                             CoassureurStatus.etat= (CoassureurStatus.etat==0 ? 1 : 0);
                              Data.put('CoassureurUpdate/'+CoassureurStatus.idcoass,{etat:CoassureurStatus.etat,table:'coassureur'}).then(function(result){ 
                                Data.toast(result)
                              })
                            }else{
                                     toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
                             }
                          };
  $scope.editTypePret = function (p,size) {
if($rootScope.actionsMenue=='modification' ||$rootScope.actionsMenue=='ecriture' ){  
        var cheminmenuedit='Gestion_CoAss/vue/coassureurAdmin.html';
        var controlmenuedit ='coassureurAdmin';
      		var modalInstance = $modal.open({
          templateUrl: cheminmenuedit,
          controller: controlmenuedit,
          size: size,
          resolve: {
            item: function () {
              
              return p;
            }
          }
        });modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
               if(selectedObject.verif =='CoassureurInsert'){
                 $scope.coassureurs.push(selectedObject);
                $scope.coassureurs = $filter('orderBy')($scope.coassureurs, 'idcoass', 'reverse');
               }
            }else if(selectedObject.save == "update"){
              if(selectedObject.verif=='CoassureurModif') {
                p.idcoass = selectedObject.idcoass;
              p.nomcoassureur = selectedObject.nomcoassureur;
              p.part = selectedObject.part;
              p.logo = selectedObject.logo;
              p.etat = selectedObject.etat;
              p.estAperiteur = selectedObject.estAperiteur;

              } 
            }
        });
        }else{
                 toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
         }
	}

})