<?php
session_start();
?>
<!DOCTYPE html>
<style>
form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 30%;
    border-radius: 50%;
}

.container {
    padding: 0px;
}

span.psw {
    float: right;
    padding-top: 16px;
    padding-bottom: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
}
</style>
<body>

<form action="" method="POST">
  <div class="imgcontainer">
    <img src="emberwakecircuitblue.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pass" required>
        
    <button type="submit" name ="loginPage">Login</button>
    
  </div>

</form>

<form action="account_page.php" method="POST">
	<div class="container">
		<button type="submit" name="createAccount">Create Customer Account</button>
	</div>
</form>

<form action="employee_page.php" method="POST">
	<div class="container">
		<button type="submit" name="createEmployee">Create Employee Account</button>
	</div>
</body>
		
<?php
include "../../dbconfig.php";
    
$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
if($mysqli->connect_errno){
	echo "Connection failed on line 5";
	exit();
}
	
if(isset($_POST['loginPage'])){
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
		echo "<hr>Create A User Below!<br>";
	}
	else{
		$hash = $result->fetch_assoc();
			
		if(password_verify($_POST['pass'], $hash['pass'])){
				
		$_SESSION['name'] = $_POST['username'];
		#$_SESSION['ID'] = result.id;
		#$_SESSION['ROLE'] = result.role;
			
		header("location:action_page.php");
		}
		else{
			echo "Password Incorrect!";
		}
	}
}
?>
