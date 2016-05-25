@extends('layout/dashboard.master')

@section('content')

<div ng-app="product_manager" ng-controller="FormCtrl" ng-init="start(1,'Home','0')">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"> Create Product</h1>
	        <ol class="breadcrumb">
	            <li class="active">
	            	<i class="fa fa-dashboard"></i>
	            	<a href="{{ URL::route('dashboard.index') }}">Dashboard</a>
	            </li>
	            <li class="active">
	            	<i class="fa fa-table"></i>
	            	<a href="{{ URL::route('product.index') }}">Product</a>
	            </li>
	            <li class="active">
	            	<i class="fa fa-comments"></i> Create
	            </li>
	        </ol>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<div class="wrap">
				<form  method="POST" 
					   action="{{ URL::route('product.store') }}" 
					   enctype="multipart/form-data"
					   class="product"
					   id="createForm"
					   novalidate="novalidate">

					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" 
							   class="form-control" 
							   name="name">
					</div>

					<div class="form-group">
						<label for="description">Description</label>
						<input type="text" 
							   class="form-control" 
							   name="description">
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
						<label for="property">Property</label>
						<input type="text" 
							   class="form-control" 
							   name="property">
					</div>


					<div class="form-group">
						<label for="image">Display Image</label>
						<input type="file" 
							   class="form-control" 
							   name="image">
					</div>

					<div class="form-group">
						<label for="propertyimage">Property Image</label>
						<input type="text" name="propertyupdate" value="images" style="display: none">
						<input type="text" name="propertyold" value="oldimages" style="display: none">
						<div class="row">
							<div class="col-lg-12">
								<button class="btn btn-primary" 
										type="button" 
										ng-click="addImage()"
										id="addImage">Add Image</button>
							</div>
						</div>
						<script type="text/ng-template" id="image.html">
						    <div class="modal-header">
						        <h4>Select image to add</h4>
						    </div>
						        
						    <div class="modal-body">
						        <div class="alert alert-danger" role="alert" ng-bind="error" ng-show="error != ''"></div>
								<form action="" enctype="multipart/form-data" id="imageForm">
									<div class="form-group">
										<label for="propname">Name</label>
										<input type="text" class="form-control" name="propname">
									</div>
									<div class="form-group">
										<label for="image">Image</label>
										<input type="file" class="form-control" name="image[]">
									</div>
										
									<div class="form-actions text-center">
										<button class="btn btn-primary" type="submit" ng-click="submit()">Upload</button>
										<button class="btn btn-warning" ng-click="cancel()" type="button">Cancel</button>
									</div>
								</form>

						        </div>
						    </script>
							<div class="row">
								<div class="col-md-4" ng-repeat="image in images" style="margin-top: 30px">
									<img ng-src="@{{ image.thumbnail_path }}" 
										 ng-click="delete(image.id)" style="cursor: pointer"
										 class="img-responsive" tooltip-html-unsafe="@{{ image.name }}">
								</div>
							</div>
						</div>

					<div class="form-group">
						<label for="price">Price</label>
						<input type="text" 
							   class="form-control" 
							   name="price">
					</div>

					<div class="form-group">
						<label for="content">Content</label>
						<textarea type="text" 
								  class="form-control" 
								  name="content" 
								  rows="6" ></textarea>
					</div>

					<div class="form-group text-center">
						<label class="checkbox-inline">
							<input type="checkbox" 
								   name="feature"> Feature
						</label>

						<label class="checkbox-inline">
							<input type="checkbox" 
								   name="promotion"> Promotion
						</label>
					</div>

					<div class="form-actions text-center">
						<button class="btn btn-primary" type="submit">Save</button>
						<a href="{{ URL::route('product.index') }}">
							<button class="btn btn-default" type="button">Cancel</button>
						</a>
					</div>
				</form>

			</div>
		</div>
	</div>

</div>
@endsection