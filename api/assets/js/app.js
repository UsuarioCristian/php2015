'use strict';

angular.module('app', [
	'ui.router',
	'app.controllers',
	'app.services'

])

.config(['$urlRouterProvider', '$stateProvider',function($urlRouterProvider, $stateProvider) {
	
	$urlRouterProvider.otherwise('/');

	$stateProvider.state('home', {
		url: '/',
		templateUrl: 'views/home.html',
		controller: 'HomeController',
	})

}])