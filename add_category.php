<?php

include_once('resources/init.php');

if (isset($_POST['name'])){
	$name = trim($_POST['name']);

	if (empty($name)){
		$error='Must Submit a Category Name';
	} elseif (category_exists('name',$name)) {
		$error = "That Category Already exists";
	} elseif (strlen($name) > 24) {
		$error = "category names can only be upto 24 characters";
	}

	if ( !isset($error)) {
		add_category($name);

		header("Location: add_post.php")
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add a Category</title>
</head>
<body>
	<h1>Add a Category</h1>
	<?php
	if (isset($error)){
		echo "<p>{$error}</p>\n";
	}
	?>

	<form action="" method="POST">
		<div>
			<label for="name">Name: </label>
			<input type="text" name="name" value="">
		</div>
			<input type="submit" name="" value="Add Category">
	</form>

</body>
</html>