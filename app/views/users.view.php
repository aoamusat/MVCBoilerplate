<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Learn | Users</title>
	<link rel="stylesheet" href="">
</head>
<body>

	<?php require 'partials/nav.view.php'; ?>
	<h1>All Users</h1>
	<ul>
		<?php foreach ($users as $user): ?>
			<li><?= $user->name ?></li>
		<?php endforeach ?>
	</ul>
	<h2>Enter Your Name</h2>
	<form method="POST" action="/users">
		<input type="text" name="name" required />
		<button type="submit" class="btn">Submit</button>
	</form>
</body>
</html>