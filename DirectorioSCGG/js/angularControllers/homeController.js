
scggApp.controller('homeController', ["$scope", "$location", "scggApi", "scggFactory", function($scope, $location, scggApi, scggFactory){

    $scope.usuario;
    $scope.rol;

    $scope.validarLogin = function () {
        if(scggFactory.UserObejct.IdUsuario !== undefined && scggFactory.logeado)
        {
            $scope.usuario = scggFactory.UserObejct;
            $scope.rol = scggFactory.rol;
        }else {
            $location.path("/");
        }
    };  

    $scope.listarInstituciones = function(){
    	if (Object.keys(scggFactory.UserObejct).length >= 0) {
            $location.path("/Instituciones");
    	}else {
    		$location.path("/");
    	}
    }
}]);

