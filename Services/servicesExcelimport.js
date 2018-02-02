app.service('fileUpload',function ($http,Data) {
    this.uploadFileToUrl = function(file, uploadUrl){
        this.retourneValue= getImportPath;
        var fd = new FormData();
        fd.append('file', file);
         function getImportPath (callback){
        $http.post(uploadUrl, fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        })
        .success(function(data){
            Data.toast(data);
            console.log(data);
            callback(data);
            if (data.status=="success") {
                 
            };
        })
        .error(function(errordata){
            console.log(errordata);
        });
        }
    }
});
