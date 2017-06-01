<?php 

//calling config.php to set all data variables for database connection
include_once('config.php');

//making connection to mysql server (DON'T REPEAT YOURSELF)
mysql_connect(DB_HOST,DB_USER,DB_PASS);
mysql_select_db(DB_NAME);

//including the blog fucntionality
include_once('func/blog.php');

?>