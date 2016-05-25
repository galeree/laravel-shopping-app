@extends('layout/public.master')

@section('content')
	<div ng-controller="ElementCtrl"
		 ng-init="init('{{ $select }}', '{{ $cat_id }}')"
		 style="min-height: 300px">
		<div class="headbar sticky">
			<div class="heading">
				<div id="bc1" class="btn-group btn-breadcrumb">
		            <a href="/shop" class="btn btn-default"><i class="glyphicon glyphicon-home" style="font-size: 0.55em;"></i></a>
		            <div class="btn btn-default" style="display: none">...</div>
		            @foreach ($navigators as $navigator)
		            	@if ($navigator->id != 1)
		            	<a href = "/shop?cat_id={{ $navigator->id }}"
		            	   class="btn btn-default"><div>{{ $navigator->name }}</div></a>
		            	@endif
		            @endforeach
		        </div>

				<div class="line-separator"></div>
				<ul class="filter">
					<li class="option"><a href="" ng-click="changeScope(0)" 
										  ng-class="{ 'active' : selection == 0}"
										  ng-if="enable[0]">Category</a></li>
					<li class="option"><a href="" ng-click="changeScope(1)" 
										  ng-class="{ 'active' : selection == 1}"
										  ng-if="enable[1]">Product</a></li>
				</ul>

				<div class="options-wrapper">
					<a href="" id="buttonFilters" 
				   	   class="button button-dropdown tagClick">Show filters <i class="caret pull-right" style="margin-top: 20px"></i></a>

					<div class="dropdown custom">
						<button class="btn btn-default dropdown-toggle" 
								type="button"
								id="selectcategory"
								data-toggle="dropdown"
								aria-expanded="true"
								style="width: 120px ">
							<a ng-bind="select"></a>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu" 
							aria-labelledBy="selectcategory">
							<li role="presentation">
								<a href="/shop" role="menuitem"
								   tabindex="-1">All</a>
							</li>
							<li role="presentation" 
								ng-repeat="parent in parents">
								<a href="/shop?cat_id=@{{ parent.id }}" role="menuitem" 
								   tabindex="-1" ng-bind="parent.name"></a>
							</li>
						</ul>
					</div>
					<form class="form-inline">
						<div class="form-group">
							<label class="sr-only" for="search">Search</label>
							<input class="form-control" type="text"  
								   placeholder="Search Here"
								   ng-model="query"></input>
						</div>
						<button class="btn btn-default search" type="submit" ng-click="manualSearch()"><span class="glyphicon glyphicon-search"></span></button>
					</form>
				</div>

				<div id="filters" class="exp_content" style="display: none">
					<div class="subblock first">
						<div class="label">
							<span class="title">SEARCH</span>
						</div>
						<div class="page"></div>
						<div class="field">
							<form class="form-inline">
								<div class="form-group">
									<label class="sr-only" for="search">Search</label>
									<input class="form-control" type="text"  
										   placeholder="Search Here"
										   ng-model="query"></input>
								</div>
							</form>
						</div>
					</div>
					<div class="subblock">
						<div class="label">
							<span class="title">CATEGORY</span>
						</div>
						<div class="page"></div>
						<div class="field">
							<ul>
								<li role="presentation">
									<a href="/shop" role="menuitem"
									   tabindex="-1">Home</a>
								</li>
								<li role="presentation" 
									ng-repeat="parent in parents">
									<a href="/shop?cat_id=@{{ parent.id }}" role="menuitem" 
									   tabindex="-1" ng-bind="parent.name"></a>
								</li>							
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div id="products-grid" class="products-grid" style="margin-top: 70px">
			<div class="pl-page">
				<div id="element" class="text-center"
				     ng-if="selection == 0" ng-include="templates[0].url"></div>
				<div id="element" class="text-center"
					 ng-if="selection == 1" ng-include="templates[1].url"></div>
			</div>
		</div>
	</div>

@endsection