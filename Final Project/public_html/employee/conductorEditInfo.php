<?php
	require_once "../core/checkLogin.php";
	checkLogin(); 
	
	//updateEmployeeInfo uses the session variables IDtoUpdate UserToUpdate and RoleToUpdate instead of id and role so that admins can update engineer and conductor info using the dame form as 
	//if the user is not an admin or conductor, redirect
	if(strcmp($_SESSION['role'], 'conductor') !== 0 ) {
		if(strcmp($_SESSION['role'], 'administrator') !== 0) {
			header("Location: index.php");
		}
	}
	//use these to update variables so admins dont lose their credentials 
	//if its a conductor user, use the session id as the id to update. 
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
		<title>Conductor Edit Information</title>
	</head>
	
	<body>
		<?php include_once "../core/employeeNavBar.php"; 
		$error = empty($_SESSION['updateErrors']) ? '' : $_SESSION['updateErrors'];
		if(!empty($error)) {
				echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
		} 
		unset($_SESSION['updateErrors']);
		
		
		//print their info so they can look at what needs to be changed
		include "conductorInfo.php"; ?>
		<br><br>
			<div class="container-fluid">
			<div class="well">
				<form class="form-group" action="employeeUpdateInfo.php" method="POST">
					You only need to fill out the fields you wish to update. (You cannot change your ID or Username) <br>
					ID: <input class="form-control" readonly type="text" value= "<?php echo $_SESSION['IDtoUpdate']; ?>"> <br>
					Username: <input class="form-control" readonly type="text" value= "<?php echo $_SESSION['UserToUpdate']; ?>"> <br>
					First Name: <input class="form-control" type ="text" name ="first" > <br>
					Last Name: <input class="form-control" type ="text" name ="last" > <br>
					Phone Number: <input class="form-control" type ="text" name ="phone" > <br>
					Address: <input class="form-control" type ="text" name ="address" > <br>
					Status (0 is inactive, 1 is active): 
						<input type="radio" name="status" value="1" checked> Active<br>
						<input type="radio" name="status" value="0"> Inactive<br>
					<!--different for each role -->
					Rank: 
					<select class="form-control" name="rank">
						<option value="1">Jr. Conductor</option>
						<option value="2">Conductor 1</option>
						<option value="3">Conductor 2</option>
						<option value="4">Sr. Conductor</option>
					</select>
					<br>
					<!--allow users to change their password or for admins to reset it-->
					Password: <input class="form-control" type ="text" name ="password" > <br>
					Confirm Password: <input class="form-control" type ="text" name ="password2" > <br>
					<input class="btn btn-danger btn-lg" type="submit" name="submit" value="Submit">
					<input class="btn btn-danger btn-lg" type="reset">
				</form>
		</div>
		</div>
	</body>
</html>