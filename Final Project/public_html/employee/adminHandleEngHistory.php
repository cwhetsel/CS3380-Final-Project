<?php
    require_once "../core/log.php";
	session_start();
    unset($_SESSION['updateErrors']);

    //check to see if the submit button is clicked and update engineer_history table
     if(isset($_POST['submit'])){
        include "../../dbconfig.php";
        $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
        
        if($mysqli->connect_errno){
            $_SESSION['updateErrors'] = "Failed to connect to database";
            exit();
        }
        
        $query = "UPDATE `engineer_history` SET `startDate`=?, `endDate`=?, `travelTime`=?, `trainNumber`=? WHERE `id`=?";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            $_SESSION['updateErrors'] = "STMT Failed";
            exit();
        }
        
        $stmt->bind_param("sssss", $_POST['startDate'], $_POST['endDate'], $_POST['travelTime'], $_POST['trainNumber'], $_POST['id']);
        $stmt->execute() or die ($mysqli->error);
        $_SESSION['updateErrors'] = "Engineer History has been updated!";
        //enter into log
        $id = $_SESSION['id'];
        $description = "Employee #{$id} updated engineer history";
        addLog($id, $description, 11);
		header("Location: ../employee/adminSearchEngHistory.php");
    }


?>
