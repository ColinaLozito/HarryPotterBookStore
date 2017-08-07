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

$passed_array = $_POST['books_array'];
$passed_array = unserialize(base64_decode($passed_array));
$item_total = $_POST['item_total'];
$username = $_POST['username'];
$doc_number = rand(10000,99999);
$checkDocNum = "SELECT * FROM sellreport WHERE doc_number = '$doc_number'";

if (!$checkDocNum) {
    die('Query failed to execute for some reason');
    header("Location: home.php");
}
if ($checkDocNum == $doc_number) {
    $doc_number = rand(10000,99999); 
}else{
	foreach ($passed_array as $item){
		$date = date("m.d.y");  
		$customer_name  ;
		$item_name =   $item['name'];;
		$item_quantity =   $item['quantity'];
		$item_quantity = intval($item_quantity);
		$item_price =  $item['price'];
		$sql = "INSERT INTO sellreport (id, doc_number, username, item, quantity, unit_price, total_amount, date) 
			VALUES('', '$doc_number', '$username', '$item_name', '$item_quantity', '$item_price', '$item_total', '$date')";
		if(mysqli_query($connection, $sql)){
		    $update = "UPDATE tblproduct SET quantity = quantity - $item_quantity WHERE name = '".$item_name."'";
			if (mysqli_query($connection, $update)) {
				print_r("exito");
			}else{
				print_r("fallo");
			}
		} else{
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
		    header("Location: home.php");
		}
	}
	// close connection
		mysqli_close($connection);
	}
	header("Location: success.php");
?>