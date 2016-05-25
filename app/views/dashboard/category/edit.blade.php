@extends('layout/dashboard.master')

@section('content')

<div ng-app="category_manager" ng-controller="FormCtrl" ng-init="start({{ $category->category_id }}, {{ "'".$name."'" }})">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"> Edit Category</h1>
	        <ol class="breadcrumb">
	            <li class="active">
	            	<i class="fa fa-dashboard"></i>
	            	<a href="{{ URL::route('dashboard.index') }}">Dashboard</a>
	            </li>
	            <li class="active">
	            	<i class="fa fa-table"></i>
	            	<a href="{{ URL::route('product.index') }}">Category</a>
	            </li>
	            <li>
	            	<i class="fa fa-comments"></i> Edit
	            </li>
	        </ol>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<div class="wrap">
				<form  method="POST" 
					   action="{{ URL::route('category.update', array($category->id)) }}" 
					   enctype="multipart/form-data"
					   id="editForm"
					   class="category">
					
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" 
							   class="form-control" 
							   name="name" 
							   value="{{ $category->name }}">
					</div>

					<div class="form-group">
						<label for="description">Description</label>
						<input type="text" 
							   class="form-control" 
							   name="description" 
							   value="{{ $category->description }}">
					</div>


					<div class="form-group">
						<script type="text/ng-template" id="modal.html">
					        <div class="modal-header">
					            <ol class="breadcrumb">
								  <li ng-repeat="navigator in navigators">
								  	<a href="" ng-bind="navigator.name" ng-click="traverse(navigator.id)"></a>
								  </li>
								</ol>
					        </div>
					        
					        <div class="modal-body">
			        				<div class="row">
						        		<div class="col-lg-4 text-center" ng-repeat="item in items"
						        			 ng-class="activeNode(item.id)"
						        			 style="cursor: pointer"
						        			 ng-click="choose(item.id,item.name)"
						        			 ng-dblclick="traverse(item.id)">
						        			<i class="fa fa-file fa-4x" style="display: block"></i>
						        			<p ng-bind="item.name" style="clear: both"></p>
						        		</div>
						        	</div>
					        </div>

					        <div class="modal-footer">
					            <button class="btn btn-primary" ng-click="ok()">Select</button>
					            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
					        </div>
					    </script>

						<input class="form-control" type="number" name="category_id" value="@{{ select }}" style="display: none"></input>
						<button class="btn btn-primary" type="button" ng-click="open()">Select Parent</button>
						<p class="help-block" ng-bind="catName" style="display: inline"></p>
					</div>

					<div class="form-group">
						<label for="image">Display Image</label>
						<input type="file" 
							   class="form-control" 
							   name="image">
					</div>

					<div class="form-actions text-center">
						<button class="btn btn-primary" type="submit">Save</button>
						<a href="{{ URL::route('category.index') }}">
							<button class="btn btn-default" type="button">Cancel</button>
						</a>
					</div>
				</form>
			</div>
		</div>

	</div>

</div>

@endsection