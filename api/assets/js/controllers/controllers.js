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

.controller('HomeController', ['$scope','RouteFactory', 'store', 'jwtHelper', '$state','CommerceFactory',function($scope, RouteFactory, store, jwtHelper,$state,CommerceFactory){
	

	$scope.getRoutes = function(){
		var token = store.get('token');
		var tokenDecodificado = jwtHelper.decodeToken(token);
		var userId = tokenDecodificado.id;

		RouteFactory.getRoutes(userId);
	}

	$scope.logout = function(){
		store.remove('token');
		$state.reload();
	}

	$scope.getAllCommerce = function(){
		$scope.allCommerce = CommerceFactory.getAllCommerce();
	}

	$scope.getAllProductBycommerce = function(){
		var commerceId = 1; //TODO: hardcoded
		$scope.allProductByCommerce = CommerceFactory.getAllProductBycommerce(commerceId);
	}

	$scope.stockSave = function(){		

		var object = {//TODO: hardcoded
			commerceId : 1,
			productId : 6,
			stock : 25,
		}

		CommerceFactory.stockSave(object);
	}

	$scope.orderSave = function(){
		var object = {//TODO: hardcoded
			commerceId : 1,
			productId : 6,
			quantity : 100,
		}
		CommerceFactory.orderSave(object);
	}


}])