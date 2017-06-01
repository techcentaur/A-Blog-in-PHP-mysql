<?php
include_once('resources/init.php');

//checking whethers the varaiables in the form are submitted or not
if (isset($_POST['title'],$_POST['contents'],$_POST['category'])){
	$errors = array();

	$title = trim($_POST['title']);
	$contents = trim($_POST['contents']);

	if (empty($title)) {
		$errors[]= "you need to add a title to it."	;
	}

	if (empty($title)) {
		$errors[]="You need to add some content to it.";
	}

	if (! category_exists('id',$_POST['category'])){
		$errors[]="the category doesn't exist";
	}
	if (strlen($title)>255){
		$errors[]="the title can't be longer than 255 characters";
	}

	if (empty($errors)){
		add_post( $title,$contents,$_POST['category']);

		//retriveing the id that was stored in the variable id last time
		$id=mysql_insert_id();

		header("Location: index.php?id={$id}");
			die();
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add a Post</title>
	<style>
		label {display: block;}
	</style>
</head>
<body>
	<h1>Add a post</h1>


	<?php
	if (isset($errors) && !empty($errors)){
		echo "<ul><li>",implode('</li><li>',$errors),"</li></ul>";
	} ?>


	<form action="" method="POST">
		<div>
			<label for="title">Title:</label>
			<input type="text" name="title" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>" >
		</div>
		<div>
			<label for="contents">Contents:</label>
			<textarea name="contents" rows="15"	cols="50"><?php if (isset($_POST['contents'])) echo $_POST['contents']; ?></textarea>
		</div>
		<div>
			<label for="category">Category:</label>
			<select name="category">
				<?php
				foreach ( get_categories() as $category) {
				 	?>
				 		<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>

				 	<?php
				 } 
				 ?>
			</select>
		</div>
		<div>
			<input type="submit" name="" value="Add Post">
		</div>
	</form>
</body>
</html>