<?php 
include("../secure/database.php");
//include("../core/log.php");
//echo "test1";
$link = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME) or die("Connect
Error ".mysqli_error($link));
	if (isset($_POST['confirm'])){
		//echo 'test2';
		//echo $_POST['custId'];
		if (isset($_POST['custID'])){
			$sql = "SELECT * FROM users WHERE id = ?";
			//echo $_POST['custID'];
			if ($stmt = $link->prepare($sql)){
			$stmt->bind_param("s", $_POST['custID']);
			$stmt->execute();
			$result = $stmt->get_result();
			$num_rows = mysqli_num_rows($result);
			//echo num_rows;
			$stmt->close();
			if ($num_rows == 0){
				$error = "Invalid Customer ID. Please enter the correct customer ID";
				header("Location: customerbrowse.php");
			} else {
				$carQuantity = $_POST['number'];
				addLog($_POST['custID'], "Customer number " . $_POST['custID'] . " reserved " . $carQuantity . " cars for a total of $" . $_POST['priceTotal'], $link);
				$sql = "SELECT serialNumber FROM equipment WHERE id IS NULL AND type = '" . $_POST['type'] . "' AND location = '" . $_POST['location'] . "'";
				if ($result = mysqli_query($link, $sql)){
					for ($i = 1; $i <= $carQuantity; $i++){
					$row = mysqli_fetch_array($result, MYSQLI_NUM);
						$sqlStmt = "UPDATE equipment SET id = ? WHERE serialNumber = '" . $row[0] . "'";
						//echo $sqlStmt;
						if ($stmt = $link->prepare($sqlStmt)){
							$stmt->bind_param("s", $_POST['custID']);
							$stmt->execute();
							$stmt->close();
							}
						$str = "Customer number " . $_POST['custID'] . "
                        reserved car no. " . $row[0] . " in the city of " .
                        $_POST['location'];
						addLog($_POST['custID'],  $str, $link);
						
					}
				}
				header("Location: orderSuccess.php");
			}
		}
	}
	}
function addLog($id, $description, $link)
{

	//INSERT INTO log VALUES (DEFAULT, ipAddress, ocassionTime, description, id, actionType)

	//$conn = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);

	//
	
	/* GET CLIENT IP ADDRESS, NO REAL NEED TO CHECK FOR PROXY*/
	$ip = $_SERVER['REMOTE_ADDR'];

	/* USING CENTRAL TIME ZONE */
	date_default_timezone_set('America/Chicago');

	/* GET TIME AND DATE AND CONVERT TO datetime FORMAT */
	$time = date('Y-m-d H:i:s');

	$stmt = $link->prepare('INSERT INTO log (logNumber, ipAddress, ocassionTime, description, id, actionType) VALUES (DEFAULT, ?, ?, ?, ?, 2)');
	$stmt->bind_param('ssss',$ip, $time, $description, $id);
	$stmt->execute();
		//echo "<br>" . "update successful!";
	//else
		//echo $stmt->error;	*/

	$stmt->close();
}
?>
							
