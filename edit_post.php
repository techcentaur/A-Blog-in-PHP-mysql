<?php
include_once('resources/init.php');

$posts = get_posts($_GET['id']);

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
		edit_post($_GET['id'], $title,$contents,$_POST['category']);

		header("Location: index.php?id=".$post[0]['post_id']);
			die();
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>edit a Post</title>
	<style>
		label {display: block;}
	</style>
</head>
<body>
	<h1>edit a post</h1>


	<?php
	if (isset($errors) && !empty($errors)){
		echo "<ul><li>",implode('</li><li>',$errors),"</li></ul>";
	} ?>


	<form action="" method="POST">
		<div>
			<label for="title">Title:</label>
			<input type="text" name="title" value="<?php echo $posts[0]['title']; ?>" >
		</div>
		<div>
			<label for="contents">Contents:</label>
			<textarea name="contents" rows="15"	cols="50"><?php echo $posts[0]['contents']; ?></textarea>
		</div>
		<div>
			<label for="category">Category:</label>
			<select name="category">
				<?php
				foreach ( get_categories() as $category) {
					$selected = ($category['name'] == $post[0]['name'])
				 	?>
				 		<option value="<?php echo $category['id']; ?><?php echo $selected; ?>"><?php echo $category['name']; ?></option>

				 	<?php
				 } 
				?>
			</select>
		</div>
		<div>
			<input type="submit" name="" value="Save Post">
		</div>
	</form>
</body>
</html>