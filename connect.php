<?php
	 $host = "localhost";
	 $user = "root";
	 $password = "";
	 $database = "blog_samples";
	 $connection;

$connection = mysqli_connect($host,$user,$password,$database);
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, $database);
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}