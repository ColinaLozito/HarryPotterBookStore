<?php 
require_once("dbcontroller.php");
require_once("connect.php");
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
<div class="tab-content">
	
	<div class="tab-pane active" id="product-grid">
		<div class="txt-heading"></div>
			<div class="product-item" style="position: relative; width: 850px; height: 220px;">
				<h1>Orded successfully maked.</h1>
				<h1>Press return to back to Home.</h1>
				<a href="home.php?action=empty"><button>Return</button></a>
			</div>
	</div>
</div>
</BODY>
</HTML>