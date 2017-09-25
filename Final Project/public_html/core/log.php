

<?php

function addLog($id, $description, $actionType)
{

	/* INSERT INTO log VALUES (DEFAULT, ipAddress, ocassionTime, description, id, actionType) */
	/* all ints except ocassionTime (datetime) and description (varchar) */

	if (!defined("HOST"))
	{
		include('../secure/database.php');
	}

	$conn = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);

	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error . "<br>");
	}
	
	/* GET CLIENT IP ADDRESS */
	$ip = $_SERVER['REMOTE_ADDR'];	

	/* USING CENTRAL TIME ZONE */
	date_default_timezone_set('America/Chicago');

	/* GET TIME AND DATE AND CONVERT TO datetime FORMAT */
	$time = date('Y-m-d H:i:s');

	$stmt = $conn->prepare('INSERT INTO log (logNumber, ipAddress, ocassionTime, description, id, actionType) VALUES (DEFAULT, ?, ?, ?, ?, ?)');
	$stmt->bind_param('sssss',$ip, $time, $description, $id, $actionType );

	if ($stmt->execute())
	{
		echo "<br>" . "update successful!";
	}
	else
	{
		echo $stmt->error;	
	}

	$stmt->close();
	$conn->close();
}

?>
