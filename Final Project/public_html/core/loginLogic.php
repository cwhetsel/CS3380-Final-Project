<?php
	session_start();
	//unset($_SESSION['id']);
	if(!empty($_SESSION['id'])) {
		header("Location: ../employee/employeeHome.php");
		exit();
	}
	
	if(isset($_POST['login'])) {
		do {
			include "../../dbconfig.php";
			
			$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
			if($mysqli->connect_errno){
				$error = "Connection failed.";
				break;
			}
			$query = "SELECT * FROM authentication WHERE username =?";
			$stmt = $mysqli->stmt_init();
				
			if(!$stmt->prepare($query)){
				$error = "Stmt failed to prepare";
				break;
			}
			$stmt->bind_param("s",$_POST['username']);
			$stmt->execute();
			$result = $stmt->get_result();
			$exists = $result->num_rows;
				
			If($exists == 0){
				$error = "<hr>Username or Password incorrect!";
				break;
			}
			else{
				$hash = $result->fetch_assoc();
					
				if(password_verify($_POST['pass'], $hash['password'])){
						
					$_SESSION['name'] = $_POST['username'];
					$_SESSION['id'] = $hash['id'];
					$_SESSION['role'] = $hash['role'];
						
					header("Location: ../employee/employeeHome.php");
					exit();
				}
			}
		}while(0);
	}
	
	if(isset($_POST['register'])) {
		do {
			include "../../dbconfig.php";
			if(strcmp($_POST['pass'], $_POST['pass2'])) {
				$error = "Passwords dont match";
				break;
			}
			
			$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
			if($mysqli->connect_errno){
				$error = "Connection failed.";
				exit();
			}
			
			$query = "SELECT * FROM authentication WHERE id=?";
			$stmt = $mysqli->stmt_init();
			
			if(!$stmt->prepare($query)){
				$error= "Stmt failed to prepare";
				break;
			}
			
			$stmt->bind_param("s",$_POST['id']);
			$stmt->execute();
			$result = $stmt->get_result();
			$exists = $result->num_rows;
			
			
			If($exists == 0){
				$query = "SELECT * from authentication where username=?";
				$stmt = $mysqli->stmt_init();
			
				if(!$stmt->prepare($query)){
					$error= "Stmt failed to prepare";
					break;
				}
				
				$stmt->bind_param("s",$_POST['id']);
				$stmt->execute();
				$result = $stmt->get_result();
				$exists = $result->num_rows;
				if($exists == 0) {
					$query = "SELECT role from employee where id=?";
					$stmt = $mysqli->stmt_init();
					
					if(!$stmt->prepare($query)){
						$error= "Stmt failed to prepare";
						break;
					}
					$stmt->bind_param("s",$_POST['id']);
					$stmt->execute();
					$result = $stmt->get_result(MYSQL_ASSOC);
					$_SESSION['id'] = $result['id'];
					$_SESSION['role'] = $result['role'];
					
					$query = "INSERT INTO authentication VALUES(?,?,?)";
					$stmt = $mysqli->stmt_init();
					
					if(!$stmt->prepare($query)){
						$error= "Stmt failed to prepare";
						break;
					}
					
					$hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
				
					$stmt->bind_param("sss", $hash, $_SESSION['role'], $_POST['username']);
				
					if(!$stmt->execute()) {
						$error = "User creation failed";
						break;
					}
					
					
					$_SESSION['name'] = $_POST['username'];
					
					header("Location: ../employee/employeeHome.php");
					exit();
				}
				else {
					$error = "Username Taken<br>Please Choose another.";
				}
			}
			else{
				$error = "This Employee Number is already registered.";
			}
			
			$stmt->close();
			$mysqli->close();
		}while(0);
	}

?>