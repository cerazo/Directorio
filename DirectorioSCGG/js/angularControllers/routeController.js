/**
 * Created by Josue Erazo on 23/09/2016.
 */
/// <reference path="../js/jquery-2.2.3.intellisense.js" />



var scggApp = angular.module('scggApp',['ngRoute']);



    scggApp.config(function ($routeProvider, $locationProvider) {
        $routeProvider
            .when('/',{
                templateUrl: 'views/Home/Index.html',
                controller: 'indexController'
            })
            .when('/Instituciones',{
                templateUrl:'views/Instituciones/Instituciones.html',
                controller: 'instController'
            })
            .when('/cargos',{
                templateUrl:'views/Home/Cargos.html',
                controller: 'cargosController'
            })
            .when('/Home',{
                templateUrl: 'views/Home/Home.html',
                controller: 'homeController'
                //resolve: resolveController('inicioController.js')
            });
            $locationProvider.html5Mode(false);

    });

