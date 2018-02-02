app.service('fileBankUpload',['$http','Data',function ($http,Data) {
    this.uploadFileToUrl = function(file,uploadUrl){
         this.retourneValue= getPath;
        var fd = new FormData();
        fd.append('file', file);
        function getPath (callback){
        $http.post(uploadUrl, fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        })
        .success(function(data){
           /* Data.toast(data);*/
            callback(data);
            
        })
        .error(function(errordata){
            console.log(errordata);
        });
    }
    }
}])