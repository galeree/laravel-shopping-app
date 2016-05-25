<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User auth with Confide</title>
	{{ HTML::style('css/bootstrap.min.css')}}
	<style>
		body {
			background-color: #EEE;
		}
		.maincontent {
			background-color: #FFF;
			margin: auto;
			padding: 20px;
			width: 300px;
			box-shadow: 0 0 20px #AAA;
		}
	</style>
</head>
<body>
	<div class="maincontent">
		<h1>Signup</h1>
		{{-- Renders the signup form --}}
		{{ Confide::makeSignupForm()->render(); }}
	</div>
	{{ HTML::script('js/jquery-2.1.1.min.js') }}
	{{ HTML::script('js/bootstrap.min.js')}}
</body>
</html>