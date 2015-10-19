<html>

<head>
	<meta charset="utf-8"/>
	<title> Success! </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
</head>

<body>
	<h1 class="jumbotron text-center"> Order Placed! </h1>
	<div class="container-fluid">
		<div class="span12 text-center">
		<?php 
			echo "<span>" .$_POST['total']. " was charged to ".$_POST['payment']."</span><br/>";

			for ($i = 0; $i < (int) $_POST['noTransactions']; $i++){
				echo "<span>". $_POST['retailerPrice'. $i] . " was charged to ". $_POST['retailer' . $i] . " for ". $_POST['retailerItemNo' . $i] . " items.</span><br/>";
			} 

		?>
		<span> An email has been sent to your account with receipts, shipping information, etc </span>
	</div>
	</div>
</body>
</html>