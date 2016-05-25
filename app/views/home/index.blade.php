@extends('layout/public.master')

@section('content')
	<div class="bg-home-events postLoaderResponsive">
	</div>
	<div class="home-container">
			<div id="about" class="text-center section">
				<div class="row">
					<h1>About</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
						Duis pretium metus sed leo rutrum, a ornare lectus finibus. 
					</p>
				</div>

				<div id="slider" class="carousel slide" data-ride="carousel"
				     style="margin-bottom: 5%;">

					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<img src="/image/contact/home1.jpg">
							<div class="carousel-caption">

							</div>
						</div>
						<div class="item">
							<img src="/image/contact/home1.jpg">
							<div class="carousel-caption">

							</div>
						</div>
						<div class="item">
							<img src="/image/contact/home1.jpg">
							<div class="carousel-caption">

							</div>
						</div>
					</div>

					<a class="left carousel-control pointer" href="#slider" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control pointer" href="#slider" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
			
			<div id="extra" class="text-center section" 
				 ng-controller="OptionCtrl"
				 ng-init="init()">
				<div class="row">
					<h1>Special</h1>
					<p>See all of our feature product her. 
						Including many products that 
						we have recommended for you.</p>
				</div>

				<!-- Chose Feature or Promotion Product -->
				<div class="row">
					<div class="btn-group" role="group" aria-label="...">
						<button class="btn btn-default" 
								ng-click="chooseProduct('feature')" 
								ng-class="{ active: select == 'feature' }">
							<span class="glyphicon glyphicon-th"></span> FEATURE  
						</button>
						<button class="btn btn-default" 
								ng-click="chooseProduct('promotion')" 
								ng-class="{ active: select == 'promotion' }">
							<span class="glyphicon glyphicon-list"></span> PROMOTION
						</button>
					</div>
				</div>

				<!-- Show Product -->
				<div id="element">
					<div ng-repeat = "product in products | filter: scan"
						 class="col-md-4 animate">
						<div class="pointer elementcontent"
							ng-click="open(product)"
							ng-mouseover="product.state = true"
							ng-mouseleave="product.state = false">
							<div class="imagebox">
								<img ng-src="@{{ product.image }}" class="elementimage">
							</div>
							<h4 ng-bind="product.name"></h4>
							<button class="btn btn-warning btn-sm">80 Bath / Yard</button>
							@include('home.popup')
						</div>
						<hr ng-class="highlight(product)">
					</div>
				</div>
			</div>
		</div>
@endsection