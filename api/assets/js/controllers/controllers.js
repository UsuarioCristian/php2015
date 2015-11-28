'use strict';

angular.module("app.controllers",[
'angular-storage',
'angular-jwt'
])
.controller("LoginController", ['$scope', 'LoginFactory', '$state', 'store',function($scope, LoginFactory, $state, store){
	$scope.user = {};
	$scope.signin = function(){
		LoginFactory.login($scope.user).then(
				function(response){			
					$scope.user.password = ""; // Borrar la contraseña, ya que solo se necesita el token
					store.set('token', response.data);
					$state.go("home");
				},				
				function(response){
					//error messagge
					console.log(response.data);
				}
			)	
	
	}
	
}])

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