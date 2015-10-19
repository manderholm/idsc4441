<html>

<head>
	<meta charset="utf-8"/>
	<title> Add Product </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
</head>

<body>
	<div id="banner"></div> <!-- TODO !-->
	<h1> Adding Product! </h1>

	<?php
	require_once 'config.php';
	require_once 'opendb.php';

	$pid = $_POST['pid'];
	$quantity = $_POST['quantity'];
	$tid = $_POST['tid'];

	if( $tid=="NULL") {
		$update= "INSERT INTO transaction  (bid, uid, items, quantity) VALUES ('3', '1', '$pid', '$quantity')";

		$result = mysqli_query($conn,$update) or die("Error, query failed:
		".mysqli_error($conn));

		$transactionQuery= "SELECT tid FROM transaction where
		uid like '%".mysqli_real_escape_string($conn, 1)."%' and 
		items like '%".mysqli_real_escape_string($conn, $pid)."%'
		limit 20";

		$transResult = mysqli_query($conn,$transactionQuery) or die("Error, query failed:
		".mysqli_error($conn));


		$transRow = mysqli_fetch_array($transResult);
		$tid = $transRow["tid"];

		$userQuery= "SELECT transactions FROM user where uid like '%".mysqli_real_escape_string($conn, 1)."%' limit 1";

		$userResult = mysqli_query($conn,$userQuery) or die("Error, query failed:
		".mysqli_error($conn));
		$userRow = mysqli_fetch_array($userResult);
		$userTransactions = $userRow["transactions"];
		$updatedTransactions = $userTransactions . ",$tid";

		$userUpdate = "UPDATE user SET transactions='$updatedTransactions' WHERE uid='1'";

		$userUpdateResult = mysqli_query($conn,$userUpdate) or die("Error, query failed:
		".mysqli_error($conn));
	} 
	else{
		$transactionQuery= "SELECT items, quantity FROM transaction where
		uid like '%".mysqli_real_escape_string($conn, 1)."%' and 
		tid like '%".mysqli_real_escape_string($conn, 1)."%'
		limit 20";

		$transResult = mysqli_query($conn,$transactionQuery) or die("Error, query failed:
		".mysqli_error($conn));

		$transRow = mysqli_fetch_array($transResult);
		$currentItems = $transRow["items"];
		$currentQuantities = $transRow["quantity"];

		$updatedItems = $currentItems . ",$pid";
		$updatedQuantity = $currentQuantities . ",$quantity";

		$update="UPDATE transaction SET items='$updatedItems', quantity='$updatedQuantity' WHERE tid='$tid' ";

		$result = mysqli_query($conn,$update) or die("Error, query failed:
		".mysqli_error($conn));
	}


	header("Location: http://csom-idsdl.oit.umn.edu/ec/and02507/gp/myCart.php");
	die();
 

		?>
</body>
</html>