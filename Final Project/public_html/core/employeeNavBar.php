<?php
	//displays a nav bar based on if they are a conductor or engineer and a different one if they are an admin
	
	//start a session if one doesnt exist yet
	if (session_status() == PHP_SESSION_NONE) {
			session_start();
	}
	
	$role = $_SESSION['role'];
	//returns 0 when they are the same so admin navbar should be displayed by the else
	if(strcmp("administrator", $role)) {
	?>
		<header>
			<nav class="navbar navbar-inverse" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
					  <a class="navbar-brand">Missouri Rail</a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="../employee/employeeHome.php">Home</a></li>
							<li><a href="../employee/employeeInfo.php">View/Edit Your Info</a></li>
							<li><a href="../core/viewLog.php">Action Log</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a role="button" href="../core/logout.php"><span class="glyphicon glyphicon-log-out" ></span> Logout</a></li>
						</ul>
					</div>
			    </div><!-- /.container-fluid -->
			    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
			    </button>
			</nav>
		</header>
	<?php
	}
	else {
	?>
		<header>
			<nav class="navbar navbar-inverse" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
					  <a class="navbar-brand">Missouri Rail</a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav ">
							<li ><a href="../employee/employeeHome.php">Home</a></li>
							<li><a href="../employee/employeeInfo.php">Your Info</a></li>
							<li><a href="../employee/adminSearchTrain.php">Trains</a></li>
							<li><a href="../employee/adminSearchEquipment.php">Equipment</a></li>
							<li><a href="../employee/adminSearchCondHistory.php">Conductor Assignments</a></li>
							<li><a href="../employee/adminSearchEngHistory.php">Engineer Assignments</a></li>
							<li><a href="../employee/adminEditEmployeeInfo.php">Edit Employee Info</a></li>
							<li><a href="../core/viewLog.php">Action Log</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a role="button" href="../core/logout.php"><span class="glyphicon glyphicon-log-out" ></span> Logout</a></li>
						</ul>
					</div>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div><!-- /.container-fluid -->
			</nav>
		</header>
	<?php
	}
	?>
