<?php
    require_once "../core/log.php";
	session_start();
	unset($_SESSION['updateErrors']);
	
    if(isset($_POST['delete'])){
        include "../../dbconfig.php";
        $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
        
        if($mysqli->connect_errno){
            $_SESSION['updateErrors'] = "Failed to connect to database";
            exit();
        }
		
		
		//DELETE the records from conductor history so we can delete the train because of FK constraints
        $query = "DELETE from conductor_history where trainNumber = ?";
		$stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            $_SESSION['updateErrors']= "Stmt Failed to prepare";
            exit();
        }
        $stmt->bind_param("s", $_POST['trainNumber']);
        $stmt->execute() or die ($mysqli->error);
		
		//DELETE the records from engineer history so we can delete the train because of FK constraints
        $query = "DELETE from engineer_history where trainNumber = ?";
		$stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            $_SESSION['updateErrors']= "Stmt Failed to prepare";
            exit();
        }
        $stmt->bind_param("s", $_POST['trainNumber']);
        $stmt->execute() or die ($mysqli->error);
		
		
		//delete the train
        $query = "DELETE FROM `trains` WHERE `trainNumber`=?";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            $_SESSION['updateErrors']= "Stmt Failed to prepare";
            exit();
        }
        $stmt->bind_param("s", $_POST['trainNumber']);
        $stmt->execute() or die ($mysqli->error);
        
        $_SESSION['updateErrors'] = "Delete Successful!";
        //enter into log
        $id = $_SESSION['id'];
        $trainNum = $_POST['trainNumber'];
        $description = "Employee #{$id} deleted train number {$trainNum}";
        addLog($id, $description, 8);
		header("Location: ../employee/adminSearchTrain.php");
    }

?>
