<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title> Checkout </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
</head>

<body>
	<h2 class="jumbotron"> Checkout </h2>
	<div class="container">
		<h4> Order Summary: </h4>
		<?php 
		echo "<div class='row'>";
		for ($i = 0; $i < (int) $_POST['noTransactions']; $i++ ){
			echo "<div class='col-md-6'>";
			echo "<h5>Retailer: " . $_POST['retailer' . $i] . "</h5>";
			echo "Number of items: " . $_POST['retailerItemNo' . $i];
			echo "<br/> Cost For Retailer: ". $_POST['retailerPrice'. $i];
			echo "</div>";
			if ($i % 2 == 1){
				echo "</div>";
				echo "<div class='row'>";
			}
		} 

		echo "<div class='col-md-6'>";
		echo " <h5> Overall: </h5>";
		echo "Total number of items: " . $_POST['totalItems'];
		echo "<br/> Total Price: " . $_POST['totalCost'];
		echo "</div></div> <br/>";

		?>
		<h4> Enter Billing Information: </h4>
		<div class='row'>
			<div class='col-md-6'>
				<h5> Payment Options: </h4>
				<span> Choose Existing Payment Option: </span>
				<form method='post' action='complete.php'>
					<input type="radio" name="payment" value="Visa: ********1111">Visa: ********1111<br/>
					<input type="radio" name="payment" value="American Express: ********0005">American Express: ********0005<br/>
					<input type="radio" name="payment" value="PayPal">PayPal<br/>
					<?php
						echo "<input type='hidden' name='total' value='".$_POST['totalCost']."'>";
						echo "<input type='hidden' name='noTransactions' value='". $_POST['noTransactions'] ."'>";
						for ($i = 0; $i < (int) $_POST['noTransactions']; $i++ ){
							echo "<input type='hidden' name='retailer".$i."' value='".$_POST['retailer' . $i]."'>";
							echo "<input type='hidden' name='retailerItemNo".$i."' value='".$_POST['retailerItemNo' . $i]."'>";
							echo "<input type='hidden' name='retailerPrice".$i."' value='".$_POST['retailerPrice' . $i]."'>";
						} 

					?>
					<button> Add new payment method </button>
					<input type="submit">
				</form>
			</div>
			<div class='col-md-6'>
				<h5> Address: </h4>
				<span> Choose Address: </span>
				<form method='post' action='complete.php'>
					<input type="radio" name="payment" value="Visa: ********1111">1015 15th Ave SE, Minneapolis MN<br/>
					<?php
						echo "<input type='hidden' name='total' value='".$_POST['totalCost']."'>";
						echo "<input type='hidden' name='noTransactions' value='". $_POST['noTransactions'] ."'>";
						for ($i = 0; $i < (int) $_POST['noTransactions']; $i++ ){
							echo "<input type='hidden' name='retailer".$i."' value='".$_POST['retailer' . $i]."'>";
							echo "<input type='hidden' name='retailerItemNo".$i."' value='".$_POST['retailerItemNo' . $i]."'>";
							echo "<input type='hidden' name='retailerPrice".$i."' value='".$_POST['retailerPrice' . $i]."'>";
						} 
					?>
					<button>Add new address</button>
					<input type="submit">
				</form>
			</div>
		</div>
	</div>
</body>
</html>