<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header" style="float:left">
			<a href="{{ URL::route('dashboard.index') }}" class="navbar-brand">S.WATTANA</a>
		</div>

		<div class="pull-right" style="float:left">
			<ul class="nav navbar-nav pull-left">
				<li class="dropdown pull-right">
					<a href="{{ URL::route('dashboard.index') }}" 
					   class="dropdown-toggle" data-toggle="dropdown" 
					   role="button" aria-expanded="false">{{ Confide::user()?Confide::user()->username:'guest' }} <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Profile</a></li>
						<li><a href="{{ URL::to('users/logout') }}">Log out</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
	<!--<div class="well">
		<b>email:</b> {{ Confide::user()?Confide::user()->email:'guest' }}
	</div>-->