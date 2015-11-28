'use strict';

angular.module('app.controllers', [])

.controller('HomeController', ['$scope','CountryFactory', function($scope, CountryFactory){
	$scope.paisSeleccionado = [];
	CountryFactory.getAllCountries();
	$scope.mostrarPaises = function(){
		CountryFactory.getAllCountries();
		var countries = CountryFactory.getCountries();
		$scope.paisSeleccionado = countries[0];

	}

	$scope.crearPais = function(){
		CountryFactory.crearPais();
	}


}])