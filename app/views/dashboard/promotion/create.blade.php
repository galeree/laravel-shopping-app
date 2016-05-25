@extends('layout.default')

@section('content')


<div class="col-md-6">
	<div class="wrap">
		<h2>Create Promotion</h2>
		<form  method="POST" 
			   action="{{ URL::route('promotion.store') }}" 
			   enctype="multipart/form-data">
			
			<div class="form-group">
				<label for="order">Order</label>
				<input type="number" 
					   class="form-control" 
					   name="order">
			</div>

			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" 
					   class="form-control" 
					   name="title">
			</div>

			<div class="form-group">
				<label for="image">Image</label>
				<input type="file" 
					   class="form-control" 
					   name="image">
				<p class="help-block">Choose File to upload.</p>
			</div>

			<div class="form-group">
				<label for="alias">Alias</label>
				<input type="text" 
					   class="form-control" 
					   name="alias">
			</div>

			<div class="form-group">
				<label for="content">Content</label>
				<textarea type="text" 
						  class="form-control" 
						  name="content" 
						  rows="6" ></textarea>
			</div>

			<div class="form-actions">
				<button class="btn btn-primary" type="submit" id="submit">Save</button>
				<a href="{{ URL::route('promotion.index') }}">
					<button class="btn btn-danger" type="button">Cancel</button>
				</a>
			</div>
		</form>
	</div>
</div>

@endsection