<?php 
	require_once "../core/checkLogin.php";
	checkLogin(); 
	//redirect if not an admin
	if(strcmp($_SESSION['role'], 'administrator') !== 0) {
			header("Location: index.php");
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
	//display the user's info based on their id. Joins on users and employee because there is nothing in administrator
	$id = $_SESSION['IDtoUpdate'];
	//display any errors
	$error = empty($_SESSION['updateErrors']) ? '' : $_SESSION['updateErrors'];
	unset($_SESSION['updateErrors']);
	include_once "../core/employeeNavBar.php"; 
	if(!empty($error)) {
				echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
		} 
	
	$sql = "SELECT users.id, users.firstName, users.lastName, employee.username, users.phoneNumber, employee.address FROM users JOIN employee ON (users.id = employee.id) where users.id = {$id}";
	echo "<div class='container-fluid'><div class='well'><h1>Your Information</h1>";
	include "../core/sqlPrintResultTable.php";
	executeQuery($sql); 
	
	echo "<a href='adminEditInfo.php'>Click here to edit your information</a>";
	echo "</div></div>";
?>
	</body>
</html>