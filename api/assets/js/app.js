'use strict';

angular.module('app', [
	'ui.router',
	'app.controllers',
	'app.services',
	'angular-storage',
	'angular-jwt',
])

.config(['$urlRouterProvider', '$stateProvider','jwtInterceptorProvider','$httpProvider',function($urlRouterProvider, $stateProvider, jwtInterceptorProvider,$httpProvider) {
	
	$urlRouterProvider.otherwise('/');

	$stateProvider.state('login', {
		url: '/login',
		templateUrl: 'views/login.html',
		controller: 'LoginController'
	})

	$stateProvider.state('home', {
		url: '/',
		templateUrl: 'views/home.html',
		controller: 'HomeController',
		data:{requiresLogin:true}
	})

	jwtInterceptorProvider.tokenGetter = function(store){
		return store.get('tokenConsultora');
	};
	
	$httpProvider.interceptors.push('jwtInterceptor');

}])

.run(['$rootScope','jwtHelper', 'store', '$state', function($rootScope, jwtHelper, store, $state){
	$rootScope.$on("$stateChangeStart", function (event, next, current) {
		if (next.data && next.data.requiresLogin) {
			if(!store.get('token')){
				event.preventDefault();
					$state.go('login');
			}else{
				if(jwtHelper.isTokenExpired(store.get('token'))){
					event.preventDefault();
					$state.go('login');
				}
			}
		}
	});
}])