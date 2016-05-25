@extends('layout.default')
@section('content')

<div class="col-md-12">
	<div class="wrap">
		<h2>Promotion 
			<a href="{{ URL::route('promotion.create') }}" class="add-new-h2">Add New</a>
		</h2>
		</div>
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<td><b>ID</b></td>
					<td><b>Order</b></td>
					<td><b>Title</b></td>
					<td><b>Image</b></td>
					<td><b>Alias</b></td>
					<td><b>Content</b></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				@foreach($promotions as $promotion)
					<tr>
						<td>{{ $promotion->id }}</td>
						<td>{{ $promotion->order }}</td>
						<td>{{ $promotion->title }}</td>
						<td>{{ $promotion->image }}</td>
						<td>{{ $promotion->alias }}</td>
						<td>{{ $promotion->content }}</td>
						<td>
							<a href="{{ URL::route('promotion.edit', array($promotion->id)) }}" title="Edit">
								<span class="glyphicon glyphicon-pencil"></span>
							</a>
						</td>
						<td>
							<a href="{{ URL::route('promotion.delete', array($promotion->id)) }}" title="Delete">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
						<td>
							<a href="">
								<span class="glyphicon glyphicon-list-alt" title="Show"></span>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@endsection
