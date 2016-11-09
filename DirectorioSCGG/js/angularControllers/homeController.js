/// <reference path="../js/jquery-2.2.3.intellisense.js" />
/// <reference path="routeController.js" />

scggApp.controller('homeController', ["$scope", "$location", "scggApi", "scggFactory", function($scope, $location, scggApi, scggFactory){

    $scope.usuario = scggFactory.UserObejct;
    //$scope.instituciones = scggFactory.Instituciones;
    var url = "routes/DirectorioRoute.php?opcion=";

    if(scggFactory.UserObejct.IdUsuario === undefined && !scggFactory.logeado)
    {
        $location.path("/");
    }

    $scope.listarInstituciones = function(){
    	if (Object.keys(scggFactory.UserObejct).length >= 0) {
            //$location.path("/inst");
            $location.path("/inst");
    		/*scggApi.httpGetSinParametros(url + "listarInstituciones").then(
    			function (response) {
                 	scggFactory.SetInstitucionesObject(response.data);
    				
    			}, 
    			function (response) {
    			
    			});*/
    	}else {
    		$location.path("/");
    	}
    }
}]);

