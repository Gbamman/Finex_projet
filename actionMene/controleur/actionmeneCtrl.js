app.controller('actionmeneCtrl', function($scope, $rootScope, $modalInstance, $http, item, Data, toaster) {
      $scope.cancel = function() {
          $modalInstance.dismiss('Close');
      };
      $scope.actionmene = angular.copy(item);
      var original = item;
      $scope.isClean = function() {
          return angular.equals(original, $scope.actionmene);
      }

      Data.get('gestionutilisteur').then(function(results) {
          if (results.status == "success") {

              $scope.utilisateurs = results.data;
          }
      });



      $scope.saveActionmene = function(actionmene) {
          var debut = moment($scope.actionmene.datedebut).valueOf();
          var fin = moment($scope.actionmene.datefin).valueOf();
          tabdeb = (actionmene.datedebut.split(/[- //]/));
          tabfin = (actionmene.datefin.split(/[- //]/));
          Odeb = new Date(tabdeb[2], tabdeb[1], tabdeb[0]);
          Ofin = new Date(tabfin[2], tabfin[1], tabfin[0]);
          console.log('Données enoyées en paramètres pour etat:', actionmene);
          /*var data= {datefin: $scope.etatProduction.datefin
          ,datedebut:$scope.etatProduction.datedebut
          ,niveau:$scope.etatProduction.niveau
          ,banque:($scope.etatProduction.idbanque!==undefined)?$scope.etatProduction.idbanque.id:undefined
          ,agence:($scope.etatProduction.idagence!==undefined)?$scope.etatProduction.idagence.idagence:undefined
          ,utilisateur:$scope.etatProduction.uid};
          actionmene.datefin=moment(value,"DD/MM/YYYY").isValid() ? actionmene.datefin : null;
          actionmene.datedebut=moment(actionmene.datedebut,"DD/MM/YYYY").isValid() ? actionmene.datedebut : null;
          */
          // console.log('Data:', data);
          if (Odeb <= Ofin) {
              actionmene.uid = parseInt(actionmene.uid) > 0 ? actionmene.uid : null;
              $http({
                      url: 'vue/actionmene.php',
                      method: 'POST',
                      data: $.param({
                          datefin: actionmene.datefin,
                          datedebut: actionmene.datedebut,
                          utilisateur: actionmene.uid
                      }),
                      responseType: 'arraybuffer',
                      headers: {
                          'Content-Type': 'application/x-www-form-urlencoded',
                          'Content-type': 'application/json',
                          'Accept': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                      }
                  })
                  .success(function(data, status, headers, config) {
                      /*var Actionmene ='Exportation de l\'etat de production';
                      Data.post('ActionmenePath', {Actionmene : Actionmene}).then(function (result) {
                      console.log(result);
                      })*/
                      $modalInstance.close(data);
                      console.log("Get report data: " + data);
                      var blob = new Blob([data], {
                          type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                      });
                      saveAs(blob, "Action.pdf");
                      /*var objectUrl = URL.createObjectURL(blob);
                      window.opeobjectUrl); arraybuffer*/
                  })
          } else {
              toaster.pop('Info', "Information", 'La date de fin ne doit pas être antérieure à la date du début.');
              $scope.actionmene.datedebut = " ";
              $scope.actionmene.datefin = " ";
              return false;
          }
    }
});