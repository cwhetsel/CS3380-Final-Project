<?php
session_start();
?>

<!DOCTYPE html>
<style>
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn,.signupbtn {
    float: left;
    width: 100%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens*/
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<body>

<h2>Signup Form</h2>

<form action="" method="POST">
  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Username" name="username" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pass" required>

    <label><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="pass-repeat" required>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="submit" name="signup" class="signupbtn">Sign Up</button>
    </div>
</form>

<form action="front_page.php" method="POST" style="border:1px solid #ccc">
	<div class="clearfix">
		<button type="submit" name="cancel" class="cancelbtn">Cancel</button>
	</div>
</div>
</form>
</body>


<?php
	if(isset($_POST['signup'])){
		include "../../dbconfig.php";
    
		$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
		if($mysqli->connect_errno){
			echo "Connection failed on line 5";
			exit();
		}
		
		$query = "SELECT * FROM login WHERE username =?";
		$stmt = $mysqli->stmt_init();
		
		if(!$stmt->prepare($query)){
			exit();
		}
		
		$stmt->bind_param("s",$_POST['username']);
		$stmt->execute();
		$result = $stmt->get_result();
		$exists = $result->num_rows;
		
		
		If($exists == 0){
			$query = "INSERT INTO login VALUES(?,?)";
			$stmt = $mysqli->stmt_init();
			
			if(!$stmt->prepare($query)){
				exit();
			}
			
			$hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
		
			$stmt->bind_param("ss",$_POST['username'], $hash);
		
			$stmt->execute();
			
			$_SESSION['name'] = $_POST['username'];
			
			header("location:action_page.php");
		}
		else{
			echo "<hr>Username Taken<br>";
			echo "<hr>Please Choose another.<br>";
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	?>
























