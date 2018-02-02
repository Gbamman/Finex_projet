app.factory("contratFactory", function(Data2, $rootScope) {
    var contrats = {};
    contrats.getContrats = function() {
        var obj = {
            iduser: $rootScope.uid,
            idbanque: $rootScope.idbanque,
            idagence: $rootScope.idagence
        };
        return Data2.get('contratrecup');
    }
    return contrats
});

app.factory("contratFactoryTraitement", function(Data2, $rootScope) {
    var contrats = {};
    contrats.getContratsTraitement = function() {
        var obj = {
            iduser: $rootScope.uid,
            idbanque: $rootScope.idbanque,
            idagence: $rootScope.idagence
        };
        return Data2.get('contratrecupTraitement');
    }
    return contrats
});

app.factory('fileReader', ['$q', '$log', function($q, $log) {
    /*return function name(){

    };*/

    var onLoad = function(reader, deferred, scope) {
        return function() {
            scope.$apply(function() {
                deferred.resolve(reader.result);

            });
        };
    };

    var onError = function(reader, deferred, scope) {
        return function() {
            scope.$apply(function() {
                deferred.reject(reader.result);
            });
        };
    };

    var onProgress = function(reader, scope) {
        return function(event) {
            scope.$broadcast("fileProgress", {
                total: event.total,
                loaded: event.loaded
            });
        };
    };

    var getReader = function(deferred, scope) {
        var reader = new FileReader();
        reader.onload = onLoad(reader, deferred, scope);
        reader.onerror = onError(reader, deferred, scope);
        reader.onprogress = onProgress(reader, scope);
        return reader;
    };

    var readAsDataURL = function(file, scope) {
        var deferred = $q.defer();

        var reader = getReader(deferred, scope);
        reader.readAsDataURL(file);

        return deferred.promise;
    };

    return {
        readAsDataUrl: readAsDataURL
    };


}])
app.factory('ActionSurMenue', function() {
    var items = [];
    var itemsService = {};
    itemsService.actionsMenue = function(argument) {
        itemsService.DroitUtilisateur = argument;
    }
    itemsService.add = function(item) {
        items.push(item);
    };
    itemsService.list = function() {
        return items;
    };

    return itemsService;
})

app.filter('numCompte', function() {
    return function(text) {
        return text.replace('|num', '');
    };
});

app.filter("comeBack", function($filter, $window) {
    var moment = $window.moment;
    return function(value) {

        if (moment(value, "YYYY-MM-DD").isValid()) {
            return true;
        } else {
            return false;
        }

    }

});