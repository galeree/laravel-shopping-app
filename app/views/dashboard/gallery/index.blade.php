@extends('layout/dashboard.master')

@section('content')
<div ng-app="gallery_manager" ng-controller="showCtrl">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"> Gallery <a href="{{ URL::route('gallery.create') }}" class="btn btn-primary btn-sm"><b>Add New</b></a></h1>
	        <ol class="breadcrumb">
	            <li class="active">
	            	<i class="fa fa-dashboard"></i>
	            	<a href="{{ URL::route('dashboard.index') }}">Dashboard</a>
	            </li>
	            <li class="active">
	            	<i class="fa fa-table"></i> Gallery
	            </li>
	        </ol>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 text-center">
			<form style="margin-bottom: 2%">
				<div class="form-group">
					<input class="form-control" type="text" 
						   id="query" placeholder="Search"
						   ng-model="query"></input>
				</div>
			</form>
			<div>
				<div class="well">
					<div class="row">
						<div class="col-lg-3" ng-repeat="image in items"
							 style="margin-bottom: 20px;">
							<img ng-src="@{{ image.thumbnail_path }}" style="cursor: pointer"
								 ng-click="delete(image.id)" class="img-responsive"
								 tooltip-html-unsafe="@{{ image.name }}">
						</div>
					</div>
				</div>
				<pagination total-items="bigTotalItems" ng-model="bigCurrentPage" 
							max-size="maxSize" class="pagination-sm" 
							boundary-links="true" items-per-page="16"
							previous-text="&laquo;" next-text="&raquo;"></pagination>
			</div>
		</div>
	</div>
</div>
@endsection