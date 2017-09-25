<?php
	//checks to make sure the session id is set.
	require_once "../core/checkLogin.php";
	checkLogin(); 
	if(strcmp($_SESSION['role'], "administrator") !== 0) {
		//if they are not an admin redirect them to the eployee home
		header("Location: employeeInfo.php"); 
	}
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"> 
		<?php include "../core/bootstrapCDN.php"; ?>
        <link rel="stylesheet" href="../core/style.css">
		<Title>Edit Employees' Info</title>
	</head>
	<body>
		<?php 
		//include the navbar 
		include "../core/employeeNavBar.php"; 
		//get any errors that may have occured and display them
		$error = empty($_SESSION['updateErrors']) ? '' : $_SESSION['updateErrors'];
		//unset the variables so new errors can be recorded
		unset($_SESSION['updateErrors']);
		if(!empty($error)) {
				echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
		}   ?>
		
		<!-- admins cannot edit other admins info -->
		<div class="container-fluid">
			<div class="well">
				<h3>Choose an Employee to view/edit their informaiton</h3>
				<form class="form-group" action="" method="POST">
					<h4>Search employees by Name, Id or Role</h4> 
					ID <input class="form-control" type="text" name="id">
					Last Name <input class="form-control" type="text" name="last">
					Role 
					<select class="form-control" name="role">
						<option value="3">Engineer and Conductor</option>
						<option value="1">Conductor</option>
						<option value="2">Engineer</option>
					</select>
					<br>
					<input class= "btn btn-lg btn-danger" type="submit" name="submit1" value="Submit">
				</form>
			</div>
		</div>
		<!-- <h3> Enter the ID of the employee whose information you wish to update</h3> 
		<form action="prepareAdminEmployeeUpdate.php" method="POST">
			Id to Update<input type="text" name="IDtoUpdate"> 
			<input type="submit" name="submit2" value="Submit">
		</form> -->
		
        
		<?php 
			
			if(isset($_POST['submit1'])) {
				//initialize the connection to the db
				require "../../dbconfig.php";
				$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
				if ($mysqli->connect_errno) { //Terminate script if there is a connection error
					$_SESSION['updateErrors'] = "Failed to connect to database";
					header("Location: employeeInfo.php");
					exit();
				}
				$stmt = $mysqli->stmt_init(); 
				
				//getting the search criteria from the form
				//last
				$last = "%";
				if(!empty($_POST['last'])) {
					$last .= htmlspecialchars($_POST['last']); 
					$last .= "%";
				}
				
				//id
				$id = "%";
				if(!empty($_POST['first'])) {
					$id .= htmlspecialchars($_POST['id']); 
					$id .= "%";
				}

				//role
				$role = "%";
				if(!empty($_POST['role'])) {
					if($_POST['role'] == 1) {
						$role = "conductor";
					}
					else if($_POST['role'] == 2) {
						$role = "engineer";
					}
					else {
						$role ="%";
					}
				}

					
				
				//SQL query 
				$sql = "SELECT users.id, firstName, lastName, username, role FROM users JOIN employee ON (users.id = employee.id) WHERE role != 'administrator' AND role LIKE ? AND users.id LIKE ? AND lastName LIKE ? ORDER BY users.id";
				
				$stmt->prepare($sql);
				$stmt->bind_param("sss", $role, $id, $last);
				$stmt->execute();
				
				//print results
				$result = $stmt->get_result();
					print "<div class='container-fluid'><div class='well'><table class='table table-responsive'> <th>ID</th><th>FirstName</th><th>LastName</th><th>username</th><th>role</th>";
					while ($row = $result->fetch_array(MYSQLI_NUM)) {
						echo "<tr>";
						foreach ($row as $r) {
							print "<td> {$r} </td>";
						}
						?>
						<!-- print an update button in each row of the result with a hidden form with the id as its value -->
						<td>
							<form action="prepareAdminEmployeeUpdate.php" method="POST">
								<input type="hidden" name="IDtoUpdate" value="<?=$row[0] ?>">
								<input class="btn btn-md btn-danger" type="submit" name="submit2" value="update">
							</form>
						</td>
						<?php
						print "</tr>";
					}		
					
					
					
					echo "</table></div></div>";
				$stmt->close();
				$mysqli->close();
			}
			//displays all employees when the page is first loaded. 
			else {
				require "../../dbconfig.php";
				$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
				if ($mysqli->connect_errno) { //Terminate script if there is a connection error
					$_SESSION['updateErrors'] = "Failed to connect to database";
					header("Location: employeeInfo.php");
					exit();
				}

				//SQL query 
				$sql = "SELECT users.id, firstName, lastName, username, role FROM users JOIN employee on (users.id = employee.id) where role != 'administrator'";	
				$result = $mysqli->query($sql); //Execute query 
				//print results
					print "<div class='container-fluid'><div class='well'><table class='table table-responsive'> <th>ID</th><th>FirstName</th><th>LastName</th><th>username</th><th>role</th>";
					while ($row = $result->fetch_array(MYSQLI_NUM)) {
						echo "<tr>";
						foreach ($row as $r) {
							print "<td> {$r} </td>";
						}
						?>
						<!-- print an update button in each row of the result with a hidden form with the id as its value -->
						<td>
							<form action="prepareAdminEmployeeUpdate.php" method="POST">
								<input type="hidden" name="IDtoUpdate" value="<?=$row[0] ?>">
								<input type="submit" name="submit2" value="update">
							</form>
						</td>
						<?php
						print "</tr>";
					}		
					
					
					
					echo "</table></div></div>";
				$mysqli->close();
			}
			 
		?>
	</body>
</html>
