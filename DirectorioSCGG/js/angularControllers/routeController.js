/**
 * Created by Josue Erazo on 23/09/2016.
 */
/// <reference path="../js/jquery-2.2.3.intellisense.js" />



var scggApp = angular.module('scggApp',['ngRoute']);

scggApp.config(function ($routeProvider) {
    $routeProvider
        .when('/',{
            templateUrl: 'views/Home/Index.html',
            controller: 'indexController'
        })
        .when('/inst',{
            templateUrl:'views/Instituciones/Instituciones.html',
            controller: 'instController'
        })
        .when('/addinstitucion',{
            templateUrl:'views/Instituciones/AddInstitucion.html',
            controller: 'addinstController'
        })
        .when('/cargos',{
            templateUrl:'views/Home/Cargos.html',
            controller: 'cargosController'
        })
        .when('/home',{
            templateUrl: 'views/Home/Home.html',
            controller: 'homeController'
            //resolve: resolveController('inicioController.js')
        })
        .when('/Instituciones', {
            templateUrl: 'views/Instituciones/Instituciones.html'
            //controller: 'loginController'
        });

});





scggApp.controller('addinstController' ,['$scope', function($scope){
    $scope.mensaje = 'Agregar Instituciones';
}]);

scggApp.controller('cargosController' ,['$scope', function($scope){
    $scope.mensaje = 'Cargos de las instituciones';
}]);

scggApp.controller('loginController', ['$scope', function($scope){
    $scope.mensaje = "Estas en Login"
}])

scggApp.controller('logoutController', ['$scope', function($scope){
  $scope.mensaje = 'Estas deslogueado del sistema';
}]);

scggApp.controller('indexController', ['$scope', function($scope){
    $scope.mensaje = "Bienvenido al Directorio Digital";
}]);
