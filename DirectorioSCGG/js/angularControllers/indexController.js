scggApp.controller('indexController',[ "$scope", "$http", "$location", "scggApi", "scggFactory",  function($scope, $http, $location, scggApi, scggFactory){
	
	$scope.mensaje = "Bienvenido al Directorio Digital";
	$scope.logeado = scggFactory.logeado;
	$scope.rol;
	var url = "routes/DirectorioRoute.php?opcion=";
	//$scope.opcion = '';

	$scope.home = function () {
    	$scope.logeado = scggFactory.logeado;
    	$scope.rol = scggFactory.rol;
    	if ($scope.logeado) {
            $location.path('/Home');
        }else {
            $location.path('/');
        }
    };

    $scope.iniciarSesion = function(correo, password) {

		if (correo != undefined && password != undefined) {

			scggApi.httpPost(url + "login", {'correo': correo, 'password': password}).then(
				function (response) {
					if (angular.isObject(response.data)) {
						scggFactory.SetUserObject(response.data);
						$location.path("/Home");
						mannageDom.changeImg("Image/logout1.png", "login");
										
						//$scope.logeado = true;
						scggFactory.logeado = true;
						$scope.logeado = scggFactory.logeado;
						$scope.rol = scggFactory.rol;

					}else {
						UtilToastMessage.errorLogin("Correo o Contraseña invalidos, intente de nuevo");
					}
				}, 
				function (response) {
					if (response.status === "404") {
						UtilToastMessage.errorLogin("Ocurrio un error al iniciar sesion");
					}
				}
			);
		}else{
			UtilToastMessage.warningGeneral("Por favor llene los campos nesesarios.");
		}
	};

	$scope.cerrarSesion = function(){
		$("#txtPassword").val("");
		scggFactory.SetUserObject(new Object());
		scggFactory.logeado  = false;
		$scope.logeado = scggFactory.logeado;
		$location.path("/");
		mannageDom.changeImg("Image/user.png", "logout");
	};

	$scope.resetPassword = function (correo, pass1, pass2) {
		if (correo !== "" && correo !== undefined)
		{
			if (pass1 === pass2) 
			{
				$http.post(url, {'correo':correo, 'pass1': pass1, 'pass2': pass2})
				.then(
					function (response) {
						$scope.usuario = response.data;
						if (angular.isObject($scope.usuario)){
							$http.post(url + "resetPass", {'pass1': pass1}).then(
								function (response) {
									if (response.data === "Ok") {
										UtilToastMessage.successGeneral("La contraseña a sido reestablecida. Favor Revisar su correo.");
									}			
								}, function (response) {
										UtilToastMessage.errorGeneral("La contraseña no pudo ser actualizada. Intente de nuevo.");
								});
						}else {
							UtilToastMessage.errorGeneral("El correo ingresado no existe. Verifique sus datos.");
						}
					},
					function (response) {
						if (response.status = "404") {
							UtilToastMessage.errorGeneral("Ocurrio un error al procesar la informacion.");
						}
					}
				);
			}else {
				UtilToastMessage.warningGeneral("Las contraseñas no coinciden. Intente de nuevo.");
			}
		}	
	};
}]);

/*scggApp.controller('indexController', ['$scope', 'scggFactory', '$location', function($scope, scggFactory, $location){

    $scope.logeado;
    $scope.rol;

    
}]);*/


    scggApp.filter('array', function() {
      return function(items) {
        var filtered = [];
        angular.forEach(items, function(item) {
          filtered.push(item);
        });
       return filtered;
      };
    });


    scggApp.filter('toArray', function () {
      return function (obj, addKey) {
        if (!angular.isObject(obj)) return obj;
        if ( addKey === false ) {
          return Object.keys(obj).map(function(key) {
            return obj[key];
          });
        } else {
          return Object.keys(obj).map(function (key) {
            var value = obj[key];
            return angular.isObject(value) ?
              Object.defineProperty(value, '$key', { enumerable: false, value: key}) :
              { $key: key, $value: value };
          });
        }
      };
    });
