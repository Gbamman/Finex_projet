app.controller('contratTraitementCtrl', function($scope,$http, toaster, Data2, contratFactoryTraitement) {

// Recuperation de la liste des contrats pour traitement;
contratFactoryTraitement.getContratsTraitement().then(function(data) {

    /* $scope.list = data.data;*/
    console.log(data);

    if (data.status == 'success') {
        $scope.productsTraitement = data.data;
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 50; //max no of items to display in a page
        $scope.filteredItems = $scope.productsTraitement.length; //Initially for no filter  /getContratPdf
        $scope.totalItems = $scope.productsTraitement.length;
    };
});

// Recherche des contrats pour tritement
$scope.searchContratTraitement = function(criteres) {
    Data2.post('SearchContratPath', {
        criteres: criteres
    }).then(function(result) {
        console.log(result);
        if (result.status != 'success') {
            Data2.toast(result);
        }
        if (result.status == 'success') {
            $scope.productsTraitement = result.data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 50; //max no of items to display in a page
            $scope.filteredItems = $scope.productsTraitement.length; //Initially for no filter  
            $scope.totalItems = $scope.productsTraitement.length;
        };
    })
}
})
});