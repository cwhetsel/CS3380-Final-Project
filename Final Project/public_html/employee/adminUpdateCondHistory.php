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
        <title>Update Conductor History</title>
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
				<a href="http://cs3380.rnet.missouri.edu/~GROUP1/employee/adminSearchCondHistory.php">Search Conductor History</a>
				<hr>
				
				<?php
				
					if(isset($_POST['update'])){
						$id = $_POST['id'];
						include "../../dbconfig.php";
						$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
						
						if($mysqli->connect_errno){
							$_SESSION['updateErrors']= "Failed to connect to database.";
							exit();
						}
						
						$sql = "SELECT * FROM `conductor_history` WHERE `id` =  '$id'";
						$result = $mysqli->query($sql) or die ($mysqli->error);
						$row = $result->fetch_array(MYSQLI_NUM) or die ($mysqli->error);
					
				?>
				
				<form class="form-group" action="adminHandleCondHistory.php" method="POST">
					Id: <br>
					<input class="form-control" type="text" readonly name="id" value="<?= $row[2]?>">
					<br>
					Start Date: <br>
					<input class="form-control" type="text" name="startDate" value="<?= $row[0]?>">
					<br>
					End Date: <br>
					<input class="form-control" type="text" name="endDate" value="<?= $row[1]?>">
					<br>
		<!--
					Travel Time: <br>
					<input type="text" name="travelTime" value="<?= $row[2]?>">
					<br>
		-->
					Train Number: <br>
					<input class="form-control" type="text" name="trainNumber" value="<?= $row[3]?>">
					<br><br>
					<input class="btn btn-lg btn-danger" type="submit" name="submit" value="Update">
				
				
				<?php
					}
				?>
				
				</form>
			</div>
        </div>
    </body>
</html>
