<?php
    require_once "../core/checkLogin.php";
    require_once "../core/log.php";

    checkLogin();

    if(strcmp($_SESSION['role'], "administrator") !== 0){
        //if they are not an admin then redirect to index
        header("Location: ../index.php");
    }
    //Add the train when submit is set
            if(isset($_POST['submit'])){
                include "../../dbconfig.php";
                $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
                
                if($mysqli->connect_errno){
                    $_SESSION['updateErrors'] = "Failed to connect to mysql";
                    exit();
                }
                $query = "SELECT * FROM `trains` WHERE `trainNumber`=?";
                $stmt = $mysqli->stmt_init();
                if(!$stmt->prepare($query)){
                    $_SESSION['updateErrors'] = "Prepare failed on line 89";
                    exit();
                }
                $stmt->bind_param("s", $_POST['trainNumber']);
                $stmt->execute();
                $result = $stmt->get_result();
                $exists = $result->num_rows;
                //echo "Found: ". $exists;
                
                if($exists == 0){
                    $query = "INSERT INTO `trains`(trainNumber, destination, startLocation, days, departureTime, arrivalTime) VALUES(?,?,?,?,?,?)";
                    $stmt = $mysqli->stmt_init();
                    if(!$stmt->prepare($query)){
                        $_SESSION['updateErrors'] = "Prepare failed on 102";
                        exit();
                    }
                    $stmt->bind_param("ssssii", $_POST['trainNumber'], $_POST['destination'], $_POST['startLocation'], $_POST['days'], $_POST['departureTime'], $_POST['arrivalTime']);
                    if($stmt->execute()){
                        $_SESSION['updateErrors'] = "Train has been added";
                    }
                    else{
                        $_SESSION['updateErrors'] = "Train failed to be added";
                    }
                    
                    
                    
                }
                else{
                    $_SESSION['updateErrors'] = "<h1>Train with same train number already exists</h1>";
                }
                //enter the insert train into log
                $id = $_SESSION['id'];
                $description = "Employee #{$id} added a train";
                addLog($id, $description, 6);
                $stmt->close();
                $mysqli->close();
            }
        
			?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8"> 
		<?php include "../core/bootstrapCDN.php"; ?>
        <link rel="stylesheet" href="../core/style.css">
        <title>Add Train</title>
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
				<br>
				<a href="http://cs3380.rnet.missouri.edu/~GROUP1/employee/adminSearchTrain.php">Search Trains</a>
				<form class="form-group" action="" method="POST">
					Train Number: <br>
					<input class="form-control" type="text" name="trainNumber" required="required">
					<br>
					Destination: <br>
					<input class="form-control" type="text" name="destination" required="required">
					<br>
					Start Location: <br>
					<input class="form-control" type="text" name="startLocation" required="required">
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
					<input class="btn btn-lg btn-danger" type="submit" name="submit">
				</form>
        
			</div>
		</div>
    </body>
</html>
