<?php  //Start the Session
session_start();
require('connect.php');
//If the user and pass are submitted
if (isset($_POST['username']) and isset($_POST['password'])){
//Assigning values to variables.
	$username = $_POST['username'];
	$password = $_POST['password'];
	//Checking if the values exist in the database
	$query = "SELECT * FROM `user` WHERE username='$username' and password='$password' and active=0";
	$result = mysqli_query($connection, $query) or die (mysqli_error($connection));
	$count = mysqli_num_rows($result);
	//If the values are equal to the db values the session will be created.
	if ($count == 1){
		$_SESSION['username'] = $username;
	}else{
	//If the login doesn't match, an error message will be shown.
		$fmsg = "Invalid Login Credentials.";
	}
}
//
if (isset($_SESSION['username'])){
$username = $_SESSION['username'];
header("Location: home.php");
}else{
//
?>
<html>
<head>
	<title>User Login Using PHP MySQL</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<!-- <link rel="stylesheet" href="style.css" > -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="login">
	<div class="container" style="width: 400px; padding-top:200px; ">
	      <form class="form-signin" method="POST">
	      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
	        <h2 class="form-signin-heading">Login</h2>
	        <div class="input-group">
				<span class="input-group-addon" id="basic-addon1">@</span>
				<input type="text" name="username" class="form-control" placeholder="Username" required>
			</div>
	        
	        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
	        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
	        <a class="btn btn-lg btn-primary btn-block" href="register.php">Register</a>
	      </form>
	      <a href="admin.php">to admin module</a>
	</div>

</body>

</html>
<?php } ?>