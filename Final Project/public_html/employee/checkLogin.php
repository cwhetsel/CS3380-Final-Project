<?php
	function checkLogin() {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$id = empty($_SESSION['id']) ? false : $_SESSION['role'];
		if(!$id) {
			//redirect to login if id is not set meaning the user is not logged in. 
			header("Location: ../home/index.php"); 
		}
	}
?>