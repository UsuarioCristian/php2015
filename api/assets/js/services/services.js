'use strict';

// Demonstrate how to register services
// In this case it is a simple value service.
angular.module('app.services', []).
value('version', '0.1')

.factory('ApiEndpointFactory', ['$http','$location', function($http, $location) {
	
	var ApiEndpoint = $location.protocol() + "://" + $location.host() + ":" + $location.port();
	
	return{
		ApiEndpoint : ApiEndpoint
	}	
	
}])

.factory('CountryFactory', ['$http','ApiEndpointFactory', function($http, ApiEndpointFactory) {
	var countries = [];
	return{
		getAllCountries:function(){
			
			$http.get(ApiEndpointFactory.ApiEndpoint +'/php2015/backend/web/resource/add')
			.then(function(response){
				console.log(response);
				console.log('Ejecutado')
			}, function(response){
				/*error*/
			});
		},

		getCountries:function(){
			return countries;
		},

		crearPais:function(){

			var employee = {
				code: 'MX',
				name: 'Mexico',
				enable: 'true',
				password: 'pass',
			}


			$http.post(ApiEndpointFactory.ApiEndpoint +'/php2015/backend/web/resource/login', employee)
			.then(function(response){
				console.log(response);
				console.log('Ejecutado')
			}, function(response){
				/*error*/
			});
		},
	}
	
}])

.factory('LoginFactory', ['$http','ApiEndpointFactory', function($http, ApiEndpointFactory) {
	return{
		login:function(user){
			//Asi funciona la encriptacion:
			/*var objHashResult=CryptoJS.SHA256(user.password)
			var strHashResult=objHashResult.toString(CryptoJS.enc.Hex);
			console.log(strHashResult);*/
			var usuario = {
				password : CryptoJS.SHA256(user.password).toString(CryptoJS.enc.Hex),
				name : user.username
			}
			
			return $http.post(ApiEndpointFactory.ApiEndpoint +'/php2015/backend/web/resource/login', usuario)
		}
	}
}])

.factory('RouteFactory', ['$http','ApiEndpointFactory', function($http, ApiEndpointFactory) {
	return{
		getRoutes:function(userId){
			var object = {
				id : userId
			}
			$http.post(ApiEndpointFactory.ApiEndpoint +'/php2015/backend/web/resource/routesbyemployee', object)
			.then(function(response){
				console.log(response);
				
			}, function(response){
				/*error*/
			});
		}
	}
}])

.factory('CommerceFactory', ['$http','ApiEndpointFactory', function($http, ApiEndpointFactory) {
	return{
		getAllCommerce:function(){
			
			$http.post(ApiEndpointFactory.ApiEndpoint +'/php2015/backend/web/resource/allcommerce')
			.then(function(response){
				console.log(response);
				return response.data;
			}, function(response){
				return null;
			});
		},

		getAllProductBycommerce:function(commerceId){

			var object = {
				id : commerceId
			}
			$http.post(ApiEndpointFactory.ApiEndpoint +'/php2015/backend/web/resource/allproductbycommerce', object)
			.then(function(response){
				console.log(response);
				return response.data;
			}, function(response){
				return null;
			});
		},

		stockSave : function(object){
			$http.post(ApiEndpointFactory.ApiEndpoint +'/php2015/backend/web/resource/stocksave', object)
			.then(function(response){
				console.log(response);
				
			}, function(response){
				console.log(response);
			});
		},

		orderSave : function(object){
			$http.post(ApiEndpointFactory.ApiEndpoint +'/php2015/backend/web/resource/ordersave', object)
			.then(function(response){
				console.log(response);
				
			}, function(response){
				console.log(response);
			});
		}
	}
}])