(function() {
	var app = angular.module('product_manager', ['ui.bootstrap']);
	var controllers = {};


	app.service('categoryService', function($http) {
		return {
			getNode: function(param) {
				return $http.get('/dashboard/category/node?parent=' + param);
			},
			getNavigation: function(param) {
				return $http.get('/dashboard/category/navigation?category=' + param);
			}
		}
	});

	app.service('productService', function($http) {
		return {
			getAll: function(query, filter) {
				return $http.get('/dashboard/product/show?query=' + query + '&filter=' + filter);
			}
		}
	});


	app.service('thumbnailService', function($http) {
		return {
			getThumbnail: function(id) {
				return $http.get('/dashboard/image/thumbnail?id=' + id);
			},
			deleteThumbnail: function(id) {
				return $http.post('/dashboard/image/delete?id=' + id);
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



	controllers.showCtrl = function($scope, $http, productService, $window) {
		var start = false;
		var old;
		$scope.maxSize = 5;
  		$scope.bigCurrentPage = 1;
  		$scope.numPerPage = 20;
  		$scope.items = [];
  		$scope.select = '1';
  		$scope.options = {'1' : 'Name', '2' : 'Category'};

  		$scope.newTab = function(id) {
            $window.open('/dashboard/category/edit/' + id, '_blank');
  		};

  		$scope.choose = function(id) {
  			$scope.select = id;
  			$scope.manualSearch();
  		};

		$scope.$watch('query',function() {
			if (typeof $scope.query === 'undefined' ||
				old === $scope.query) {
				return;
			} else if($scope.query === '') {
				old = '';
				$scope.getProduct();
			} else {
				old = $scope.query;
				$scope.manualSearch();
			}
			
		});

  		$scope.getProduct = function() {
  			productService.getAll().success(function(data) {
  				$scope.products = data;
  				$scope.bigTotalItems = data.length;
  				pageResult();
  				start = true;
  			});
  		};

  		$scope.manualSearch = function() {
			productService.getAll($scope.query, $scope.select).success(function(data) {
				$scope.products = data;
				$scope.bigTotalItems = data.length;
  				pageResult();
  				start = true;
			});
		};

  		$scope.$watch('bigCurrentPage', function() {
  			if(start) pageResult();
  		});

  		$scope.extra = function(check) {
  			if(check == 1) return { 'fa fa-fw fa-check' : check == 1};
  			else return {'fa fa-fw fa-times': check == 0};
  		}


  		function pageResult() {
  			var begin = (($scope.bigCurrentPage - 1) * $scope.numPerPage);
  			var end = begin + $scope.numPerPage;
  			$scope.items = $scope.products.slice(begin, end);
  		}

  		$scope.getProduct();
		
	}

	controllers.FormCtrl = function($scope, $modal, $log, categoryService, shareService, thumbnailService) {
		$scope.ready = false;

		var property = $('input[name=property]');
  		property.keyup(function() {
  			togglebutton();
  		});

		$scope.$watch('product_id', function() {
			thumbnailService.getThumbnail($scope.product_id).success(function(data) {
				$scope.thumbnails = data;
			});
		});

		$scope.$on('valuesUpdated', function() {
		    $scope.select = shareService.shareValue;
		    $scope.catName = shareService.nameValue;
		});

		$scope.start = function(id,name,product_id) {
			$scope.select = id;
			$scope.catName = name;
			$scope.product_id = product_id;
			var temp = [];
			temp[0] = id;
			temp[1] = name;
			shareService.updateshareValue(temp);
			$scope.refresh($scope.product_id);
			togglebutton();
		}
		

		$scope.refresh = function(id) {
			thumbnailService.getThumbnail(id).success(function(data) {
				$scope.images = data.slice(0);
				$scope.oldimages = data.slice(0);
			});
		}

		$scope.delete = function(id) {
			var index = -1;
			for(var i =0;i<$scope.images.length;i++) {
				var obj = $scope.images[i];
				if(obj.id == id) index = i;
			}
			if(i>-1) $scope.images.splice(index, 1);
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

		};

		$scope.addImage = function(size) {
			var modalInstance = $modal.open({
				templateUrl: 'image.html',
				controller: 'ImageCtrl',
				size: size,
				resolve: {
					images: function() {
						return $scope.images;
					}
				}
			});

			modalInstance.result.then(function(items) {
				$scope.images = items;
			});
		}

		function togglebutton() {
			var add = $('#addImage');
  			if(property.val()==='') {
  				add.attr('disabled','disabled');
  			}else {
  				add.removeAttr('disabled');
  			}
		}

		$scope.ready = true;
	}

	controllers.ImageCtrl = function($scope, $modalInstance,shareService, images) {
		$scope.images = images;
		$scope.error = '';
		$scope.progress = 0;

		$scope.submit = function() {
			var form = document.querySelector("#imageForm");
        	var request = new XMLHttpRequest();

        	/*request.upload.addEventListener('progress', function(e) {
        		$scope.progress = e.loaded/e.total*100;
        	}, false);*/

        	request.addEventListener('load', function(e) {
        		var packet = JSON.parse(e.target.responseText);
        		var state = packet.success;
        		if(state) {
        			var id = packet.id;
        			var path = packet.path;
        			var thumbnail_path = packet.thumbnail_path;
        			$scope.ok(id,path,thumbnail_path);
        		}else {
        			$scope.error = packet.message;
        		}
        	}, false);

	        form.addEventListener("submit", function(e) {
	          e.preventDefault();
	          var formdata = new FormData(form);
	          request.open('post','/dashboard/image/upload');
	          request.send(formdata);
	        },false);
		}

		$scope.ok = function(id,path,thumbnail_path) {
			var name = $('input[name="propname"]').val();
			$scope.images.push({"id": id, "name": name, "path": path, "thumbnail_path": thumbnail_path});
			$modalInstance.close($scope.images);
		};

		$scope.cancel = function() {
			$modalInstance.dismiss('cancel');
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