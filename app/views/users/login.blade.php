<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Log In</title>
	{{ HTML::style('css/bootstrap.min.css')}}
	{{ HTML::style('css/session/login.css')}}
	{{ HTML::script('js/jquery-2.1.1.min.js') }}
</head>
<body>
	<div class="row maincontent">
		<div class="col-lg-4 col-lg-offset-4 login">
			{{-- Renders the signup form --}}
			{{ Confide::makeLoginForm()->render(); }}
		</div>
	</div>
	<script>
		(function() {
			$(document).keypress(function (e) {
				var key = e.which;
 				if(key == 13) {
 					$( "form" ).submit();
 				} 
			});
		})();
	</script>
	{{ HTML::script('js/bootstrap.min.js')}}
</body>
</html>