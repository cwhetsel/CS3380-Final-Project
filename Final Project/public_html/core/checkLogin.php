<?php
	//This file can be included in other pages and the check login function can be callled to redirect not logged in users. 
	function checkLogin() {
		//start a session if one is not started. 
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		//get the idea 
		$id = empty($_SESSION['id']) ? false : $_SESSION['id'];
		if(!$id) {
			//redirect to login if id is not set meaning the user is not logged in. 
			header("Location: ../home/index.php"); 
		}
	}
?>