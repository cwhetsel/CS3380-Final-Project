<?php 
const ADMINISTRATOR = 'administrator';
const EMPLOYEE = 'employee';
const CUSTOMER = 'customer';
?>

<!DOCTYPE HTML>
<html>
	 <head>
		<meta charset="UTF-8"> 
		<title>View Log</title>
		<?php include "../core/bootstrapCDN.php"; ?>
        <link rel="stylesheet" href="style.css" type='text/css'>
	</head>
<body>
<?php
	session_start();
/* check to see if a user is logged in, if no user, then give customer option to enter company ID */
	if (!isset($_SESSION['id']))
	{
		include "../core/customerNavBar.php"; 
		if(isset($error)) {
			echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
		}
		echo "<div class='container-fluid'>";
		echo '<div class="well">';
		echo '<h1>View Your Action Log</h1>';
		echo '<form action = "viewLog.php" method = "POST">';
		echo '<div class="form-group">';
		echo "Customer, please enter your company ID: " . "<input class='form-control' type = 'text' name = 'companyID'><br>";
	}
	else
	{
		include "../core/employeeNavBar.php"; 
		if(isset($error)) {
			
			echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
		}
		 /* only allows administrators to sort by type of action  */
		echo "<div class='container-fluid'>";
		echo '<div class="well">';
		echo '<h1>View Your Action Log</h1>';
		 echo '<form action = "viewLog.php" method = "POST">';
		 
		echo '<div class="form-group">';
		if (isUserA($_SESSION['id'],ADMINISTRATOR))
		{
			echo "
			Action: <select class='form-control' name = 'actionType'>
			<option value = '1'>Login</option>
			<option value = '2'>Reservations</option>
			<option value = '3'>User Registration</option>
			<option value = '4'>Employee Information Edit</option>
			<option value = '5'>Admin Changed Employee's Information</option>
			<option value = '6'>Train Created</option>
			<option value = '7'>Train Updated</option>
			<option value = '8'>Train Deleted</option>
			<option selected = 'selected' value = '%'>All</option>
			</select>
			<br>";
		}
	}
	/* close html */

?>

<!--<form action = "viewLog.php" method = "POST">-->

			Number of Entries: <select class='form-control' name = "numEntries">
			<option value = "1">1</option>
			<option value = "5">5</option>
			<option value = "10">10</option>
			<option value = "15">15</option>
			<option value = "20">20</option>
			<option selected = "selected" value = "2147483647">All</option> <!-- 2147483647 max int range, as * does not work as a parameter for LIMIT -->
			</select>
			<br>
			Sort by: <select class='form-control' name = "recent">
			<option selected = "selected" value = "DESC">Newest</option>
			<option value = "ASC">Oldest</option>
			</select>
			<br>

		</div>
		<input class="btn btn-danger btn-lg" type = 'submit' name = 'submit' value = 'Submit'><br></form>

		</div>
	</div>
