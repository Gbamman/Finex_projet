   app.controller('helpCtrl',["$location","$sce","$scope","Data","$q","$rootScope",
    function ($sce,$scope,Data,$rootScope,$location,API,$q) {
         
           $scope.materiel=null;  
                    var first = Data.get('gestionMenueVideos');
                    $q.all([first]).then(function (result) {
                    var boom;
                     var Tableau=[];
                     angular.forEach(result, function(response) {

                        for (var i = 0; i < response.data.length; i++) {
                        response[i].nomcourt;
                        boom={src: $sce.trustAsResourceUrl("help/videos/"+response[i].nomcourt+".mp4")};
                    };
                });
                    Tableau.push(boom);
                     return Tableau;
                    }).then(function(tmpResult) {
                        console.log(tmpResult);
                    });
                    
             
            // var chemin = $location.path();
 $scope.API =API;
            $scope.attibusplay=$scope.API;
            $scope.jouer= function  () {
                $scope.play=function(){
            
            $scope.API.play();
           }
                $scope.play();
            }
           var  Dossier=chemin.replace('/','')
            /*$scope.materiel=$sce.trustAsResourceUrl("help/videos/"+Dossier+".mp4");
           console.log(Dossier);*/
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
    app.directive("myPlayButton",
        function() {
            return {
                restrict: "E",
                require: "^videogular",
                template: "<div class='iconButton' ng-click='jouer()'>PLAY</div>",
                link: function(scope, elem, attrs, API) {
                    scope.API = API;

                }
            }
        }
    );