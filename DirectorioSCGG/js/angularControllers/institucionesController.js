

scggApp.controller('instController', ['$scope', 'scggFactory', 'scggApi', function($scope, scggFactory, scggApi){
    $scope.titulo = 'Crear Nueva Institucion';
    $scope.instituciones;
    $scope.institucion = {};
    //$scope.rol = scggFactory.UserObejct.IdRol;
    $scope.crear = true;
    var url = "routes/DirectorioRoute.php?opcion=";

        scggApi.httpGetSinParametros(url + 'listarInstituciones').then(
            function (response) {
                if (angular.isObject(response.data)) {
                    scggFactory.SetInstitucionesObject(response.data);
                    $scope.instituciones = scggFactory.GetInstituciones();
                }else {
                    UtilToastMessage.errorGeneral("Ocurrio  un error al cargar la informacion. Intente de nuevo.");
                }
               // $location.path("/inst");
            }, 
            function (response) {
            
            });
     };   

    $scope.getInstitucion = function (id) {
        $scope.titulo = 'Editar Institucion';
        $scope.crear = false;
        if (id != undefined) {
            scggApi.httpPost(url + 'getInstId', {'id': id}).then(
                function (response) {
                    if (angular.isObject(response.data)) {
                        $scope.institucion.Id = response.data.Id;

    $scope.loadInstituciones = function () {
                        $scope.institucion.Nombre = response.data.Nombre;
                        $scope.institucion.Siglas = response.data.Siglas;
                        $scope.institucion.Estado = response.data.Estado;
                        $scope.institucion.PaginaWeb = response.data.PaginaWeb;
                        $scope.institucion.Direccion = response.data.Direccion;
                        $scope.institucion.Telefono = response.data.Telefono;
                        $scope.institucion.Descripcion = response.data.Descripcion;
                    };
                },
                function (response) {
                    UtilToastMessage.errorGeneral("Ocurrio un error al cargar la informacion, por favor intente de nuevo.");
                });
        };
        $scope.crear = true;
    };

    $scope.editarIstitucion = function () {
        scggApi.httpPost(url + 'editInst', {'data': $scope.institucion}).then(
            function (response) {
                if (response.data) {
                    UtilToastMessage.successGeneral('El registro fue modificado con exíto.');
                    $scope.loadInstituciones();
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
                if (response.data) {
                    $scope.institucion.remove(id);
                }
                
            }, function (response) {
                
            });
    };

    $scope.SetObject = function () {
        $scope.institucion = {
            Nombre:'',
            Descripcion:'',
            Direccion:'',
            PaginaWeb:'',
            Siglas:'',
            Telefono:''
        };
    }

    $scope.crearInstitucion = function () {
        if (angular.isObject($scope.institucion)) {
            scggApi.httpPost(url + 'crearInst', $scope.Institucion).then(
                function (response) {
                    if (response.data) {
                        UtilToastMessage.successGeneral("La institucion fue creada con exito.");
                        $scope.loadInstituciones();
                    }else {
                        UtilToastMessage.errorGeneral("No se pudo crear el registro. Intente de nuevo.");
                    }
                });   
        }
    };


    
}]);