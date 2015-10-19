<html>
<head>
	<meta charset="utf-8"/>
	<title> myCart </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
</head>
<body>
<div class="container-fluid">
	<div class="span12 text-center">
		<?php
			//test if there are user inputs TODO
			if( !isset($_POST['email'])) {
				$_POST['email'] = "john.doe@aol.com";
			}elseif($_POST['email'] == "") {
				$_POST['email'] = "john.doe@aol.com";
			} 

			if( !isset($_POST['password'])) {
				$_POST['password'] = "password";
			}elseif($_POST['email'] == "") {
				$_POST['password'] = "password";
			} 

			require_once 'config.php';
			require_once 'opendb.php';

			$query="SELECT uid, email, password, transactions FROM user where
			email like '%".mysqli_real_escape_string($conn, $_POST['email'])."%'
			limit 20";

			$result = mysqli_query($conn,$query) or die("Error, query failed:
				".mysqli_error($conn));


			$row = mysqli_fetch_array($result);
			$uid = $row['uid'];
			$email = $row['email'];
			$password = $row['password'];
			$transactionsCol = $row['transactions']; //list of tids

			$transactions = explode(",", $transactionsCol);


			if ($_POST["password"] != $password){
				die("please enter your search criteria at .</body></html>"); //TODO
			}

			echo "<h1 class='jumbotron'> $email"."'s myCart! </h1>";

			$noRetailers = 0;
			$noItems = 0;
			$cartPrice = 0;
			$retailerList  = array();
			$retailerPrice = array();
			$retailerItemNo = array();
			foreach ($transactions as $tid ) {
				$noRetailers++;

				$transactionQuery="SELECT uid, bid, items, quantity FROM transaction where
				tid like '%".mysqli_real_escape_string($conn, $tid)."%'
				limit 20";

				$transResult = mysqli_query($conn,$transactionQuery) or die("Error, query failed:
				".mysqli_error($conn));

				$transRow = mysqli_fetch_array($transResult);
				$bid = $transRow['bid'];
				$itemsCol = $transRow['items']; //list of pids 
				$items = explode(",", $itemsCol);
				$quantityCol = $transRow['quantity'];
				$quantity = explode(",", $quantityCol);

				$businessQuery="SELECT name, columns from business where 
				bid like '%".mysqli_real_escape_string($conn, $bid)."%'
				limit 20";

				$businessResult = mysqli_query($conn,$businessQuery) or die("Error, query failed:
				".mysqli_error($conn));

				$busRow = mysqli_fetch_array($businessResult);
				$busName = $busRow['name'];
				$columnsCol = $busRow['columns'];
				$columns = explode(",", $columnsCol);
				$custCol1 = $columns[0];
				$custCol2 = $columns[1];

				array_push($retailerList, $busName);

				echo "<h3> From: $busName </h3>";
echo "</div>";
	echo "</div>";
echo "<div class='container-fluid'>";
	echo "<div class='span12 text-center'>";
				echo "<table class='table table-striped'>";
				echo "<tr><th>Name</th><th>$custCol1</th><th>$custCol2</th><th>Price</th><th>Quantity</th><th>Total</th></tr>";

				$transactionTotal = 0;
				$i = 0;
				$numItemsTrans = 0;
				foreach ($items as $item){
				$productQuery="SELECT pid, price, product_name, custCol1, custCol2 FROM product where
					pid like '%".mysqli_real_escape_string($conn, $item)."%' and 
					bid like '%".mysqli_real_escape_string($conn, $bid)."%' 
					limit 20";	

					$prodResult = mysqli_query($conn,$productQuery) or die("Error, query failed:
					".mysqli_error($conn));

					$prodRow = mysqli_fetch_array($prodResult);
					$price = $prodRow['price'];
					$prodName = $prodRow['product_name'];
					$cv1 = $prodRow['custCol1'];
					$cv2 = $prodRow['custCol2'];
					$url = "http://csom-idsdl.oit.umn.edu/ec/and02507/gp/product.php";
					$prodQuantity = $quantity[$i];
					$total = $prodQuantity * $price;
					$transactionTotal += $total;
					

					echo
					"<tr><td>$prodName</td><td>$cv1</td><td>$cv2</td><td><a href='$url'>\$$price</td><td>$prodQuantity</td><td>$total</td></tr>\n";	

					$i++;
					$numItemsTrans += $prodQuantity;
					$noItems = $noItems + $prodQuantity;
				}

				array_push($retailerItemNo, $numItemsTrans);

				echo "</table>";
				echo "<span> Total number of items: $numItemsTrans</span><br/>";
				echo "<span> Total cost from retailer: \$$transactionTotal </span><br/> <hr/>";
				$cartPrice += $transactionTotal; 
				array_push($retailerPrice, $transactionTotal);
			}

			$tax = round(.055 * $cartPrice, 2);
			$final = round($cartPrice + $tax, 2);

			echo "<span> Total number of retailers: $noRetailers </span><br>";
			echo "<span> Total number of items: $noItems </span><br>";
			echo "<span> Total before tax: $cartPrice </span><br>";
			echo "<span> Tax: $tax </span><br>";
			echo "<span> Total after tax: $final </span><br>";
			?>

			<form method='post' action='checkout.php'>
				<?php
					echo "<input type='hidden' name='totalCost' value='$final'>";
					$j = 0;
					foreach($retailerList as $retailer){
						$priceForRetailer = $retailerPrice[$j];
						$rItemNo = $retailerItemNo[$j];
						echo "<input type='hidden' name='retailer".$j."' value='$retailer'>";
						echo "<input type='hidden' name='retailerPrice".$j."' value='$priceForRetailer'>";
						echo "<input type='hidden' name='retailerItemNo".$j."' value='$rItemNo'>";
						$j += 1;
					}
					echo "<input type='hidden' name='noTransactions' value='$j'>";
					echo "<input type='hidden' name='totalItems' value='$noItems'>";
				?>
				<input type='submit' class='btn btn-primary' value='checkout'>
			</form>

			<?php

				require_once 'closedb.php'; 
			?>
		</div>
	</div>
</body>
</html>
