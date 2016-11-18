


scggApp.controller('instController', ['$scope', 'scggFactory', 'scggApi', function($scope, scggFactory, scggApi){
    $scope.titulo = 'Crear Nueva Institucion';
    $scope.instituciones = [];
    $scope.institucion = {};
    $scope.rol = scggFactory.UserObejct.IdRol;
    $scope.logeado = scggFactory.logeado;
    $scope.crear = true;
    var url = "routes/DirectorioRoute.php?opcion=";

    $scope.loadInstituciones = function () {
        scggApi.httpGetSinParametros(url + 'listarInstituciones').then(
            function (response) {
                if (Object.keys(response.data).length >= 0) {
                    scggFactory.SetInstitucionesObject(response.data);
                    $scope.instituciones = scggFactory.GetInstituciones();
                }else {
                    UtilToastMessage.errorGeneral("Ocurrio  un error al cargar la informacion. Intente de nuevo.");
                }
               // $location.path("/inst");
            });
     };   

    $scope.getInstitucion = function (id) {
        $scope.titulo = 'Editar Institucion';
        $scope.crear = false;
        if (id != undefined) {
            scggApi.httpPost(url + 'getInstId', {'id': id}).then(
                function (response) {
                    if (Object.keys(response.data).length >= 0) {
                        $scope.institucion = response.data;/*.Id;
                        $scope.institucion.Nombre = response.data.Nombre;
                        $scope.institucion.Siglas = response.data.Siglas;
                        $scope.institucion.Estado = response.data.Estado;
                        $scope.institucion.PaginaWeb = response.data.PaginaWeb;
                        $scope.institucion.Direccion = response.data.Direccion;
                        $scope.institucion.Telefono = response.data.Telefono;
                        $scope.institucion.Descripcion = response.data.Descripcion;*/
                    }else {
                        UtilToastMessage.errorGeneral("Ocurrio un error al cargar la informacion, por favor intente de nuevo.");
                    }
                },
                function (response) {
                    UtilToastMessage.errorGeneral("Ocurrio un error al cargar la informacion, por favor intente de nuevo.");
                });
        };
    };

    $scope.crearInstitucion = function () {
        
        if ($scope.institucion.Nombre != undefined && $scope.institucion.Nombre != "") {
            scggApi.httpPost(url + 'crearInst', {'data':$scope.institucion}).then(
                function (response) {
                    if (response.data.trim() === "1") {
                        UtilToastMessage.successGeneral("La institucion fue creada con exito.");
                        $scope.loadInstituciones();
                    }else {
                        UtilToastMessage.errorGeneral("No se pudo crear el registro. Intente de nuevo.");
                    }
                });   
        }
    };

    $scope.editarIstitucion = function () {
        scggApi.httpPost(url + 'editInst', {'data': $scope.institucion}).then(
            function (response) {
                if (response.data.trim() === "1") {
                    UtilToastMessage.successGeneral('El registro fue modificado con exíto.');
                    $scope.loadInstituciones();
                }else {
                    UtilToastMessage.errorGeneral('Ocurrio un error al modificar el registro. Intente de nuevo.');
                }
            });
    };

    $scope.eliminarInstitucion = function (id) {
        var eliminar = confirm("Desea eliminar la institucion.");
        if (eliminar) {
            scggApi.httpPost(url + 'deleteInst', {'id': id}).then(
            function (response){
                if (response.data.trim() === "1") {
                    //$scope.institucion.remove(id);
                    $scope.loadInstituciones();
                }else {
                    UtilToastMessage.errorGeneral("No se pudo eliminar el registro.");
                }
            });
        }
        
    };

    $scope.SetObject = function () {
        if ($scope.institucion.Id == undefined) {
            $scope.crear = true;
            $scope.titulo = 'Crear Nueva Institucion';
            $scope.institucion = {
                Nombre:'',
                Descripcion:'',
                Direccion:'',
                PaginaWeb:'',
                Siglas:'',
                Telefono:''
            };
        }
    }
    
}]);