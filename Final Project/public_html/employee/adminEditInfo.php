<?php
	require_once "../core/checkLogin.php";
	checkLogin(); 
	//updateEmployeeInfo uses the session variables IDtoUpdate UserToUpdate and RoleToUpdate instead of id and role so that admins can update engineer and conductor info using the same form as 
	//if the user is not an admin or conductor, redirect
	if(strcmp($_SESSION['role'], 'administrator') !== 0) {
			header("Location: ../index.php");
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
		<title>Engineer Edit Information</title>
	</head>
	
	<body>
		<?php include_once "../core/employeeNavBar.php"; 
		//get and print errors
		$error = empty($_SESSION['updateErrors']) ? '' : $_SESSION['updateErrors'];
		unset($_SESSION['updateErrors']);
		if(!empty($error)) {
				echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
		} 
		
		//print their info so they can look at what needs to be changed
		include "adminInfo.php"; ?>
		<br><br>
		<div class="container-fluid">
			<div class="well">
				<form class="form-group" action="employeeUpdateInfo.php" method="POST">
					You only need to fill out the fields you wish to update. (You cannot change your ID or Username) <br>
					ID: <input class="form-control" readonly type="text" value= "<?php echo $_SESSION['id']; ?>"> <br>
					Username: <input class="form-control" readonly type="text" value= "<?php echo $_SESSION['username']; ?>"> <br>
					First Name: <input class="form-control" type ="text" name ="first" > <br>
					Last Name: <input class="form-control"type ="text" name ="last" > <br>
					Phone Number: <input class="form-control" type ="text" name ="phone" > <br>
					Address: <input class="form-control" type ="text" name ="address" > <br>
					Password: <input class="form-control" type ="text" name ="password" > <br>
					Confirm Password: <input class="form-control" type ="text" name ="password2" > <br>
					<input class="btn btn-danger" type="submit" name="submit" value="Submit">
					<input class="btn btn-danger" type="reset">
				</form>
			</div>
		</div>
		
	</body>
</html>