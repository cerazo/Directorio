

//var scggApp = angular.module('scggApp',['ngRoute']);

scggApp.service('scggApi', ["$http", "scggFactory", function ($http, scggFactory) {
	//var userObj = {}
	var appi = {};

	appi.httpPost = function (url,obj) {
		return $http.post(url, obj);
	};

	appi.httpGetSinParametros = function (url) {
		return $http.get(url);
	}

	return appi;

}]);