<?php
session_start();
// require_once("dbcontroller.php");
require_once("connect.php");
if (isset($_SESSION['username'])){
$username = $_SESSION['username'];
// echo "Hai " . $username . " ";
// echo "This is the Members Area ";
}else{
	header('Location: admin.php');
}

$con=mysqli_connect("localhost","root","","blog_samples");
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	header('Location: admin.php');
}

?>

<HTML>
<HEAD>
<TITLE>Harry Potter Shopping Cart</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</HEAD>

<BODY style="width:900px;font-family:calibri; margin: auto; padding-top: 20px; ">
	<div style="float: right; margin-top: -30px">
		<h3>
		<?php 
			echo "<a href='logout.php' title='logout' class='glyphicon glyphicon-log-out'></a>";
		 ?>
		 </h3>	
	</div>
<div style="width: 100%; height: 200px; background-image: url(http://www.tuitionsandstationery.com/Popup/pop.jpg);">
	<h1 class="title" style="padding-top: 80px; padding-left: 200px; color: white;">Harry Books - Online Store</h1>
</div>

<div class="content">
	<div class="tab-pane" id="shopping-cart">
		<div class="txt-heading">Admin Module </div>
		<h3><strong>NOTE:</strong> The ordes are gruped by <strong><i>Doc Number</i></strong></h3>
		<table cellpadding="10" cellspacing="1">
			<tbody>
			
				<tr>
				<th style="text-align:center;"><strong>Doc number</strong></th>
				<th style="text-align:center;"><strong>User</strong></th>
				<th style="text-align:center;"><strong>Item</strong></th>
				<th style="text-align:center;"><strong>Quantity</strong></th>
				<th style="text-align:center;"><strong>Unit price</strong></th>
				<th style="text-align:center;"><strong>Group price</strong></th>
				<th style="text-align:center;"><strong>Order Amount</strong></th>
				<th style="text-align:center;"><strong>Date</strong></th>
				</tr>	
				<?php

				$result = mysqli_query($con,"SELECT * FROM sellreport");
				while($row = mysqli_fetch_array($result)){
				?>
					<tr>
					<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $row['doc_number']; ?></strong></td>
					<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $row['username']; ?></td>
					<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $row['item']; ?></td>
					<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $row['quantity']; ?></td>
					<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$".$row["unit_price"]; ?></td>
					<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$".$row["quantity"]*$row["unit_price"]; ?></td>
					<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$".$row["total_amount"]; ?></td>
					<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo date("d/m/Y", strtotime($row["date"])); ?></td>
					</tr>
					<?php
					}
					?>
				<div>
				
				</div>
			</tbody>
		</table>		
	</div>
</div>
</BODY>
</HTML>