<?php include "../core/loginLogic.php"; ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<?php include "../core/bootstrapCDN.php"; ?>
		<title>Order Train Cars</title>
		
        <link rel="stylesheet" href="style.css">
	</head>
	
	

	<body>
	
		<?php include "../core/customerNavBar.php"; ?>
		<?php if(isset($error)) {
			echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
		} ?>
		
		<div class="container-fluid">
			<div class="well">
			<h1>Browse Available Train Cars</h1>
			<form action = "customerbrowse.php" method = "POST">
					<div class="form-group">
						Type of Car: <select class= "form-control" name = "type">
									<option value = "all">All</option>
									<?php include("../secure/database.php");
										$link = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME) or die("Connect
										Error ".mysqli_error($link));
										$sql = "SELECT DISTINCT type FROM
                                        equipment WHERE id IS NULL AND type !=
                                        'locomotive'";
										if ($result = mysqli_query($link, $sql)){
											while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
												echo "<option value = '" . $row['type'] . "'>" . $row['type'] . "</option>\n";
											}
										}
									?>
							</select>
					</div>
					<div class="form-group">
						Location: <select class="form-control" name = 'location'>
								<option value = 'all'>All</option>
								<?php /*include("../secure/database.php");*/
										$link = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME) or die("Connect
										Error ".mysqli_error($link));
										$sql = "SELECT DISTINCT location FROM equipment WHERE id IS NULL";
										if ($result = mysqli_query($link, $sql)){
											while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
												echo "<option value = '" . $row['location'] . "'>" . $row['location'] . "</option>\n";
											}
										}
								?>
							</select>
					</div>
					<div class="form-group">
						Min : <input class="form-control type = "number" name = "min" min = "0" max = "1000" value = "0">
					</div>
					<div class="form-group">
						Max: <input class="form-control" type="number" name = "max" min = "0" max = "1000" value = "1000"> <br />
					</div>
					<input class="btn btn-danger btn-block" type="submit" name = "filter" value = "Filter">
				</form>
				<?php 
				/*include("../secure/database.php");*/
					if (isset($_POST['filter'])) {
						$sql = "SELECT serialNumber, loadCapacity, type,
                        location, manufacturer, price from equipment WHERE type
                        != 'locomotive' AND id IS NULL AND price < ? AND price > ?";
							if ($_POST['type'] != 'all'){
								$sql = $sql .  " AND type = '" . $_POST['type'] . "'";
							}
							if ($_POST['location'] != 'all'){
								$sql = $sql .  " AND location = '" . $_POST['location'] . "'";
							}
							/*echo $sql;*/
							$link = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME) or die("Connect Error ".mysqli_error($link));
							if ($stmt = $link->prepare($sql)){
								$stmt->bind_param("ii", $_POST['max'], $_POST['min']);
								$stmt->execute();
								$result = $stmt->get_result();
								
								$row_cnt = mysqli_num_rows($result);
								if ($row_cnt == 0){
									echo "No valid results. Plealse try a different filter.";
								} else {
									function queryToTable($result){
									echo "<h2>Results</h2>";
									echo "<table class='table table-responsive table-hover table-striped'>\n";
									echo "\t<tr>\n";
									while ($finfo = mysqli_fetch_field($result)){
										echo"<th>" . $finfo->name . "</th>\n"; 

										}
										echo"<th>Order</th>\n"; 
										echo"</tr>\n";
									while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
										echo "<tr>\n";
										foreach ($row as $value){
											echo "<td>" . $value . "</td>\n";
										}
										echo "<td><form action = 'order.php' method = 'POST'><input class='btn btn-info btn-sm' type='submit' name='order' value='Order'>
											<input type = 'hidden' name = 'serialNumber' value = '" . $row[0] . "'>
											<input type = 'hidden' name = 'loadCapacity' value = '" . $row[1] . "'>
											<input type = 'hidden' name = 'type' value = '" . $row[2] . "'>
											<input type = 'hidden' name = 'location' value = '" . $row[3] . "'>
											<input type = 'hidden' name = 'manufacturer' value = '" . $row[4] . "'>
											<input type = 'hidden' name = 'price' value = '" . $row[5] . "'>
											</form></td>\n";
										echo "</tr>\n";
									}
									echo "</table>\n";
									}
									queryToTable($result);
									$stmt->close();
								}
							}
					}
				?>
			</div>
		</div>
	</body>
</html>
						
				

      
			  
				
				
			
	
