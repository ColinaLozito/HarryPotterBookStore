<?php
session_start();
require_once("dbcontroller.php");
require_once("connect.php");
if (isset($_SESSION['username'])){
$username = $_SESSION['username'];
// echo "Hai " . $username . " ";
// echo "This is the Members Area ";
}else{
	header('Location: index.php');
}
$db_handle = new DBController();
if(!empty($_GET["action"])) {
	switch($_GET["action"]) {
		case "add":
			if(!empty($_POST["quantity"])) {
				$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
				$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
				
				if(!empty($_SESSION["cart_item"])) {
					if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
						foreach($_SESSION["cart_item"] as $k => $v) {
								if($productByCode[0]["code"] == $k) {
									if(empty($_SESSION["cart_item"][$k]["quantity"])) {
										$_SESSION["cart_item"][$k]["quantity"] = 0;
									}
									$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
								}
						}
					} else {
						$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
					}
				} else {
					$_SESSION["cart_item"] = $itemArray;
				}
			}
		break;
		case "remove":
			if(!empty($_SESSION["cart_item"])) {
				foreach($_SESSION["cart_item"] as $k => $v) {
						if($_GET["code"] == $k)
							unset($_SESSION["cart_item"][$k]);				
						if(empty($_SESSION["cart_item"]))
							unset($_SESSION["cart_item"]);
				}
			}
		break;
		case "empty":
			unset($_SESSION["cart_item"]);
		break;	
	}
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
	
<ul class="nav nav-pills" style="height: 60; padding-top: 10;">
  <li class="active"><a  href="#product-grid" data-toggle="tab">Home</a></li>
  <li style="float: right;">
  	<a title="shopping cart" class="glyphicon glyphicon-shopping-cart" style="height: 40px;" href="#shopping-cart" data-toggle="tab"></a>
  </li>
  <strong><p class="items" style="float: right; padding: 9px; color: red;">
  	<?php 
  	if(isset($_SESSION["cart_item"])){
	    $items = 0;
		foreach ($_SESSION["cart_item"] as $item){
	        $items += ($item["quantity"]);
		}
	echo $items . ' items';
	}else{
	echo "";	
	}		
	?>
		
	</p></strong>
</ul>

<div class="tab-content">
	<div class="tab-pane" id="shopping-cart">
		<div class="txt-heading">Shopping Cart <a id="btnEmpty" href="home.php?action=empty">Empty Cart</a></div>
		<?php
		if(isset($_SESSION["cart_item"])){
		    $item_total = 0;
		    $items = 0;
		?>	
		<table cellpadding="10" cellspacing="1">
			<tbody>
			
				<tr>
				<th style="text-align:left;"><strong>Name</strong></th>
				<th style="text-align:left;"><strong>Code</strong></th>
				<th style="text-align:right;"><strong>Quantity</strong></th>
				<th style="text-align:right;"><strong>Price</strong></th>
				<th style="text-align:center;"><strong>Action</strong></th>
				</tr>	
				<?php		
				    foreach ($_SESSION["cart_item"] as $item){
						?>
							<tr>
							<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["name"]; ?></strong></td>
							<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["code"]; ?></td>
							<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
							<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$".$item["price"]; ?></td>
							<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="home.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">Remove Item</a></td>
							</tr>
							<?php
						        $item_total += ($item["price"]*$item["quantity"]);
					}
							?>
				<tr>
				<td style="padding-top: 20px; padding-right:20px;  " colspan="5" align=right><strong>Total:</strong> <?php echo "$".$item_total; ?></td>
				</tr>
				<div>
					<form action="insert.php" method="post">
						
							<?php		
						    foreach ($_SESSION["cart_item"] as $item){
									
										$items=array();
										$items[] = $item;
									$items = base64_encode(serialize($_SESSION["cart_item"])); 
									// print_r($items); 
									echo "<input type='hidden' name='books_array' value=".$items." />";
									echo "<input type='hidden' name='item_total' value=".$item_total." />";
									echo "<input type='hidden' name='username' value=".$username." />";
								}	
									?>

					<button type="submit" value="Submit" style="float:right; margin-top: 50px;" type="button" class="btn btn-default btn-lg">
					  <span aria-hidden="true"></span> Order Now
					</button>
					</form>
					</div>
			</tbody>
		</table>		
		  <?php
		}
		?>
	</div>

	<div class="tab-pane active" id="product-grid">
		<div class="txt-heading">Products</div>
		<?php
		$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
		if (!empty($product_array)) { 
			foreach($product_array as $key=>$value){
		?>
			<div class="product-item" style="position: relative; width: 850px; height: 220px;">
				<form method="post" action="home.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
					<div class="product-image" style="float: left;">
						<img style="height: 200px; width: 133px;" class="cover" src="<?php echo $product_array[$key]["image"]; ?>">
					</div>
					<div style="float: left;">
						<strong><?php echo $product_array[$key]["name"]; ?></strong>
					</div>
					<div class="product-price" style="float: right;"><?php echo "$".$product_array[$key]["price"]; ?></div>
					<div style="float: right;">
						
							<?php 
								$len = $product_array[$key]["quantity"];
								if ($len != 0) {
									echo "<select name='quantity'>";
									for ($i=1; $i <= $len ; $i++) { 
										echo '<option value="'.$i.'">'.$i.'</option>';
									}
									echo "</select>";
									echo '<input type="submit" value="Add to cart" class="btnAddAction" />';
								}else{
									echo "<p>Out of stock</p>";
								}
								
							?>
						</select>
					</div>
				</form>
			</div>
		<?php
				}
		}
		?>
	</div>
</div>
</BODY>
</HTML>