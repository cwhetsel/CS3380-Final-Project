<?php include "../core/loginLogic.php"; ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Confirm Order</title>
		<meta charset="UTF-8"> 
		<?php include "../core/bootstrapCDN.php"; ?>
        <link rel="stylesheet" href="style.css">
		
	</head>
	
	

	<body>
		<?php include "../core/customerNavBar.php"; ?>
		<?php if(isset($error)) {
			echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
		} ?>
	
		<div class="container-fluid">
			<div class="well">
				<h1>Confirm your Order</h1>
					<form class="form-group" action = "reciept.php" method = "POST">
						Customer ID: <input class="form-control" type = "text" name = "custID" value = '<?php 
						if (isset($_POST['custID'])){
							echo $_POST['custID'];
							} else {echo "ERROR!";}
						?>' readonly><br />
						Type: <input  class="form-control" type = "text" name = "type" value = '<?php 
						if (isset($_POST['type'])){
							echo $_POST['type'];
							} else {echo "ERROR!";}
						?>' readonly><br />
						Load Capacity: <input  class="form-control" type = "text" name = "loadCapacity" value = '<?php 
						if (isset($_POST['loadCapacity'])){
							echo $_POST['loadCapacity'];
							} else {echo "ERROR!";}
						?>' readonly><br />
						Type of Cargo: <input  class="form-control" type = "text" name = "cargoType" value = '<?php 
						if (isset($_POST['cargoType'])){
							echo $_POST['cargoType'];
							} else {echo "ERROR!";}
						?>' readonly><br />
						Location: <input class="form-control"  type = "text" name = "location" value = '<?php 
						if (isset($_POST['location'])){
							echo $_POST['location'];
							} else {echo "ERROR!";}
						?>' readonly><br />
						Number: <input class="form-control"  type = "text" name = "number" value = '<?php 
						if (isset($_POST['number'])){
							echo $_POST['number'];
							} else {echo "ERROR!";}
						?>' readonly><br />
						Price: <input class="form-control"  type = "text" name = "price" value = '<?php 
						if (isset($_POST['price'])){
							
							echo $_POST['price'];
							} else {echo "ERROR!";}
						?>' readonly><br />
						Total(with Tax): <input class="form-control"  type = "text" name = "priceTotal" value = '<?php 
						if (isset($_POST['price'])){
							$str = $_POST['price'] * 1.05 * $_POST['number'];
							echo $str;
							} else {echo "ERROR!";}
						?>' readonly><br />
						<input class="btn btn-danger btn-lg" type = "submit" name = "confirm" value = "Confirm">
					</form>
			</div>
		</div>
	</body>
</html>
