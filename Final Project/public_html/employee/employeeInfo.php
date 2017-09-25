<?php 
	//single script to redirect teh user to their appropriate info page 
	require_once "../core/checkLogin.php";
	checkLogin(); 
	$role = empty($_SESSION['role']) ? false : $_SESSION['role'];
	//echo "{$role}";
	
	if(!$role) {
		//redirect to login if role is not set meaning the user is not logged in. 
		header("Location: ../home/index.php"); 
	}
	
	switch($role) {
		case 'engineer':
			header("Location: engineerInfo.php");
			exit();
			break; 
		case 'conductor':
			header("Location: conductorInfo.php"); 
			exit();
			break;
		case 'administrator':
			header("Location: adminInfo.php"); 
			exit(); 
			break; 
		default:
			header("Location: ../home/index.php"); 
			exit();
			break;
	}
	
?>