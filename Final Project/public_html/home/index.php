<?php include "../core/loginLogic.php"; ?>
<!DOCTYPE html>
<html>
    
    <head>
		<meta charset="UTF-8"> 
		<title>Missouri Rail Home</title>
		<?php include "../core/bootstrapCDN.php"; ?>
        <link rel="stylesheet" href="style.css">
		
		
	</head>

<body>

<?php include "../core/homeNavbar.php"; ?>
<?php if(isset($error)) {
		echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
} ?>

<div class="container-fluid main" id="Home">
	
		
		<div class="left">
				<div class="logo">
					<img src="image.png" width="128">
					<br />
					<h1>Missouri Rail</h1>
				</div>		
				<div id="about">
					<h1>About Us</h3>
					<p>
						Missouri Rail is a startup railroad company based out of Columbia, Missouri. We provide the highest quality and reliabilty to our customers who trust us with their cargo. 
						Our mission is to deviliver your goods on time, everytime. <br>
						We hope you choose Missouri Rail the next time you need freight moved quickly and safely. 
					</p>
				</div>
		</div>

</div>
    
</body>
    
</html>

