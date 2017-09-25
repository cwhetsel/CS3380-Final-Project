<?php
    require_once "../core/log.php";
	session_start();
	unset($_SESSION['updateErrors']);

    //check to see if the submit button is set and update conductor_history table in the database 
    if(isset($_POST['submit'])){
        include "../../dbconfig.php";
        $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
        
        if($mysqli->connect_errno){
            $_SESSION['updateErrors'] = "Failed to connect to database";
            exit();
        }
        
		$query = "UPDATE `conductor_history` SET `startDate`=?, `endDate`=?,`trainNumber`=? WHERE `id`=?";       
		$stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            $_SESSION['updateErrors'] = "STMT Failed to prepare";
            exit();
        }
        
        $stmt->bind_param("ssss", $_POST['startDate'], $_POST['endDate'], $_POST['trainNumber'], $_POST['id']);
        $stmt->execute() or die ($mysqli->error);
        $_SESSION['updateErrors'] = ("Conductor History has been updated!");
        //enter into log
        $id = $_SESSION['id'];
        //$cid = $_POST['id'];
        $description = "Employee #{$id} updated conductor  history";
        addLog($id, $description, 10);
		header("Location: ../employee/adminSearchCondHistory.php");
    }
?>
