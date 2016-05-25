(function() {
	var app = angular.module('gallery_manager', ['angularFileUpload','ui.bootstrap']);
	var controllers = {};

	app.service('galleryService', function($http) {
		return {
			getAll: function(query) {
				return $http.get('/dashboard/gallery/show?query=' + query);
			},
			delSelect: function(id) {
				return $http.post('/dashboard/gallery/delete?id=' + id);
			}
		}
	});

	app.directive('ngThumb', ['$window', function($window) {
        var helper = {
            support: !!($window.FileReader && $window.CanvasRenderingContext2D),
            isFile: function(item) {
                return angular.isObject(item) && item instanceof $window.File;
            },
            isImage: function(file) {
                var type =  '|' + file.type.slice(file.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        };

        return {
            restrict: 'A',
            template: '<canvas/>',
            link: function(scope, element, attributes) {
                if (!helper.support) return;

                var params = scope.$eval(attributes.ngThumb);

                if (!helper.isFile(params.file)) return;
                if (!helper.isImage(params.file)) return;

                var canvas = element.find('canvas');
                var reader = new FileReader();

                reader.onload = onLoadFile;
                reader.readAsDataURL(params.file);

                function onLoadFile(event) {
                    var img = new Image();
                    img.onload = onLoadImage;
                    img.src = event.target.result;
                }

                function onLoadImage() {
                    var width = params.width || this.width / this.height * params.height;
                    var height = params.height || this.height / this.width * params.width;
                    canvas.attr({ width: width, height: height });
                    canvas[0].getContext('2d').drawImage(this, 0, 0, width, height);
                }
            }
        };
    }]);
	controllers.galleryCtrl = function($scope, FileUploader) {
		var uploader = $scope.uploader = new FileUploader({
            url: '/dashboard/gallery/create',
            removeAfterUpload: true
        });

        // FILTERS

        uploader.filters.push({
            name: 'imageFilter',
            fn: function(item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });

        // CALLBACKS

        uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
            console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploader.onAfterAddingFile = function(fileItem) {
            console.info('onAfterAddingFile', fileItem);
        };
        uploader.onAfterAddingAll = function(addedFileItems) {
            console.info('onAfterAddingAll', addedFileItems);
        };
        uploader.onBeforeUploadItem = function(item) {
            console.info('onBeforeUploadItem', item);
        };
        uploader.onProgressItem = function(fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
        };
        uploader.onProgressAll = function(progress) {
            console.info('onProgressAll', progress);
        };
        uploader.onSuccessItem = function(fileItem, response, status, headers) {
            console.info('onSuccessItem', fileItem, response, status, headers);
        };
        uploader.onErrorItem = function(fileItem, response, status, headers) {
            console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader.onCancelItem = function(fileItem, response, status, headers) {
            console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploader.onCompleteItem = function(fileItem, response, status, headers) {
            console.info('onCompleteItem', fileItem, response, status, headers);
        };
        uploader.onCompleteAll = function() {
            console.info('onCompleteAll');
        };

        console.info('uploader', uploader);
	};

	controllers.showCtrl = function($scope, $http, galleryService) {
		var old;
        var start = false;
        $scope.maxSize = 5;
        $scope.bigCurrentPage = 1;
        $scope.numPerPage = 16;
        $scope.items = [];

        $scope.getImage = function() {
			galleryService.getAll('all').success(function(data) {
				$scope.images = data;
                $scope.bigTotalItems = data.length;
                pageResult();
                start = true;
			});
		};

        $scope.manualSearch = function() {
            galleryService.getAll($scope.query).success(function(data) {
                $scope.images = data;
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
                $scope.images = $scope.getImage();
            } else {
                old = $scope.query;
                $scope.manualSearch();
            }   
        });

		$scope.delete = function(id) {
			galleryService.delSelect(id).success(function(data) {
				$scope.getImage();
			});
		};

        $scope.$watch('bigCurrentPage', function() {
            if(start) pageResult();
        });

        function pageResult() {
            var begin = (($scope.bigCurrentPage - 1) * $scope.numPerPage);
            var end = begin + $scope.numPerPage;
            $scope.items = $scope.images.slice(begin, end);
        }

		$scope.getImage();
	};

	app.controller(controllers);
})();