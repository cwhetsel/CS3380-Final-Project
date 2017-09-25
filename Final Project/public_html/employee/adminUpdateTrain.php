<?php
	require_once "../core/checkLogin.php";
    checkLogin();

    if(strcmp($_SESSION['role'], "administrator") !== 0){
        //if they are not an admin then redirect to index
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8"> 
		<?php include "../core/bootstrapCDN.php"; ?>
        <link rel="stylesheet" href="../core/style.css">
        <title>Update Train</title>
    </head>
    <body>
		<?php
		$error = empty($_SESSION['updateErrors']) ? '' : $_SESSION['updateErrors'];
		unset($_SESSION['updateErrors']);
		include_once "../core/employeeNavBar.php"; 
		if(!empty($error)) {
				echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
		} 
		?>
		<div class="container-fluid">
			<div class="well">	
				<a href="http://cs3380.rnet.missouri.edu/~GROUP1/employee/adminSearchTrain.php">Search Trains</a>
				<hr>
				
				<?php
				
					if(isset($_POST['update'])){
						$trainNumber = $_POST['trainNumber'];
						include "../../dbconfig.php";
						$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
						
						if($mysqli->connect_errno){
							echo "Failed to connect to database.";
							exit();
						}
						
						$sql = "SELECT * FROM `trains` WHERE `trainNumber` =  '$trainNumber'";
						$result = $mysqli->query($sql) or die ($mysqli->error);
						$row = $result->fetch_array(MYSQLI_NUM) or die ($mysqli->error);
					
				?>
				
				<form class="form-group" action="adminHandleUpdate.php" method="POST">
					Train Number: <br>
					<input class="form-control" type="text" readonly name="trainNumber" value="<?= $row[0] ?>">
					<br>
					Destination: <br>
					<input class="form-control" type="text" name="destination" value="<?= $row[1] ?>">
					<br>
					Start Location: <br>
					<input class="form-control" type="text" name="startLocation" value="<?= $row[2] ?>">
					<br>
					Days:
					<select class="form-control" name="days">
						<option value="Monday">Monday</option>
						<option value="Tuesday">Tuesday</option>
						<option value="Wednesday">Wednesday</option>
						<option value="Thursday">Thursday</option>
						<option value="Friday">Friday</option>
						<option value="Saturday">Saturday</option>
						<option value="Sunday">Sunday</option>
					</select>
					<br>
					Departure Time: 
				   <select class="form-control" name="departureTime">
						<option value="80000">8:00</option>
						<option value="90000">9:00</option>
						<option value="100000">10:00</option>
						<option value="110000">11:00</option>
						<option value="120000">12:00</option>
						<option value="130000">13:00</option>
						<option value="140000">14:00</option>
						<option value="150000">15:00</option>
						<option value="160000">16:00</option>
						<option value="170000">17:00</option>
						<option value="180000">18:00</option>
					</select>
					<br>
					Arrival Time: 
				   <select class="form-control" name="arrivalTime">
						<option value="80000">8:00</option>
						<option value="90000">9:00</option>
						<option value="100000">10:00</option>
						<option value="110000">11:00</option>
						<option value="120000">12:00</option>
						<option value="130000">13:00</option>
						<option value="140000">14:00</option>
						<option value="150000">15:00</option>
						<option value="160000">16:00</option>
						<option value="170000">17:00</option>
						<option value="180000">18:00</option>
					</select>
					
					<br><br>
					<input class="btn btn-lg btn-danger" type="submit" name="submit" value="Update Train">
					
				<?php
					}
				?>
				</form>
			</div>
		</div>
    </body>
</html>