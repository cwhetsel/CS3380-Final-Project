<?php 
	require_once "../core/checkLogin.php";
	checkLogin();
	//updateEmployeeInfo uses the session variables IDtoUpdate UserToUpdate and RoleToUpdate instead of id and role so that admins can update engineer and conductor info using the dame form as 
	//if the user is not an admin or engineer, redirect
	if(strcmp($_SESSION['role'], 'engineer') !== 0) {
		if(strcmp($_SESSION['role'], 'administrator') !== 0) {
			header("Location: index.php");
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
	
	//print errors
	$error = empty($_SESSION['updateErrors']) ? '' : $_SESSION['updateErrors'];
	unset($_SESSION['updateErrors']);
	include_once "../core/employeeNavBar.php"; 
	if(!empty($error)) {
				echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
		} 
		
	//main body of the page
		//display the user's info based on their id. Joins on users and employee because there is nothing in administrator
	echo "<div class='container-fluid'><div class='well'><h1>Your Information</h1>";
	$sql = "SELECT users.id, users.firstName, users.lastName, employee.username, users.phoneNumber, employee.address, engineer.status, engineer.rank, hoursTraveled FROM users JOIN employee ON (users.id = employee.id) JOIN engineer ON (users.id = engineer.id) where users.id = {$id}";
	//print any errors that occured during the update
	include "../core/sqlPrintResultTable.php";
	executeQuery($sql); 

	//Engineer history query
	echo "<h4>Train Assignments</h4>";
	$sql = "SELECT trainNumber, startDate, endDate, travelTime FROM engineer_history WHERE engineer_history.id = {$id}";
	
	executeQuery($sql); 
	//link to edit the information
	echo "<a href='engineerEditInfo.php'>Click here to edit your information</a>";
	echo "</div></div>";
?>
	</body>
</html>
	
