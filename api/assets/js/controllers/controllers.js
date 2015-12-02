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

.controller('HeaderController', ['$scope', 'LoginFactory', '$state', 'store', function($scope, LoginFactory, $state, store){

	$scope.mostrarHeader = function(){
		if($state.current.name ==='home' || $state.current.name ==='graficas' || $state.current.name ==='maps' || $state.current.name ==='stock')
			return true;
		else
			return false;
	}
	
	$scope.logout = function() {
		store.remove('token');
		$state.go('login');
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

	$scope.getCurrentRoute = function(){
		var token = store.get('token');
		var tokenDecodificado = jwtHelper.decodeToken(token);
		var userId = tokenDecodificado.id;

		RouteFactory.getCurrentRoute(userId);
	}


}])

.controller("GraficasController", ['$scope', 'CommerceFactory', '$state', 'store','ProductFactory','$timeout',function($scope, CommerceFactory, $state, store, ProductFactory,$timeout){
	
	$scope.allCommerce = CommerceFactory.getLoadCommerce();
	$scope.allProducts = ProductFactory.getAllProduct();	

	$scope.verificarProductos = function(){

		$scope.allCommerce = CommerceFactory.getLoadCommerce(); //Si se quiere obtener fuera de la funcion usar $timeout
		$scope.allProducts = ProductFactory.getAllProduct();
		for (var i = 0; i < $scope.allCommerce.length; i++) {
			console.log($scope.allCommerce[i].name);
			console.log($scope.allCommerce[i].products);

		};
	}

	$scope.cargarComercioProductos = function(){
		for (var i = 0; i < $scope.allCommerce.length; i++) {			

			for (var j = 0; j < $scope.allCommerce[i].products.length; j++) {
				CommerceFactory.getProductSold($scope.allCommerce[i].id, $scope.allCommerce[i].products[j].id);
			};
		};
	}

	/****************************************************************************************************************/
	/****************************************************************************************************************/
	/********************************************SECCION GRAFICAS****************************************************/
	/****************************************************************************************************************/
	/****************************************************************************************************************/
	$scope.commerceSelected = null;

	$scope.tiposGraficas = [];
	var graficaColumn = {
			nombre : 'Productos mas vendidos por comercio',
			id : 1
	}
	$scope.tiposGraficas.push(graficaColumn);
	
	var graficaPie = {
		nombre : 'Cantidad por producto vendido',
		id : 2
	}

	$scope.tiposGraficas.push(graficaPie);

	/*********************************************************************/
	/********************CARGA DE DATOS DEL COLUMN CHART******************/
	/*********************************************************************/
	/*********************************************************************/
	
	$scope.changeCommerce = function(){
		var series = [];
		for (var i = 0; i < $scope.commerceSelected.products.length; i++) {
			var dato = {
				name : $scope.commerceSelected.products[i].name,
				data : [],
			}
			dato.data.push(parseInt($scope.commerceSelected.products[i].sold));
			series.push(dato);			
		};

		var chartPie = null;
		var chartColumn = new Highcharts.Chart({
			chart: {
		            
		        type: 'column',
		        renderTo: 'container',
		    },
		    title: {
		        text: 'Resultado'
		    },
		    subtitle: {
		     text: 'Total productos: '+ $scope.commerceSelected.products.length,
		    },
		    xAxis: {
			    categories: ["Total"],
			    crosshair: true,
			    labels: {
	             enabled: false
	         }
			},
			yAxis: {
			    min: 0,
			    title: {
			        text: 'Vendidos'
			    }
			},
		    tooltip: {
		        pointFormat: '{series.name}: <b>{point.y}</b>'
		    },
		    plotOptions: {
		        column: {
		            pointPadding: 0.2,
		            borderWidth: 0
		        }
		    },
		    series: series
		});
		
	}

	/*********************************************************************/
	/********************CARGA DE DATOS DEL PIE CHART*********************/
	/*********************************************************************/
	/*********************************************************************/
	
	$scope.changeProduct = function(){
		var dataProduct = [];
		var totalVendidos = 0;
		
		for (var i = 0; i < $scope.allCommerce.length; i++) {
			for (var j = 0; j < $scope.allCommerce[i].products.length; j++) {
				if($scope.productSelected.id === $scope.allCommerce[i].products[j].id){
					var dato = {
						name : $scope.allCommerce[i].name,
						y : parseInt($scope.allCommerce[i].products[j].sold)
					};
					totalVendidos += dato.y;
					dataProduct.push(dato);
				}
			};
		};	
		
		var chartPie = new Highcharts.Chart({
		    chart: {
		        plotBackgroundColor: null,
		        plotBorderWidth: null,
		        plotShadow: false,
		        type: 'pie',
		        renderTo: 'container2',
		    },
		    title: {
		        text: 'Resultado'
		    },
		    subtitle: {
		     text: 'Total vendidos: '+ totalVendidos,
		    },
		    tooltip: {
		        pointFormat: '{series.name}: <b>{point.y}</b>'
		    },
		    plotOptions: {
		        pie: {
		            allowPointSelect: true,
		            cursor: 'pointer',
		            dataLabels: {
		                enabled: true,
		                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
		                style: {
		                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
		                }
		            }
		        }
		    },
		    series: [{
		        name: "Total",
		        colorByPoint: true,
		        data : dataProduct
		    }]
		})


	}


	$scope.changeChart = function(){
		

		if($scope.graficaSeleccionada.id == 1 && $scope.commerceSelected != null){
			$scope.changeCommerce();

		}else{
			if($scope.productSelected != null)
				$scope.changeProduct();
		}
	}

	
}])

.controller("MapsController", ['$scope', 'RouteFactory', '$state', 'store','CommerceFactory','jwtHelper',function($scope, RouteFactory, $state, store, CommerceFactory,jwtHelper){
	
	var token = store.get('token');
	var tokenDecodificado = jwtHelper.decodeToken(token);
	var userId = tokenDecodificado.id;
	var coord = {
		lat : tokenDecodificado.lat,
		long : tokenDecodificado.long
	}

	RouteFactory.loadCurrentRoute(userId);
	

	$scope.actualizarRecorrido = function(){
		var allRouteCommerce = RouteFactory.getCurrentRoute();		
		if(allRouteCommerce != null){
			
			var commerceOnTheRoute = [];
			var allCommerce = CommerceFactory.getLoadCommerce();
			if($scope.recorrido.tipo === 'recorridoCompleto'){				
				for (var i = 0; i < allCommerce.length; i++) {
					for (var j = 0; j < allRouteCommerce.length; j++) {
						if(allRouteCommerce[j].commerce_id === allCommerce[i].id){
							commerceOnTheRoute.push(allCommerce[i]);							
						}
					};
				};
			}else{				
				for (var i = 0; i < allCommerce.length; i++) {
					for (var j = 0; j < allRouteCommerce.length; j++) {
						if(allRouteCommerce[j].commerce_id === allCommerce[i].id && allCommerce[i].priority ==1){
							commerceOnTheRoute.push(allCommerce[i]);							
						}
					};
				};
			}
			var comerciosOrd = [];
			setRecorridoFinal(comerciosOrd, commerceOnTheRoute, coord.lat, coord.long);
			console.log(comerciosOrd);


		}
		
	}

	var setRecorridoFinal = function(comerciosOrd, commerceOnTheRoute, lat, long){
		console.log('Entro');
		if(commerceOnTheRoute.length != 0){
			var comercio = commerceOnTheRoute[0];
			var p1 = {
				lat: lat,
				lng: long
			}			
			
			for (var i = 1; i < commerceOnTheRoute.length; i++) {
				var p2 = {
					lat: comercio.lat,
					lng: comercio.long
				}				
				var p3 = {
					lat : commerceOnTheRoute[i].lat,
					lng : commerceOnTheRoute[i].long
				}
				var min = getDistance(p1,p2);
				var nuevaDistancia = getDistance(p1, p3);
				if(min > nuevaDistancia){
					comercio = commerceOnTheRoute[i];
				}
			};

			comerciosOrd.push(comercio);

			var index = commerceOnTheRoute.indexOf(comercio);
			if (index > -1) {
			    commerceOnTheRoute.splice(index, 1);
			}
			
			setRecorridoFinal(comerciosOrd,commerceOnTheRoute, comercio.lat, comercio.long)

		}
	}


	var rad = function(x) {
	  return x * Math.PI / 180;
	};

	var getDistance = function(p1, p2) {
	  var R = 6378137; // Earth’s mean radius in meter
	  var dLat = rad(p2.lat - p1.lat);
	  var dLong = rad(p2.lng - p1.lng);
	  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
	    Math.cos(rad(p1.lat)) * Math.cos(rad(p2.lat)) *
	    Math.sin(dLong / 2) * Math.sin(dLong / 2);
	  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
	  var d = R * c;
	  return d; // returns the distance in meter
	};
	
}])


.controller('StockController', ['$scope', 'CommerceFactory', '$state', 'store','$timeout', function($scope, CommerceFactory, $state, store,$timeout){

	$scope.allCommerce = CommerceFactory.getLoadCommerce();
	if($scope.allCommerce == null){
		$timeout(function(){},1500).then(
			function(){
				$scope.allCommerce = CommerceFactory.getLoadCommerce();
			}),
			function(){} 
	}

	$scope.changeCommerce = function(){
		console.log($scope.commerceSelected);
	}

	$scope.saveStock = function(){
		var object = {
			commerceId : $scope.commerceSelected.id,
			productId : $scope.productSelected.id,
			stock : $scope.cantidadStock
		}
		CommerceFactory.stockSave(object);
	}
	
}])