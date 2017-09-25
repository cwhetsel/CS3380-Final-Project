<?php 
	require_once "../core/checkLogin.php";
	checkLogin();
	//updateEmployeeInfo uses the session variables IDtoUpdate UserToUpdate and RoleToUpdate instead of id and role so that admins can update engineer and conductor info using the dame form as 
	//if the user is not an admin or conductor, redirect
	if(strcmp($_SESSION['role'], 'conductor') !== 0) {
		if(strcmp($_SESSION['role'], 'administrator') !== 0) {
			header("Location: ../index.php");
		}
	}
	else {
		$_SESSION['IDtoUpdate'] = $_SESSION['id']; 
		$_SESSION['RoleToUpdate'] = $_SESSION['role']; 
		$_SESSION['UserToUpdate'] = $_SESSION['username'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<?php include "../core/bootstrapCDN.php"; ?>
        <link rel="stylesheet" href="../core/style.css">
		<title>Admin Information</title>
	</head>
	
	<body>
	<?php
	$id = $_SESSION['IDtoUpdate'];
	
	$error = empty($_SESSION['updateErrors']) ? '' : $_SESSION['updateErrors'];
	unset($_SESSION['updateErrors']);
	include_once "../core/employeeNavBar.php"; 
	if(!empty($error)) {
				echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
		}  

		//display the user's info based on their id. Joins on users and employee and conductor

	$sql = "SELECT users.id, users.firstName, users.lastName, employee.username, users.phoneNumber, employee.address, conductor.status, conductor.rank FROM users JOIN employee ON (users.id = employee.id) JOIN conductor ON (users.id = conductor.id) where users.id = {$id}";
echo "<div class='container-fluid'><div class='well'><h1>Your Information</h1>";
	include "../core/sqlPrintResultTable.php";
	executeQuery($sql); 
	
	//Conductor history query
	echo "<h4>Train Assignments</h4>";
	$sql = "SELECT trainNumber, startDate, endDate FROM conductor_history WHERE conductor_history.id = {$id}";
	executeQuery($sql); 
	
	echo "<a href='conductorEditInfo.php'>Click here to edit your information</a>";
	echo "</div></div>";
?>
	</body>
</html>
	