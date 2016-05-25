(function() {
	var app = angular.module('home', ['ui.bootstrap','ngAnimate']);
	var controllers = {};

	app.service('optionService', function($http) {
		return {
			getProduct: function() {
				return $http.get('option');
			}
		}
	});

	app.service('elementService', function($http) {
		return {
			getElement: function(id) {
				return $http.get('element?category=' + id);
			}
		}
	});

	app.service('thumbnailService', function($http) {
		return {
			getThumbnail: function(id) {
				return $http.get('/thumbnail?id=' + id);
			}
		}
	});

	app.service('searchService', function($http) {
		return {
			getSearch: function(query) {
				return $http.get('/search?query=' + query);
			}
		}
	});

	controllers.OptionCtrl = function($scope, $http, optionService, $modal) {

		var expr1 = { feature : '1'};
  		var expr2 = { promotion : '1' };

		$scope.chooseProduct = function(type) {
			$scope.select = type;
			if(type == 'feature') $scope.scan = expr1;
			else $scope.scan = expr2;
		};

		$scope.highlight = function(product) {
			return {'highlight': product.state, 'neutral': !product.state };
		};

		$scope.open = function(element) {
			var modalInstance = $modal.open({
				templateUrl: 'modal.html',
				controller: 'ModalCtrl',
				resolve: {
					product: function() {
						return element;
					}
				}
			});
		};

		$scope.init = function() {
			$scope.select = 'feature';
			optionService.getProduct().success(function(data) {
				$scope.products = data;
			});
			$scope.scan = expr1;
		}
	}


	controllers.ElementCtrl = function($scope, $http, elementService, searchService,$modal, $log) {
		var old;
		var start = false;
		$scope.elements = {};
		$scope.templates =
    			[ { name: 'category', url: '/partial/category.html'},
      			  { name: 'product', url: '/partial/product.html'} ];

      	$scope.maxSize = 5;
  		$scope.bigCurrentPage = [1,1];
  		$scope.numPerPage = 9;
  		$scope.items = [];
  		$scope.bigTotalItems = [];

		$scope.init = function(select, cat_id) {
			if(select == 'Home') select = 'All';
			$scope.select = select;
			$scope.cat_id = cat_id;
			$scope.getElement(cat_id);
		}

		$scope.getElement = function(cat_id) {
			elementService.getElement(cat_id).success(function(data) {
				$scope.elements[0] = data[0];
				$scope.elements[1] = data[1];
				$scope.parents = data[2];

				var check = true;
				$scope.enable = [false,false];
				for(var i = 0;i<2;i++) {
					if(check && $scope.elements[i].length > 0) {
						$scope.selection = i;
						check = false;
					}
					if($scope.elements[i].length != 0) {
						$scope.enable[i] = true;
					}
				}
				if($scope.selection == 0) $scope.bigTotalItems[0] = $scope.elements[0].length;
				else $scope.bigTotalItems[1] = $scope.elements[1].length;
				pageResult();
				start = true;
			});
		}

		$scope.changeScope = function(scope) {
			$scope.selection = scope;
		}

		$scope.open = function(element) {
			var modalInstance = $modal.open({
				templateUrl: 'modal.html',
				controller: 'ModalCtrl',
				resolve: {
					product: function() {
						return element;
					}
				}
			});
		};

		$scope.$watch('bigCurrentPage[0]', function() {
  			if(start) pageResult();
  		});

  		$scope.$watch('bigCurrentPage[1]', function() {
  			if(start) pageResult();
  		});

  		$scope.$watch('query',function() {
			if (typeof $scope.query === 'undefined' ||
				old === $scope.query) {
				return;
			} else if($scope.query === '') {
				old = '';
				$scope.getElement($scope.cat_id);
			} else {
				old = $scope.query;
				$scope.manualSearch();
			}	
		});

		function pageResult() {
  			var begin;
  			if($scope.selection == 0) begin = (($scope.bigCurrentPage[0] - 1) * $scope.numPerPage);
  			else begin = (($scope.bigCurrentPage[1] - 1) * $scope.numPerPage);
  			
  			var end = begin + $scope.numPerPage;

  			if($scope.selection == 0) $scope.items = $scope.elements[0].slice(begin, end);
  			else $scope.items = $scope.elements[1].slice(begin,end);
  		}

  		$scope.manualSearch = function() {
  			searchService.getSearch($scope.query).success(function(data) {
				$scope.elements[0] = data[0];
				$scope.elements[1] = data[1];
				var check = true;
				$scope.enable = [false,false];

				for(var i = 0;i<2;i++) {
					if(check && $scope.elements[i].length > 0) {
						$scope.selection = i;
						check = false;
					}
					if($scope.elements[i].length != 0) {
						$scope.enable[i] = true;
					}
				}
				if($scope.selection == 0) $scope.bigTotalItems[0] = $scope.elements[0].length;
				else $scope.bigTotalItems[1] = $scope.elements[1].length;
				pageResult();
				start = true;
			});
  		}

	}

	controllers.ModalCtrl = function($scope, $modalInstance, product, thumbnailService, $window) {
		$scope.product = product;

		$scope.start = function() {
			thumbnailService.getThumbnail(product.id).success(function(data) {
				$scope.thumbnails = data;
			});
		};

		$scope.ok = function() {
			$modalInstance.close();
		};

		$scope.cancel = function() {
			$modalInstance.dismiss('cancel');
		};

		$scope.newTab = function(url) {
			$window.open(url);
		}

		$scope.start();
	};

	app.controller(controllers);
})();
