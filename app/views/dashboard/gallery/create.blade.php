@extends('layout/dashboard.master')

@section('content')

<div ng-app="gallery_manager" ng-controller="galleryCtrl">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"> Add Image</h1>
	        <ol class="breadcrumb">
	            <li class="active">
	            	<i class="fa fa-dashboard"></i>
	            	<a href="{{ URL::route('dashboard.index') }}">Dashboard</a>
	            </li>
	            <li class="active">
	            	<i class="fa fa-table"></i>
	            	<a href="{{ URL::route('gallery.index') }}">Gallery</a>
	            </li>
	            <li>
	            	<i class="fa fa-comments"></i> Create
	            </li>
	        </ol>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12" style="margin-bottom: 40px">
			<h2>Upload images</h2>
			<div>
				<div ng-show="uploader.isHTML5">
					<div class="well my-drop-zone text-center" 
						 nv-file-over uploader="uploader">
						Drop your image here
					</div>
				</div>
				<br>
				<input type="file" nv-file-select uploader="uploader" multiple style="margin: auto">
			</div>
			<!--<h3>Queue</h3>
			<p ng-bind="'Queue length: ' + uploader.queue.length"></p>-->
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th width="50%">name</th>
							<th ng-show="uploader.isHTML5">Size</th>
							<th ng-show="uploader.isHTML5">Progress</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody ng-repeat="item in uploader.queue">
						<td>
							<strong ng-bind="item._file.name"></strong>
							<div ng-show="uploader.isHTML5" ng-thumb="{ file: item._file, height: 100 }">
								<canvas width="125.98425196850394" height="100"></canvas>
							</div>
						</td>
						<td ng-show="uploader.isHTML5" nowrap ng-bind="(item._file.size/(1024*1024)).toFixed(2) + ' MB'"></td>
						<td ng-show="uploader.isHTML5">
							<div class="progress" style="margin-bottom: 0;">
								<div class="progress-bar" role="progressbar" ng-style="{ 'width': item.progress + '%' }" style="width: 0%;"></div>
							</div>
						</td>
						<td class="text-center">
							<span ng-show="item.isSuccess" style="display: none;">
								<i class="glyphicon glyphicon-ok"></i>
							</span>
							<span ng-show="item.isCancel" style="display: none;">
								<i class="glyphicon glyphicon-ban-circle"></i>
							</span>
							<span ng-show="item.isError" style="display: none;">
								<i class="glyphicon glyphicon-remove"></i>
							</span>
						</td>
						<td nowrap>
							<button type="button" class="btn btn-success btn-xs"
									ng-click="item.upload()" ng-disabled="item.isReady || item.isUploading || item.isSuccess">
									<span class="glyphicon glyphicon-upload"></span> Upload
							</button>
							<button type="button" class="btn btn-warning btn-xs"
									ng-click="item.cancel()" ng-disabled="!item.isUploading">
									<span class="glyphicon glyphicon-ban-circle"></span> Cancel
							</button>
							<button type="button" class="btn btn-danger btn-xs"
									ng-click="item.remove()">
									<span class="glyphicon glyphicon-remove"></span> Remove
							</button>
						</td>

					</tbody>
				</table>
			</div>

			<div>
				<div>Queue progress: 
					<div class="progress" style>
						<div class="progress-bar" role="progressbar" ng-style="{ 'width': uploader.progress + '%' }" style="width: 0%"></div>
					</div>
				</div>
			</div>
			<button type="button" class="btn btn-success btn-s"
					ng-click="uploader.uploadAll()" ng-disabled="!uploader.getNotUploadedItems().length"
					disabled="disabled">
					<span class="glyphicon glyphicon-upload"></span> Upload all
			</button>
			<button type="button" class="btn btn-warning btn-s"
					ng-click="uploader.cancelAll()" ng-disabled="!uploader.isUploading"
					disabled="disabled">
					<span class="glyphicon glyphicon-ban-circle"></span> Cancel all
			</button>
			<button type="button" class="btn btn-danger btn-s"
					ng-click="uploader.clearQueue()" ng-disabled="!uploader.queue.length"
					disabled="disabled">
					<span class="glyphicon glyphicon-trash"></span> Remove all
			</button>
			<a class="btn btn-primary" type="button" href="{{ URL::route('gallery.index') }}">Go Back</a>
		</div>
	</div>

</div>

@endsection