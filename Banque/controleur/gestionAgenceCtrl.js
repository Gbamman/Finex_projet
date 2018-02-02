 app.controller('gestionAgenceCtrl', function ($scope, $rootScope,$location,Data,$modal,$filter,toaster) {
 $scope.agence={};
  Data.get('gestionbanque1').then(function (results) {
                                 $scope.agences = results.data;
                                 $scope.agences = results.data;
                               $scope.currentPage = 1; //current page
                              $scope.entryLimit = 5; //max no of items to display in a page
                              $scope.filteredItems =  $scope.agences.length; //Initially for no filter  
                              $scope.totalItems =  $scope.agences.length;
                                           });
 			 $scope.AgenceDelete = function(AgenceDelete){
    // console.log(AgenceDelete);
        if(confirm("Est vous sure de vouloir supprimer cette banque " + AgenceDelete.libelleagence + "?")){
            Data.post("effacerAgence",AgenceDelete).then(function(results){
                Data.toast(results);
               
               $scope.agences = _.without($scope.agences, _.findWhere($scope.agences, {idagence : AgenceDelete.idagence}));
               
               /* $scope.products = _.without($scope.products, _.findWhere($scope.products, {id:product.id}));*/

            });
        }
    }; 

 	  $scope.saveBanque = function (p,size) {
        if($rootScope.actionsMenue=='modification' || $rootScope.actionsMenue=='ecriture' ){
     
        cheminBanqueEdit='Banque/vue/gestionAgenceAdmin.html';
        controlBanqueEdit ='AgenceAdminCtrl';
      
        var modalInstance = $modal.open({
          templateUrl: cheminBanqueEdit,
          controller: controlBanqueEdit,
          size: size,
          resolve: {
            item: function () {
              
              return p;
            }
          }
        });
        
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
            
              if (selectedObject.verif =="agenceInsert") {
                $scope.agences.push(selectedObject);
                $scope.agences = $filter('orderBy')($scope.agences, 'idagence', 'reverse');
              }
            }else if(selectedObject.save == "update"){
           
            if (selectedObject.verif == "agenceUpdate") {
                     p.idagence = selectedObject.idagence;
                     p.libelleagence = selectedObject.libelleagence;
                     p.libellebanque = selectedObject.libellebanque;
                     p.ville = selectedObject.ville;
            };
            }
            
        });   

  
         }else{
                 toaster.pop('error', "Attention", 'Vous n\'êtes pas autorisé à effectuer cette action');
         }
  };  
 })