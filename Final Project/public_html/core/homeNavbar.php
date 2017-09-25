<header>
	<nav class="navbar navbar-fixed-top navbar-inverse">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand">Missouri Rail</a>
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><a href="#Home">Home</a></li>
			<li><a href="#about">About</a></li>
			<li><a href="../customer/customerbrowse.php"> Trains</a></li>
			<li><a href="../core/viewLog.php">Reservations</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a role="button" data-toggle="collapse" data-target="#loginRegisterToggle,#loginToggle"><span class="glyphicon glyphicon-log-in" ></span> Login</a></li>
		</ul>
	  </div><!-- /.container-fluid -->
	</nav>
</header>

<div class="collapse contaienr" id="loginRegisterToggle">
			<!-- Login -->
			<div  class="collapse container" id="loginToggle">
				<div class="container">
					<h3><b>Login</b></h3>
					<div class="container login">
						<form action="" method="POST">
							<label>Username</label><br>
							<input class="black" type="text" placeholder="Enter Username" name="username" required>
							<br>
							<label>Password</label><br>
							<input class="black" type="password" placeholder="Enter Password" name="pass" required>
							<br>
							<br>
							<br>
							<button class="btn btn-danger btn-lg" type="submit" name="login" value="login">Login</button> &nbsp

							<button class="btn btn-danger btn-lg" data-toggle="collapse" data-target="#loginToggle,#registerToggle" name="registerTog" >Register</button>

						</form>
					</div>
				</div>
			</div>
			
			<!-- Register -->
			<div  class="collapse container" id="registerToggle">
				<div class="container">
					<h3><b>REGISTER</b></h3>
					<div class="container register">
						<form action="" method="POST">
							<label>Username</label><br>
							<input class="black" type="text" placeholder="Enter Username" name="username" required>
							<br>
							<label>Password</label><br>
							<input class="black" type="password" placeholder="Enter Password" name="pass" required>
							<br>
							<label>Repeat Password</label><br>
							<input class="black" type="password" placeholder="Repeat Password" name="pass2" required>
							<br>
							<label>Employee Number</label><br>
							<input class="black" type="text" placeholder="Employee Number" name="id" required>
							<br>
							<br>
							<br>

							<button class="btn btn-danger btn-lg" type="submit" name="register" >Register</button>
							<button class="btn btn-danger btn-lg" data-toggle="collapse" data-target="#loginToggle,#registerToggle" name="registerTog" >Cancel</button>
						</form>
					</div>
				</div>
			</div>
		</div>
