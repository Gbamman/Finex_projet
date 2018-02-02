app.controller('helpCtrl',
        ["$sce","$rootScope","$scope","Data","$location",function ($sce,$scope,$rootScope,Data,$location) {
              Data.get('gestionMenueVideos').then(function (result) {
                     $scope.video = $sce.trustAsResourceUrl("help/videos/"+result.data[0].nomcourt.url+".mp4");
                    console.log(result);
                 });
             /*   app.filter('trustUrl', function ($sce) {
                return function(url) {
                  return $sce.trustAsResourceUrl("help/videos/"+url+".mp4");
                };
            });*/
            var chemin = $location.path();
           var  Dossier=chemin.replace('/','')
           console.log(Dossier);
            if ($rootScope.nomcourt=='help') {
               var videos='video2';
            }
            this.config = {
                preload:'',
                sources: [
                    {src: $sce.trustAsResourceUrl("help/videos/"+Dossier+".mp4"), type: "video/mp4"},
                    {src: $sce.trustAsResourceUrl("help/videos/"+Dossier+".webm"), type: "video/webm"},
                    {src: $sce.trustAsResourceUrl("help/videos/"+Dossier+".ogg"), type: "video/ogg"},
                    {src: $sce.trustAsResourceUrl("help/videos/"+Dossier+".avi"), type: "video/avi"}
                ],
                tracks: [
                    {
                        src: "red",
                        kind: "subtitles",
                        srclang: "fr",
                        label: "French",
                        default: ""
                    }
                ],
                theme: {
          url: "css/bower-videogular-themes-default-master/videogular.css"
                },
                plugins: {
                    controls: {
                        autoHide: false
                    }
                }
            };
        }]
    )
    app.directive("myStopButton",
        function() {
            return {
                restrict: "E",
                require: "^videogular",
                template: "<div class='iconButton' ng-click='API.stop()'>STOP</div>",
                link: function(scope, elem, attrs, API) {
                    scope.API = API;
                }
            }
        }
    );
   