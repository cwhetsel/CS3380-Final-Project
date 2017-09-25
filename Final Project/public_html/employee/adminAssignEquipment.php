<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8"> 
		<?php include "../core/bootstrapCDN.php"; ?>
        <link rel="stylesheet" href="../core/style.css">
        <title>Assign to Train</title>
    </head>
    <body>
	<?php
	
		$error = empty($_SESSION['updateErrors']) ? '' : $_SESSION['updateErrors'];
		unset($_SESSION['updateErrors']);
		include_once "../core/employeeNavBar.php"; 
		if(!empty($error)) {
				echo "<div class='container-fluid' id='error'><h3>{$error}</h3></div>";
		} 
	?>
		<div class="container-fluid">
			<div class="well">
        <a href="http://cs3380.rnet.missouri.edu/~GROUP1/employee/adminSearchEquipment.php">Search Equipment</a>
        <hr>
        
        <?php
        
            if(isset($_POST['assign'])){
                $serialNumber = $_POST['serialNumber'];
                include "../../dbconfig.php";
                $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
                
                if($mysqli->connect_errno){
                    echo "Failed to connect to database.";
                    exit();
                }
                
                $sql = "SELECT * FROM `equipment` WHERE `serialNumber` =  '$serialNumber'";
                $result = $mysqli->query($sql) or die ($mysqli->error);
                $row = $result->fetch_array(MYSQLI_NUM) or die ($mysqli->error);
        ?>
        <form class="form-group" action="adminHandleAssign.php" method="POST">
            Serial Number: <br>
            <input class="form-control" type="text" readonly name="serialNumber" value="<?= $row[0] ?>">
            <br>
            Load Capacity: <br>
            <input class="form-control"type="text" name="loadCapacity" value="<?= $row[1]?>">
            <br>
            Type: <br>
            <input class="form-control" type="text" name="type" value="<?= $row[2]?>">
            <br>
            Location: <br>
            <input class="form-control" type="text" name="location" value="<?= $row[3]?>">
            <br>
            Manufacurer: <br>
            <input class="form-control" type="text" name="manufacturer" value="<?= $row[4]?>">
            <br>
            Price: <br>
            <input class="form-control" type="text" name="price" value="<?= $row[5]?>">
            <br>
            Id: <br>
            <input class="form-control" type="text" name="id" value="<?= $row[7]?>">
            <br>
            Train Number: <br>
            <input class="form-control" type="text" name="trainNumber" value="<?= $row[6]?>">
            <br><br>
            <input type="submit" name="submit" value="Update">
        <?php
            }  
        ?>
        </form>
		</div>
		</div>
    </body>
</html>