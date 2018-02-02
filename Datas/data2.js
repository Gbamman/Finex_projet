app.factory("Data2", ['$http','toaster','$location',
    function ($http,toaster, $q, $location) {
        var serviceBase = 'api/v2/';
        var obj = {};
         obj.toast = function (data) {
            toaster.pop(data.status, "", data.message, 10000, 'trustedHtml','toast-top-full-width');
            /*toaster.options = {
                  "closeButton": false,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": true,
                  "positionClass": "toast-top-right",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
            }*/
        }
        obj.get = function (q) {
            return $http.get(serviceBase + q).then(function (results) {
                /*console.log('Execution de chemin', serviceBase);
                console.log('Execution de get', results.data);*/
                return results.data;
            });
        };
        obj.post = function (q, object) {
            return $http.post(serviceBase + q, object).then(function (results) {
                /*console.log('Execution de chemin', serviceBase);
                console.log('Execution de post', results.data);*/
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
