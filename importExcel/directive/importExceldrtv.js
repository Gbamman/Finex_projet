app.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;
           /* document.getElementById("uploadBtn").onchange = function () {
          document.getElementById("uploadFile").value = this.value;
            };  */
            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                     document.getElementById("uploadFile").value=element[0].files[0].name;
                     // console.dir(scope.myFile);
                });
            });
        }
    };
}]);

app.directive('fileModelregl', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModelregl);
            var modelSetter = model.assign;
           /* document.getElementById("uploadBtn").onchange = function () {
          document.getElementById("uploadFile").value = this.value;
            };  */
            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                     document.getElementById("uploadFileReglement").value=element[0].files[0].name;
                     // console.dir(scope.myFile);
                });
            });
        }
    };
}]);


app.directive('importProgress', function($animate) {
  return function(scope, elem, attr) {
        scope.$watch(attr.importProgress, function(nv,ov) {
          if (nv!=ov) {
                var c = 'change-progress-up';
                $animate.addClass(elem,c,'slow',function() {
                $animate.removeClass(elem,c,'fast');
            });
          }
        });
          
  }  
});
