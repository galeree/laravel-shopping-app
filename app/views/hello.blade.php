<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User auth with Confide</title>

</head>
<body>
	<h1>Hello Confide</h1>
	<p>
		Hi
		<?php echo (Confide::user() ?: 'visitor') ?>
		{{ $as }}
	</p>
</body>
</html>
