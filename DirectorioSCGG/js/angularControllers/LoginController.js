/// <reference path="js/public/jquery-2.2.3.intellisense.js" />
/// <reference path=" routeController.js" />
/// <reference path="Utilities/UtilToastMessaje.js" />
/// <reference path="Utilities/manageDOM.js" />

scggApp.controller('loginController',[ "$scope", "$http", "$location", "scggApi", "scggFactory",  function($scope, $http, $location, scggApi, scggFactory){
	
	
	$scope.logeado = scggFactory.logeado;
	var url = "routes/DirectorioRoute.php?opcion=";
	//$scope.opcion = '';
	$scope.iniciarSesion = function(correo, password) {

		if (correo != undefined && password != undefined) {

			scggApi.httpPost(url + "login", {'correo': correo, 'password': password}).then(
				function (response) {
					if (angular.isObject(response.data)) {
						scggFactory.SetUserObject(response.data);
						$location.path("/home");
						mannageDom.changeImg("Image/logout1.png", "login");
										
						//$scope.logeado = true;
						scggFactory.logeado = true;
						$scope.logeado = scggFactory.logeado;

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
		scggFactory.SetUserObject(null);
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

/*http.post(url,{'opcion': 'login', 'correo': correo, 'password': password}).then(
				function (response) {
					if (angular.isObject(response.data) && response.data != null) {
						//$scope.usuario = response.data;	
						//$scope.usuario;
						scggApi.setUser(response.data);
						//$scope.usuario = scggApi.getUserObj();
						if (scggApi.userObj) {
							//if (scggApi.userObj.IdRol === '1') {
								console.log("Administrador");
								//$window.location.href = '#home';
								$location.path("/home");
								mannageDom.changeImg("Image/logout1.png", "login");
								//mannageDOM.ChangeImg("../../Image/logout1.png", "login");
								UtilToastMessage.successGeneral("Bienbenido " + $scope.usuario.NombreUsuario + " " + $scope.usuario.ApellidoUsuario);
								$scope.logeado = true;
							//}	
						}
					}else {
						UtilToastMessage.errorLogin("Correo o Contraseña invalidos, intente de nuevo");
					}
					$("#txtCorreo").val("");
					//$("#txtPass").val("");
				},function (response) {
					UtilToastMessage.errorLogin("Ocurrio un error al iniciar sesion");
				}
			);*/