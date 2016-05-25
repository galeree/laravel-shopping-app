@extends('layout/dashboard.master')
@section('content')

<div ng-app="category_manager" ng-controller="showCtrl">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"> Category <a href="{{ URL::route('category.create') }}" class="btn btn-primary btn-sm"><b>Add New</b></a></h1>
	        <ol class="breadcrumb">
	            <li class="active">
	            	<i class="fa fa-dashboard"></i>
	            	<a href="{{ URL::route('dashboard.index') }}">Dashboard</a>
	            </li>
	            <li class="active">
	            	<i class="fa fa-table"></i> Categories
	            </li>
	        </ol>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 text-center">

			<form class="form-inline" style="margin-bottom: 2%">
				<div class="btn-group form-group" dropdown>
					<button type="button" class="btn btn-default" ng-bind="options[select]"></button>
						<button type="button" class="btn btn-default dropdown-toggle" dropdown-toggle>
						<span class="caret"></span>
				        <span class="sr-only">Select query</span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li ng-repeat="(key, value) in options">
							<a href="" ng-bind="value" ng-click="choose(key)"></a>
						</li>
					</ul>
				</div>

				<div class="form-group">
					<input type="text" class="form-control" 
						   id="query" placeholder="Search"
						   ng-model="query">
				</div>
			</form>

			<div class="table-responsive">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<td><b>ID</b></td>
							<td><b>Name</b></td>
							<td><b>Description</b></td>
							<td><b>Parent</b></td>
							<td><b>Image</b></td>
							<td></td>
							<td></td>
						</tr>
					</thead>
					<tbody>
							<tr ng-repeat="category in items">
								<td ng-bind="category.id"></td>
								<td ng-bind="category.name"></td>
								<td ng-bind="category.description"></td>
								<td><a href="" ng-bind="category.category_name" ng-click="newTab(category.category_id)"></a></td>
								<td ng-bind="category.image"></td>
								<td>
									<a href="/dashboard/category/edit/@{{ category.id}}" title="Edit">
										<span class="glyphicon glyphicon-pencil"></span>
									</a>
								</td>
								<td>
									<a href="/dashboard/category/delete/@{{ category.id }}" title="Delete">
										<span class="glyphicon glyphicon-trash"></span>
									</a>
								</td>
							</tr>
					</tbody>
				</table>
			</div>
			<pagination total-items="bigTotalItems" ng-model="bigCurrentPage" 
						max-size="maxSize" class="pagination-sm" 
						boundary-links="true" items-per-page="20"
						previous-text="&laquo;" next-text="&raquo;"></pagination>
		</div>
	</div>
</div>

@endsection
