<?php
	//This sets the Update session variables and redirects to the correct engineer or conductor EditInfo.php page for the admin 
	require_once "../core/checkLogin.php";
	checkLogin();
	
	//get the role and username of the id the admin wants to update
	$_SESSION['updateErrors'] = "";
	$sql = "SELECT role, username FROM employee WHERE employee.id = ?";	
	
	require "../../dbconfig.php";
	$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
	
	if ($mysqli->connect_errno) { //Terminate script if there is a connection error
		$_SESSION['updateErrors'] = "Failed to connect to database";
		header("Location: employeeInfo.php");
		exit();
	}
	//prepare and execute
	$stmt = $mysqli->stmt_init(); 
	$stmt->prepare($sql);
	$stmt->bind_param("s", $_POST['IDtoUpdate']);
	$stmt->execute();
	//get the results
	$result = $stmt->get_result();
	$arry = $result->fetch_array(MYSQLI_ASSOC);
	$role = $arry['role'];
	$username = $arry['username'];

	//set the appropriate session variables 
	$_SESSION['RoleToUpdate'] = $role; 
	$_SESSION['IDtoUpdate'] = $_POST['IDtoUpdate']; 
	$_SESSION['UserToUpdate'] = $username;
	
	
	if(strcmp($role, 'engineer') == 0) {
		header("Location: engineerEditInfo.php");
		exit();
	}
	else if(strcmp($role, 'conductor') == 0) {
		header("Location: conductorEditInfo.php");
		exit();
	}
	else {
		$_SESSION['updateErrors'] = "Cannot update administrators' information";
		header("Location: adminEditEmployeeInfo.php"); 
		exit();
	}
	
	
?>