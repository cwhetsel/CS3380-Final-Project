<?php
	//single script that all employee's edit info pages use to handle the form submission
	require_once "../core/checkLogin.php";
	require_once "../core/log.php";
	checkLogin();
	
	//function that handles the update 
	if(isset($_POST['submit'])) {
		executeUpdate();
		
		//enter the update in the log
		$id = $_SESSION['id'];
		//if an admin updated info that wasnt their own, redirect to the adminEditEmployeeInfo page. Else, go back to the employee's info page
		if(strcmp($id, $_SESSION['IDtoUpdate']) !== 0) {
			//log the action
			$description = "Admin #{$id} editted employee #{$_SESSION['IDtoUpdate']}'s information";
			addLog($id, $description, 5);
			header("Location: adminEditEmployeeInfo.php");
			exit();
		}
		//log the action
		$description = "Employee #{$id} editted their information";
		addLog($id, $description, 4);
		header("Location: employeeInfo.php");
		exit();
	}
	
	//executes the update 
	function executeUpdate() {
		$id = $_SESSION['IDtoUpdate'];
		$role = $_SESSION['RoleToUpdate'];
		
		//create a session varibles where we can store any errors that occur during the update 
		unset($_SESSION['updateErrors']);
		$_SESSION['updateErrors'] = array();
		
		require "../../dbconfig.php";
		$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
		if ($mysqli->connect_errno) { //Terminate script if there is a connection error
			$_SESSION['updateErrors'] = "Failed to connect to database";
			header("Location: employeeInfo.php");
			exit();
		}
		 
		//check each form value if it is set. If it is, we check the input to make sure it is ok to enter in the database. 
		//then run a seperate update for each field to change so that the user doesn't have to enter the same info already in the db into the form if they do not wish to change a field
		//last name
		if(!empty($_POST['last'])) {
			$last = htmlspecialchars($_POST['last']); 
			if(strlen($last) > 64) {
				$_SESSION['updateErrors'] = "Last name cannot be longer than 64 characters. "; 
			}
			else {
				$query = "UPDATE users SET lastName = ? WHERE users.id = {$id}";
				doUpdate($mysqli, $query, $last, 'Last Name');
			}
		}
		//first name
		if(!empty($_POST['first'])) {
			$first = htmlspecialchars($_POST['first']); 
			if(strlen($first) > 64) {
				$_SESSION['updateErrors'] = "First name cannot be longer than 64 characters. "; 
			}
			else{
				$query = "UPDATE users SET firstName = ? WHERE users.id = {$id}";
				doUpdate($mysqli, $query, $first, 'First Name');
			}
		}
		//phone number
		if(!empty($_POST['phone'])) {
			$phone = htmlspecialchars($_POST['phone']); 
			if(strlen($phone) > 16) {
				$_SESSION['updateErrors'] = "Phone Number cannot be longer than 16 characters. "; 
			}
			else {
				$query = "UPDATE users SET phoneNumber = ? WHERE users.id = {$id}";
				doUpdate($mysqli, $query, $phone, 'Phone Number');
			}
		}
		//address
		if(!empty($_POST['address'])) {
			$address = htmlspecialchars($_POST['address']); 
			if(strlen($address) > 255) {
				$_SESSION['updateErrors'] = "Address cannot be longer than 255 characters. "; 
			}
			else{
				$query = "UPDATE employee SET address = ? WHERE employee.id = {$id}";
				doUpdate($mysqli, $query, $address, 'Address');
			}
		}
		//status
		if(!empty($_POST['status'])) {
			$status = $_POST['status']; 
			
			$query = "UPDATE {$role} SET status = ? WHERE id = {$id}";
			doUpdate($mysqli, $query, $status, 'Status');
		}
		//Hours Traveled
		if(!empty($_POST['hours'])) {
			$hours = $_POST['hours']; 
			if($hours > 2147483647 || $hours > PHP_INT_MAX) {
				$_SESSION['updateErrors'] = "Hours Traveled has exceeded the Max int size of MariaDB. Please contact an administrator"; 
				
			}
			else {
				$query = "UPDATE {$role} SET hoursTraveled = ? WHERE id = {$id}";
				doUpdate($mysqli, $query, $hours, 'Hours Traveled');
			}
		}
		//Rank
		if(!empty($_POST['rank'])) {
			if(strcmp($role, 'conductor') == 0) {
				switch($_POST['rank']) {
					case 1: 
						$rank = "Jr. Conductor";
						break;
					case 2: 
						$rank = "Conductor 1";
						break;
					case 3: 
						$rank = "Conductor 2";
						break;
					case 4: 
						$rank = "Sr. Conductor";
						break;
				}
			}
			else {
				switch($_POST['rank']) {
					case 1: 
						$rank = "Jr. Engineer";
						break;
					case 2: 
						$rank = "Engineer 1";
						break;
					case 3: 
						$rank = "Engineer 2";
						break;
					case 4: 
						$rank = "Sr. Engineer";
						break;
				}
			}

			$query = "UPDATE {$role} SET rank = ? WHERE id = {$id}";
			doUpdate($mysqli, $query, $rank, 'Rank');
		}
		
		//Password
		if(!empty($_POST['password'])) {
			if(strcmp($_POST['password'], $_POST['password2'])) {
				$_SESSION['updateErrors'] = "Passwords dont match";
				
			}
			else {
				$pass = $_POST['password']; 
				$hash = password_hash($pass, PASSWORD_DEFAULT);
			
				$query = "UPDATE authentication SET password = ? WHERE id = {$id}";
				doUpdate($mysqli, $query, $hash, 'Password');
			}
		}
		
		$mysqli->close();
		if(!empty($_SESSION['updateErrors'][0])) {
			$_SESSION['updateErrors'] = "Other Updates successful. ";
		}
		
	}
	
	//actually runs the update on the db
	function doUpdate($mysqli, $sql, $value, $field) {
		$stmt = $mysqli->stmt_init(); 
		if(!$stmt->prepare($sql)) {
			$_SESSION['updateErrors'] =  "{$field} update failed. ";
			return;			
		}
		$stmt->bind_param("s", $value);
		if(!$stmt->execute()) {
			$_SESSION['updateErrors'] =  "{$field} update failed. ";
		}
		if(!$stmt->get_result()) {
			$_SESSION['updateErrors'] =  "{$field} update failed. ";
		}
		$stmt->close();
	}
?>