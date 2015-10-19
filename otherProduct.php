<html>

<head>
	<meta charset="utf-8"/>
	<title> Product </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
</head>

<body>
	<div class="container-fluid">
		<div class="jumbotron"><h1>Overstock</h1></div>
		<div class="row">
			<div class='col-md-4'>
				<img src="resources/showercurtain.jpg"/> <br/>
			</div>
			<div class='col-md8'>
				<span> Name: Circle Shower Curtain </span><br/>
				<span> Price: $35.50 </span><br/>
				<span> Length: 6 ft  </span><br/>
				<span> Height: 6 ft </span>
				<form action="addProduct.php" method="post"> 
					<input type='hidden' value="NULL" name="tid">
					<input type='hidden' value="6" name="pid">
					<input type='number' min='1' name="quantity" value="1">
					<button> Add to Cart </button>
					<input type='submit' value="Add to myCart">
				</form>
			</div>
		</div>
	</div>
</body>
</html>