</body>
<?php
if (isset($_POST['submit']))
{	
	/* check to see if a user is logged in */
	if (isset($_SESSION['id']))
	{
		if (is_numeric($_SESSION['id'])) /* to prevent characters other than integers in the query */
		{
			userViewLog($_SESSION['id']);
		}
		else
		{
			echo "<br>Invalid Employee ID";
		}
	}
	else /* a customer wants to view the log */
	{
		
		if(is_numeric($_POST['companyID'])) /* to prevent characters other than integers in the query */
		{
			customerViewLog($_POST['companyID']);
		}
		else
		{
			echo "<br>Invalid Customer ID format";
		}
	}
}
function isUserA($userID, $userType)
{

	switch ($userType)
	{
		case ADMINISTRATOR:
			$query = "SELECT * FROM administrator WHERE id = ?";
			break;


		case EMPLOYEE:
			$query = "SELECT * FROM employee WHERE id = ?";
			break;


		case CUSTOMER:
			$query = "SELECT * FROM customer WHERE id = ?";
			break;

		default:
			return false;
			break;
	}

	/* verify that constants are defined for connection, and avoid redefinition */
	if (!defined("HOST"))
	{
		include('../secure/database.php');
	}

	/* connect to database */
	$conn = new mysqli(HOST, DBNAME, PASSWORD, DBNAME);
	if ($conn->connect_error)
	{
		die("Connection Failed:" . $conn->connect_error . "<br>");
		return;
	}

	if ($stmt = $conn->prepare($query))
	{
		$stmt->bind_param("s", $userID);
		if ($stmt->execute())
		{
			$result = $stmt->get_result();	
			if (mysqli_num_rows($result) == 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			echo $stmt->error;
			return false;
		}
		$stmt->close();
	}

	/* defaults to false if everything fails */
	return false;
}

function userViewLog($userID)
{
	/* this function does not requre any additional parameters, as it takes the userID from the session, and other data for the query from the html form */

	/* check if userID belongs to an employee first */	
	if (isUserA($userID, EMPLOYEE))
	{
		/* employees can be administrtators, but not every employee is an administrator */
		if (isUserA($userID, ADMINISTRATOR))
		{
			$result = queryDatabase($userID, ADMINISTRATOR);
		}
		else /* employee is a conductor or engineer and can only view their own information */
		{
			$result = queryDatabase($userID, EMPLOYEE);
		}
	}
	else /* user is not an employee */
	{
		return;
	}

	printTable($result);
}

function customerViewLog($companyID)
{
	/* VERIFY THAT THE ID BELONGS TO A CUSTOMER */
	if (isUserA($companyID, CUSTOMER))
	{
		$result = queryDatabase($companyID, CUSTOMER);
	}
	else
	{
		echo "<br>No Customer found with entered ID.";
		return;
	}
		printTable($result);
}

function queryDatabase($userID, $userType) /* returns result of query if successful, 0 on error */
{
	/* declare default value for result in case of query failure */
	$result = 0;

	/* verify that constants are defined for connection, and avoid redefinition */
	if (!defined("HOST"))
	{
		include('../secure/database.php');
	}

	/* connect to database */
	$conn = new mysqli(HOST, DBNAME, PASSWORD, DBNAME);
	if ($conn->connect_error)
	{
		die("Connection Failed:" . $conn->connect_error . "<br>");
		return 0;
	}

	switch ($userType)
	{
		case ADMINISTRATOR:
			/* administrators can view the whole log */

			/* CANNOT USE "ORDER BY ?" IN PREPARED STATEMENT */
			$query = "SELECT * FROM log WHERE actionType LIKE ? ORDER BY ocassionTime " . $_POST['recent']. " LIMIT ?";
			if ($stmt = $conn->prepare($query))
			{
				$stmt->bind_param("ss", $_POST['actionType'], $_POST['numEntries']);
				if ($stmt->execute())
				{
					$result = $stmt->get_result();	
				}
				$stmt->close();
			}
			else
			{
				echo "<br>Query failed: " . mysqli_error($conn);
				return 0;
			}
			break;


		case EMPLOYEE: /* fallthrough as employee and customer will have the same query */
		case CUSTOMER:
			/* employees and customers can only view logs related to their ID */

			/* CANNOT USE "ORDER BY ?" IN PREPARED STATEMENT */
			$query = "SELECT * FROM log WHERE id = ? ORDER BY ocassionTime " . $_POST['recent']. " LIMIT ?";
			if ($stmt = $conn->prepare($query))
			{
				$stmt->bind_param("ss", $userID, $_POST['numEntries']);
				if ($stmt->execute())
				{
					$result = $stmt->get_result();	
				}
				$stmt->close();
			}
			else
			{
				echo "<br>Query failed: " . mysqli_error($conn);
				return 0;
			}
			break;

		default:
			return 0;
			break;
	}

	$conn->close();

	return $result;
}

function printTable($result)
{
	echo "<div class='container-fluid'>";
	echo "<div class='well'>";
	if ( (is_int($result) &&  $result == 0) || mysqli_num_rows($result)==0)
	{
		echo "<h1>No logs found for user.</h1>";
		return;
	}
	
	echo "<h1>Results</h1>";
	echo "<TABLE class='table table-responsive table-hover table-striped'>";
	echo "<TR>";
	while ($field = $result->fetch_field())
		echo "<TH>" . $field->name . "</TH>";

	echo "</TR>";
	while ($row = mysqli_fetch_assoc($result))
	{
		echo "<TR>";
		foreach($row as $value)
		{
			echo "<TD>" . $value . "</TD>";
		}
	}
	echo "</TABLE>";
	echo "</div></div>";
}

?>