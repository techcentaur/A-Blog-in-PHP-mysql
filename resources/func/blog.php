<?php

//checking whether the categories exists or not
function category_exists($field,$value) {
	$field = mysql_real_escape_string($field);
	$field = stripcslashes($field);
	$value = mysql_real_escape_string($value);
	$value = stripcslashes($value);
	
	$query = mysql_query("SELECT COUNT(1) FROM `categories` WHERE `{$field}` = '{$value}' ");
	return (mysql_result($query, 0)== '0') ? false : true; 
}

//to add a new category in the blog
function add_category($name){
	$name = mysql_real_escape_string($name);
	$name = stripcslashes($name);

	mysql_query("INSERT into `categories` set `name` = '{$name}' ");

}

//to get all the categories formed in the blog 
function get_categories($id= null){
	$categories = array();

	$query=mysql_query("SELECT `id`,`name` FROM `categories`");

	while($row=mysql_fetch_assoc($query)){
		$categories[]=$row;
	}
	return $categories;
}


//to delete one category in the blog
function delete($table, $id){
	$table = mysql_real_escape_string($table);
	$table = stripcslashes($table);
	$id = (int) $id;

	mysql_query("DELETE FROM `{$table}` WHERE `id` = {$id}");

}

//to add a new post in the blog
function add_post($title,$contents,$category){
	$title = mysql_real_escape_string($title);
	$contents = mysql_real_escape_string($contents);
	$category = (int) $category;

	mysql_query("INSERT INTO `posts` SET 
						`cat_id` = {$category},
						`title`  = '{$title}',
						`contents` = '{$contents}',
						`date_posted`= NOW() ");
}

//to get all the posts from the database to the blog
function get_posts($id=null,$cat_id=null){
	$posts = array();
	$query = "SELECT posts.id AS post_id, categories.id AS category_id, title, contents, date_posted, categories.name FROM posts INNER JOIN categories ON categories.id = posts.cat_id ";
	
	if ( isset($id) ) {
		$id = (int) $id;
		$query .= " WHERE `posts` . `id` = {$id}";
	}
	if (isset($cat_id) ){
		$cat_id = (int) $cat_id;
		$query .= " WHERE `cat_id` = {$cat_id}";
	}
	$query .= " ORDER BY `posts` . `id` DESC";
	$query = mysql_query($query);
	while ($row = mysql_fetch_assoc($query) ) {
		$posts[] = $row;
	}
	return $posts;
}

function edit_post($id, $title, $contents, $category) {
	$id = (int) $id;
	$title = mysql_real_escape_string($title);
	$contents = mysql_real_escape_string($contents);
	$category = (int) $category;

	mysql_query("UPDATE `posts` SET `cat_id` = {$category}, `title` = '{$title}', `contents` = '{$contents}' WHERE `id`= {$id} ");
}