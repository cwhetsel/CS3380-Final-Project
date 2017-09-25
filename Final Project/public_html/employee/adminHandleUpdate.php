<?php
    require_once "../core/log.php";
	session_start();
	unset($_SESSION['updateErrors']);
	
    if(isset($_POST['submit'])){
        include "../../dbconfig.php";
        $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
        
        if($mysqli->connect_errno){
            $_SESSION['updateErrors'] = "Failed to connect to database";
			header("Location: ../employee/adminSearchTrain.php");
            exit();
        }
       // $stmt = $mysqli->stmt_init();
        $query = "UPDATE `trains` SET `destination`=?, `startLocation`=?, `days`=?, `departureTime`=?, `arrivalTime`=? WHERE `trainNumber`=?";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            $_SESSION['updateErrors'] = "STMT Failed to prepare";
			header("Location: ../employee/adminSearchTrain.php");
            exit();
        }
        
        $stmt->bind_param("sssiis", $_POST['destination'], $_POST['startLocation`'], $_POST['days'], $_POST['departureTime`'], $_POST['arrivalTime`'], $_POST['trainNumber`']);
        $stmt->execute() or die ($mysqli->error);
        $_SESSION['updateErrors'] = ("Train has been updated!");
        //enter into log
        $id = $_SESSION['id'];
        $trainNum = $_POST['trainNumber'];
        $description = "Employee #{$id} updated Train Number {$trainNum}";
        addLog($id, $description, 7);

		header("Location: ../employee/adminSearchTrain.php");
    }
?>
