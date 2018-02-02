app.controller('importSqlCtrl',  function ($scope,fileUpload,$rootScope,$location,$modalInstance,$http,item, Data2,Data,$modal,$window,datetime,$filter,toaster) {
 $scope.fichier = angular.copy(item);
  $scope.cancel = function () {
            $modalInstance.dismiss('Close');
        }; 
        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.fichier);
        }
 $scope.uploadFile = function(){
         	var file = $scope.myFile;
         	var fichierExcel=file.name;
         	// console.log('file is ' );
         	   // console.dir(file);
         	   /*var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');*/
         	   var filename = $('input[type=file]').val();
         	    // console.log(filename);
                /*var uploadUrl = "http://localhost/sahgescredit/uploader/fileUpload/traitement.php";*/
		        var uploadUrl = "http://localhost/sahgescredit/uploader/fileUpload/traitement.php";
        	fileUpload.uploadFileToUrl(file, uploadUrl);
         /*Data.post('importationTraitement',{fichierExcel}).then(function (result) { */
         		$modalInstance.dismiss('');
        /*});*/ 	     
    }
});

