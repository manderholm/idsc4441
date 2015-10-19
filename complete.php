<html>

<head>
	<meta charset="utf-8"/>
	<title> Success! </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
</head>

<body>
	<div id="banner"></div> <!-- TODO !-->
	<h1> Order Complete! </h1>
	<?php 
	/*	foreach ($_POST as $key => $value) {
			echo "<br/> key----- $key";
			echo "<br/> value----- $value";
		} */

		echo "<span>" .$_POST['total']. " was charged to ".$_POST['payment']."</span><br/>";

		for ($i = 0; $i < (int) $_POST['noTransactions']; $i++){
			echo "<span>". $_POST['retailerPrice'. $i] . " was charged to ". $_POST['retailer' . $i] . " for ". $_POST['retailerItemNo' . $i] . " items.</span><br/>";
		} 
	?>
	<span> An email has been sent to your account with receipts, shipping information, etc </span>
</body>
</html>