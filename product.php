<html>

<head>
	<meta charset="utf-8"/>
	<title> Product </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
</head>

<body>
	<div class="container-fluid">
		<div class="jumbotron"><h1>TigerDirect</h1></div>
			<div class="row">
				<div class='col-md-4'>
					<img src="resources/computercase.jpg"/>
				</div>
				<div class='col-md-8'>
					<span> Name: Computer Case </span><br/>
					<span> Price: $100.00 </span><br/>
					<span> Brand: AlienWare  </span><br/>
					<span> Shipping Cost: $30 </span>


					<form action="addProduct.php" method="post"> 
						<input type='hidden' value="1" name='tid'>
						<input type='hidden' value="5" name="pid">
						<input type='number' min='1' name="quantity" value="1">
						<button> Add to Cart </button>
						<input type='submit' value="Add to myCart">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>