<?php
include_once('resources/init.php');

$posts = (isset($_GET['id']))? get_posts($_GET['id']) : get_posts();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Live Journal</title>
</head>
<body>
	<nav>
		<ul>
			<li><a href="index.php">Index</a></li>
			<li><a href="add_post.php">Add a Post</a></li>
			<li><a href="add_category.php">Add a category</a></li>
			<li><a href="category_list.php">The Category List</a></li>
		</ul>
	</nav>

	<h1>Ankit's Awesome blog</h1>
	<?php
	foreach ($posts as $post) {
		?>
		<h2><a href="index.php?id=<?php echo $post['post_id']; ?>"><?php echo $post['title']; ?></a></h2>
		<p>Posted On <?php echo date('d-m-y h:m:s',strtotime($post['date_posted']));?></p>
		in <a href="category.php?id=<?php echo $post['category_id']?>"><?php echo $post['name'];?></a>
		<div><?php echo nl2br($post['contents']); ?></div>
	

	<nav>
		<ul>
			<li><a href="delete_post.php?id=<?php echo $post['post_id']; ?>">Delete This Post</a></li>
			<li><a href="edit_post.php?id=<?php echo $post['post_id']; ?>">Edit this post</a></li>
		</ul>
	</nav>	<?php
	}
	?>
</body>
</html>