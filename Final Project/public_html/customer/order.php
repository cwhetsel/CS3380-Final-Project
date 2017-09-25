<?php include "../core/loginLogic.php"; ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Select Train and Review information</title>
		<meta charset="UTF-8"> 
		<title>Missouri Rail Home</title>
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
				<h1> Enter your customer ID and Quantity</h1>
				<form action="confirm.php" method = "POST">
					<div class="form-group">
						Customer Id: <input class="form-control" type = "text" name = "custID"><br />
						Type: <input class="form-control"type = "text" name = "type" value = '<?php 
						if (isset($_POST['type'])){
							echo $_POST['type'];
							} else {echo "ERROR!";}
						?>' readonly><br />
						Load Capacity: <input class="form-control" type = "text" name = "loadCapacity" value = '<?php 
						if (isset($_POST['loadCapacity'])){
							echo $_POST['loadCapacity'];
							} else {echo "ERROR!";}
						?>' readonly><br />
						Type of Cargo: <input class="form-control" type = "text" name = 'cargoType'><br />
						Location: <input  class="form-control" type = "text" name = "location" value = '<?php 
						if (isset($_POST['location'])){
							echo $_POST['location'];
							} else {echo "ERROR!";}
						?>' readonly><br />
						Price: <input class="form-control"  type = "text" name = "price" value = '<?php 
						if (isset($_POST['price'])){
							echo $_POST['price'];
							} else {echo "ERROR!";}
						?>' readonly><br />
						Quantity
						<select class="form-control" name = "number">
							<?php include("../secure/database.php");
								if (isset($_POST['type'])){
									$link = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME) or die("Connect
									Error ".mysqli_error($link));
									$sql = "SELECT type FROM equipment WHERE id IS NULL AND type = '" . $_POST['type'] . "' AND location = '" . $_POST['location'] . "'";
									if ($result = mysqli_query($link, $sql)){
										$row_cnt = mysqli_num_rows($result);
										for($i = 1; $i <= $row_cnt ; $i++) {
										echo "<option value = '" . $i . "'>" . $i . "</option>\n";
										}
									}
								}
							?>
						</select><br />
					</div>
					<input class="btn btn-danger btn-lg" type= "submit" name = "order" value = "Order">
				</form>
			</div>
		</div>
	</body>
</html>


