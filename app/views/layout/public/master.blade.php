<!doctype html>
<html lang="TH">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>S.WATTANA</title>

	{{ HTML::style('css/home/shop.css') }}
	{{ HTML::style('css/home/style.css') }}
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::script('js/angular.min.js') }}
	{{ HTML::script('js/ui-bootstrap-tpls-0.12.0.min.js')}}
	{{ HTML::script('js/jquery-2.1.1.min.js') }}
	{{ HTML::script('js/angular-animate.min.js') }}
	{{ HTML::style('admin/font-awesome/css/font-awesome.min.css') }}
</head>
<body ng-app="home" class="page-type-home">
	<div class="page">
		<div class="navigation">
			<header class="navbar navbar-fixed-top" role="banner">
				<div class="navbar-header">
					<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="{{ URL::route('home.index') }}" class="navbar-brand">S.WATTANA</a>
				</div>
				<div class="collapse navbar-collapse" id="collapse">
					<ul class="nav navbar-nav">
						<li><a href="{{ URL::route('home.index') }}">HOME</a></li>
						<li><a href="{{ URL::route('home.shop') }}">SHOP</a></li>
						@if(Route::current()->getName() == 'home.shop')
						    <li><a href="/#about">ABOUT</a></li>
							<li><a href="/#footer">CONTACT</a></li>
						@else
							<li><a href="#about">ABOUT</a></li>
							<li><a href="#footer">CONTACT</a></li>
						@endif
					</ul>
				</div>

			</header>
		</div>
		<div class="content">
			@yield('content')
		</div>

		<div id="footer" class="footer">
			<div class="wrap">
				<div class="line">
					<span id="first">ADDRESS</span><span id="second">65 Ladya Road, Klongsan, Bangkok 10600</span>
				</div>
				<div class="line">
					<span id="first">EMAIL</span><span id="second">galeguy@hotmail.com</span>
				</div>
				<div class="line">
					<span id="first">TEL</span><span id="second">028616396</span>
				</div>
				<div class="line">
					<span id="first">MOBILE</span><span id="second">0855557889, 0855549644</span>
				</div>
				<div class="line">
					<span id="first">Est 2015</span><span id="second">@2015 S.WATTANA. All Rights Reserved.</span>
				</div>
			</div>

			<div class="social">
				<a href="" class="twitter">
					<span class="fa-stack fa-lg">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-twitter fa-stack-1x" style="color: black"></i>
					</span>
				</a>
				<a href="" class="facebook">
					<span class="fa-stack fa-lg">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-facebook fa-stack-1x" style="color: black"></i>
					</span>
				</a>
			</div>
		</div>
	</div>

	{{ HTML::script('js/home.js') }}
	{{ HTML::script('js/custom.js') }}
	{{ HTML::script('js/bootstrap.min.js')}}
</body>
</html>