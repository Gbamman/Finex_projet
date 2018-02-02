app.factory("Data", ['$http','toaster', '$location',
    function ($http,toaster,$q, $location) {
        var serviceBase = 'api/v1/';
        var obj = {};
          obj.toast = function (data) {
            toaster.pop(data.status, "", data.message, 10000, 'trustedHtml','toast-top-full-width');
 
        }

        obj.get = function (q) {
            return $http.get(serviceBase + q).then(function (results) {
              /*  console.log('Execution de chemin',serviceBase + q);
                console.log('Execution de get', results.data);*/
                return results.data;
            });
        };
        obj.post = function (q, object) {
            return $http.post(serviceBase + q, object).then(function (results) {
               /* console.log('Execution de chemin', serviceBase + q);
                console.log('Execution de post', results);*/
                return results.data;
            });
        };
        obj.put = function (q, object) {
            return $http.put(serviceBase + q, object).then(function (results) {
               /* console.log('Execution de chemin', serviceBase);
                console.log('Execution de put', results.data);*/
                return results.data;
            });
        };
        obj.delete = function (q) {
            return $http.delete(serviceBase + q).then(function (results) {
               /* console.log('Execution de chemin', serviceBase);
                console.log('Execution de delete', results.data);*/
                return results.data;
            });
        };
        return obj;
}]);
