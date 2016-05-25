@extends('layout/dashboard.master')
@section('content')

<div ng-app="product_manager" ng-controller="showCtrl">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"> Product 
				<a href="{{ URL::route('product.create') }}" 
				   class="btn btn-primary btn-sm"><i class="fa fa-plus"></i><b> Add New</b></a>
			</h1>
	        <ol class="breadcrumb">
	            <li class="active">
	            	<i class="fa fa-dashboard"></i>
	            	<a href="{{ URL::route('dashboard.index') }}">Dashboard</a>
	            </li>
	            <li class="active">
	            	<i class="fa fa-shopping-cart"></i> Product
	            </li>
	        </ol>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 text-center">
			
			<form class="form-inline" style="margin-bottom: 2%">
				<div class="btn-group form-group" dropdown>
					<button type="button" 
							class="btn btn-default btn-sm" 
							ng-bind="options[select]"></button>
					<button type="button" 
							class="btn btn-default btn-sm dropdown-toggle" dropdown-toggle>
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
					<input type="text" class="form-control input-sm" 
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
							<td><b>Category</b></td>
							<td><b>Image</b></td>
							<td><b>Feature</b></td>
							<td><b>Promotion</b></td>
							<td></td>
							<td></td>
						</tr>
					</thead>
					<tbody>
							<tr ng-repeat="item in items">
								<td ng-bind="item.id"></td>
								<td ng-bind="item.name"></td>
								<td>
									<a href=""
									   class="category-link" 
									   ng-click="newTab(item.category_id)" 
									   ng-bind="item.category_name"></a>
								</td>
								<td ng-bind="item.image"></td>
								<td><i ng-class="extra(item.feature)"></i></td>
								<td><i ng-class="extra(item.promotion)"></i></td>
								<td>
									<a href="/dashboard/product/edit/@{{ item.id}}" 
									   title="Edit" class="icon">
										<i class="fa fa-fw fa-pencil-square-o"></i>
									</a>
								</td>
								<td>
									<a href="/dashboard/product/delete/@{{ item.id }}" 
									   title="Delete" class="icon">
										<i class="fa fa-fw fa-trash-o"></i>
									</a>
								</td>
							</tr>
					</tbody>
				</table>
			</div>
			<pagination total-items="bigTotalItems" ng-model="bigCurrentPage" 
						max-size="maxSize" class="pagination-sm page" 
						boundary-links="false" items-per-page="20"
						previous-text="&laquo;" next-text="&raquo;"></pagination>
		</div>
	</div>
</div>


@endsection
