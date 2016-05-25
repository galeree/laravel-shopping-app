@extends('layout.default')

@section('content')

<div class="col-md-6">
	<div class="wrap" ng-app="feature" ng-controller="CreateFormCtrl">
		<h2>Create Feature</h2>
		<form  method="POST" 
			   action="{{ URL::route('feature.store') }}" 
			   enctype="multipart/form-data" 
			   novalidate 
			   name="createForm"
			   role="form"
			   >
			<div class="form-group" show-errors is-success>
				<label for="order">Order</label>
				<input type="number" 
					   class="form-control" 
					   name="order" 
					   required ng-model="create.order"
					   min="1"
				       <? if(Input::old('order')) {
				       		echo "ng-init=\"create.order=".Input::old('order')."\"";
				          }
				       ?>
					   >
				<p class="help-block" ng-hide="createForm.order.$dirty">{{ $errors->first('order') }}</p>
				<p class="help-block" ng-show="createForm.order.$error.required">Please enter order.</p>
				<p class="help-block" ng-show="createForm.order.$error.min">Order is at least 1.</p>
			</div>
			<div class="form-group" show-errors is-success>
				<label for="title">Title</label>
				<input type="text" 
				       class="form-control" 
				       name="title"
				       required ng-model="create.title"
				       <? if(Input::old('title')) {
				       		echo "ng-init=\"create.title='".Input::old('title')."'\"";
				          }
				       ?>
				       >
				<p class="help-block" ng-hide="createForm.title.$dirty">{{ $errors->first('title') }}</p>
				<p class="help-block" ng-show="createForm.title.$invalid">Please enter title.</p>
			</div>
			<div class="form-group" show-errors is-success>
				<label for="image">Image</label>
				<input type="file" 
					   class="form-control" 
					   name="image" 
					   required ng-model="create.image" valid-file>
				<p class="help-block" ng-show="createForm.image.$invalid">Choose File to upload.</p>
			</div>
			<div class="form-group" show-errors is-success>
				<label for="alias">Alias</label>
				<input type="text" 
					   class="form-control" 
					   name="alias" 
					   required ng-model="create.alias"
				       <? if(Input::old('alias')) {
				       		echo "ng-init=\"create.alias='".Input::old('alias')."'\"";
				          }
				       ?>
					   >
				<p class="help-block" ng-hide="createForm.alias.$dirty">{{ $errors->first('alias') }}</p>
				<p class="help-block" ng-show="createForm.alias.$invalid">Please enter alias.</p>
			</div>
			<div class="form-group" show-errors is-success>
				<label for="content">Content</label>
				<textarea class="form-control" 
						  name="content" 
						  rows="6" required 
						  ng-model="create.content"
				          <? if(Input::old('content')) {
				       		    echo "ng-init=\"create.content='".Input::old('content')."'\"";
				             }
				          ?>
						  ></textarea>
				<p class="help-block" ng-hide="createForm.content.$dirty">{{ $errors->first('content') }}</p>
				<p class="help-block" ng-show="createForm.content.$invalid">Please enter content.</p>
			</div>
			<div class="form-actions">
				<button class="btn btn-primary" type="submit" ng-disabled="createForm.$invalid">Save</button>
				<a href="{{ URL::route('feature.index') }}"><button class="btn btn-danger" type="button">Cancel</button></a>
			</div>
		</form>
	</div>
</div>
@endsection