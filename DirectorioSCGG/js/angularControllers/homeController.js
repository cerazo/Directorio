/// <reference path="../js/jquery-2.2.3.intellisense.js" />
/// <reference path="routeController.js" />

scggApp.controller('homeController', ["$scope", "$location", "scggApi", "scggFactory", function($scope, $location, scggApi, scggFactory){

    $scope.mensaje = 'Estas en Home';
    $scope.usuario = scggFactory.UserObejct;
    //$scope.instituciones = scggFactory.Instituciones;
    var url = "", opcion = "";

    if(scggFactory.UserObejct.IdUsuario === undefined && !scggFactory.logeado)
    {
        $location.path("/");
    }

    $scope.ListarInstituciones = function(){
    	if (Object.keys(scggFactory.UserObejct).length >= 0) {
            //$location.path("/inst");
    		opcion = "listarInstituciones";
            url = "routes/UsuarioRoute.php?opcion=" + opcion;
    		scggApi.httpGetSinParametros(url).then(
    			function (response) {
                 scggFactory.SetInstitucionesObject(response.data);
    				$location.path("/inst");
    			}, 
    			function (response) {
    			
    			});
    	}else {
    		$location.path("/");
    	}
    }


}]);

scggApp.controller('instController', ['$scope', 'scggFactory', 'scggApi', function($scope, scggFactory, scggApi){
    $scope.mensaje = 'Instituciones del Estado de Honduras';
    $scope.instituciones = [];//scggFactory.Instituciones;
    $scope.institucion = {};
    var url = "routes/UsuarioRoute.php?opcion=";

    $scope.loadInstituciones = function () {

        //var opcion = "listarInstituciones";
        scggApi.httpGetSinParametros(url + 'listarInstituciones').then(
            function (response) {
             //scggFactory.SetInstitucionesObject(response.data);
             $scope.instituciones = response.data;
               // $location.path("/inst");
            }, 
            function (response) {
            
            });
     }   

    $scope.getInstitucion = function (id) {
        if (id != undefined) {
            scggApi.httpPost(url + 'getInst', {'id': id}).then(
                function (response) {
                    if (angular.isObject(response.data)) {
                        $scope.institucion = response.data;
                    };
                },
                function (response) {
                    UtilToastMessage.errorGeneral("Ocurrio un error al cargar la informacion, por favor intente de nuevo.");
                });
        };
    };

    $scope.editarIstitucion = function () {
        scggApi.httpPost(url + 'editInst', {'data': $scope.institucion}).then(
            function (response) {
                if (response.status === 200) {
                    UtilToastMessage.succesGeneral('El registro fue modificado con exíto.');
                }else {
                    UtilToastMessage.errorGeneral('Ocurrio un error al modificar el registro. Intente de nuevo.');
                }
            }, 
            function (response) {
                
            });
    };

    $scope.eliminarInstitucion = function (id) {
        scggApi.httpPost(url + 'deleteInst', {'id': id}).then(
            function (response){
                $scope.institucion.remove(id);
            }, function (response) {
                
            });
            
    };
    
}]);