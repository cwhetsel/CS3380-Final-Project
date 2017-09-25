<!DOCTYPE html>
<?php
	session_start();
	include "../../dbconfig.php";
	$mysqli = new mysqli($HOST, $USER, $PASS, $DB);
	if($mysqli->connect_errno){
		echo "Connection failed on line 5";
		exit();
	}
	
	if(isset($_SESSION['name'])){
		echo "<br><strong>Welcome " . $_SESSION['name'] . "!</strong><br>";
	}
	else{
		echo "Session not created yet<br>";
		header("location:front_page.php");
	}
?>

<head>
  <title>Action Page</title>
</head>

<body>
<br><br><br>

	<input type="submit" name="info" value="Select Module">
</form>



<form action="front_page.php" method=POST>
  Logout:<br>
  <input type="submit" name="Logout">
  <br>
</form>


<?php
session_destroy();
?>



