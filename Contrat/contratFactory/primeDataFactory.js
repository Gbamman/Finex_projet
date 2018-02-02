app.factory("primeDataFact", function (Data,$rootScope){
 var primeDataObjet ={};
 primeDataObjet.getprimeData = function (primeData) {
 	return Data.post('SimulationPath',primeData);
 }
 return primeDataObjet
});