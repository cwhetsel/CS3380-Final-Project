<?php include "../core/loginLogic.php"; ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Select Train and Review information</title>
		<meta charset="UTF-8"> 
		<title>Missouri Rail Home</title>
		<?php include "../core/bootstrapCDN.php"; ?>
        <link rel="stylesheet" href="style.css">
		
	</head>
	
	
	<body>
	
		<?php include "../core/customerNavBar.php"; ?>
		<?php if(isset($error)) {
			echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
		} ?>
		<div class="container-fluid">
			<div class="container center">
				<img src="check.png" alt="Successful!" class="success"></span>
				<p><b> Thank you! <br>Your Order was completed Successfully!</b></p>
			</div>
		</div>
	</body>
</html>


