(function() {
	var app = angular.module('category_manager',['ui.bootstrap']);
	var controllers = {};

	app.service('categoryService', function($http) {
		return {
			getAll: function(query, filter) {
				return $http.get('/dashboard/category/show?query=' + query + '&filter=' + filter);
			},
			getNode: function(param) {
				return $http.get('/dashboard/category/node?parent=' + param);
			},
			getNavigation: function(param) {
				return $http.get('/dashboard/category/navigation?category=' + param);
			}
		}
	});


	app.service('shareService', function($rootScope) {
		var service = {};

		service.updateshareValue = function(value) {
			this.shareValue = value[0];
			this.nameValue = value[1];
			$rootScope.$broadcast("valuesUpdated");
		}
		return service;
	});


	controllers.showCtrl = function($scope, $http, categoryService, $window) {
		var start = false;
		var old;
		$scope.maxSize = 5;
  		$scope.bigCurrentPage = 1;
  		$scope.numPerPage = 20;
  		$scope.items = [];
		$scope.select = '1';
		$scope.options = {'1' : 'Name', '2' : 'Parent'};
		
		$scope.newTab = function(id) {
            $window.open('/dashboard/category/edit/' + id, '_blank');
  		};

		$scope.choose = function(id) {
  			$scope.select = id;
  			$scope.manualSearch();
  		};

		$scope.getCategory = function() {
			categoryService.getAll().success(function(data) {
				$scope.categories = data;
				$scope.bigTotalItems = data.length;
				pageResult();
  				start = true;
			});
		};

		$scope.manualSearch = function() {
			categoryService.getAll($scope.query, $scope.select).success(function(data) {
				$scope.categories = data;
				$scope.bigTotalItems = data.length;
  				pageResult();
  				start = true;
			});
		};

		$scope.$watch('query',function() {
			if (typeof $scope.query === 'undefined' ||
				old === $scope.query) {
				return;
			} else if($scope.query === '') {
				old = '';
				$scope.categories = $scope.getCategory();
			} else {
				old = $scope.query;
				$scope.manualSearch();
			}	
		});

		$scope.$watch('bigCurrentPage', function() {
  			if(start) pageResult();
  		});

		function pageResult() {
  			var begin = (($scope.bigCurrentPage - 1) * $scope.numPerPage);
  			var end = begin + $scope.numPerPage;
  			$scope.items = $scope.categories.slice(begin, end);
  		}

		$scope.getCategory();
	}

	controllers.FormCtrl = function($scope, $modal, $log, categoryService, shareService) {

		$scope.$on('valuesUpdated', function() {
		    $scope.select = shareService.shareValue;
		    $scope.catName = shareService.nameValue;
		});

		$scope.start = function(id,name) {
			$scope.select = id;
			$scope.catName = name;
			var temp = [];
			temp[0] = id;
			temp[1] = name;
			shareService.updateshareValue(temp);
		}

		$scope.open = function(size) {
			var modalInstance = $modal.open({
				templateUrl: 'modal.html',
				controller: 'ModalCtrl',
				size: size,
				resolve: {
					cat_id: function() {
						return 1;
					}
				}
			});

			/*modalInstance.result.then(function() {

			}, function() {
			
			});*/

		};
	}

	// Select Category
	controllers.ModalCtrl = function($scope, $modalInstance, categoryService, cat_id, shareService) {
		$scope.cat_id = cat_id;
		$scope.use = []; // temp data when click item
		$scope.store = []; // final data already select

		$scope.activeNode = function(id) {
			return { 'highlight': id === $scope.store[0] };
		};

		$scope.traverse = function(parent) {
			$scope.getNavigation(parent);
			$scope.getCategory(parent);
		};

		$scope.choose = function(id,name) {
			$scope.store[0] = id;
			$scope.store[1] = name;
		};

		$scope.ok = function() {
			for(var i = 0;i < $scope.use.length;i++) {
				$scope.use[i] = $scope.store[i];
			}
			shareService.updateshareValue($scope.use);
			$modalInstance.close();
		};

		$scope.cancel = function() {
			$modalInstance.dismiss('cancel');
		};

		$scope.getCategory = function(parent) {
			categoryService.getNode(parent).success(function(data) {
				$scope.items = data;
			});
		};

		$scope.getNavigation = function(parent) {
			categoryService.getNavigation(parent).success(function(data) {
				$scope.navigators = data;
			});
		};

		$scope.getNode = function(id) {
			categoryService.getNode(id).success(function(data) {
				$scope.items = data;
			});
		};

		$scope.init = function() {
			for(var i = 0;i < 2;i++) {
				var msg = '';
				if(i==0) msg = cat_id;
				else msg = 'Home';
				
				$scope.use[i] = msg;
				$scope.store[i] = msg;
			}
			$scope.getNavigation($scope.cat_id);
			$scope.getNode($scope.cat_id);	
		};

		$scope.init();
	};

	app.controller(controllers);

})();