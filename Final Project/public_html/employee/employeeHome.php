<?php 
	//check to see the user logged in
	require_once "../core/checkLogin.php";
	checkLogin(); 
	?>
<!DOCTYPE html>
<html>
    
    <head>
		
		<meta charset="UTF-8"> 
		<?php include "../core/bootstrapCDN.php"; ?>
        <link rel="stylesheet" href="../core/style.css">
		<title>Missouri Rail Home</title>
		
	</head>

	<body>

		<?php 
		//display any errors
		include "../core/employeeNavBar.php"; 
		$error = empty($_SESSION['updateErrors']) ? '' : $_SESSION['updateErrors'];
		unset($_SESSION['updateErrors']);
		if(!empty($error)) {
				echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
		} 
		
		?>
		<!-- display the user's username -->
		<div class="container-fluid main">
			<div class="well">
				<h1>Welcome Back <?php echo "{$_SESSION['username']}" ?>.<h1>
			</div>
		</div>
	</body>
</html>