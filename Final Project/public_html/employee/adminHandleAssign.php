<?php
    require_once "../core/log.php";
	session_start();
	unset($_SESSION['updateErrors']);

    //check to see if the submit button is set and update equipment table 
    if(isset($_POST['submit'])){
        include "../../dbconfig.php";
        $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
        
        if($mysqli->connect_errno){
            $_SESSION['updateErrors'] = "Failed to connect to database";
            exit();
        }
        
        $query = "UPDATE `equipment` SET `trainNumber`=?, `loadCapacity`=?, `type`=?, `location`=?, `manufacturer`=?, `price`=? WHERE `serialNumber`=?";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            $_SESSION['updateErrors'] = "STMT Failed to prepare";
            exit();
        }
        
        $stmt->bind_param("sssssss", $_POST['trainNumber'], $_POST['loadCapacity'], $_POST['type'], $_POST['location'], $_POST['manufacturer'], $_POST['price'], $_POST['serialNumber']);
        $stmt->execute() or die ($mysqli->error);
        $_SESSION['updateErrors'] = ("Equipment has been updated!");
        //enter into log
        $id = $_SESSION['id'];
        $sNum = $_POST['serialNumber'];
        $description = "Employee #{$id} updated equipment #{$sNum}";
        addLog($id, $description, 9);
		header("Location: ../employee/adminSearchEquipment.php");
    }
?>
