<?php
    require_once "../core/checkLogin.php";
    checkLogin();

    if(strcmp($_SESSION['role'], "administrator") !== 0){
        //if they are not an admin then redirect to index
        header("Location: ../index.php");
    }

?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8"> 
		<?php include "../core/bootstrapCDN.php"; ?>
        <link rel="stylesheet" href="../core/style.css">
        <title>Search Train</title>
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
				<br>
				<a href="../employee/adminInsertTrain.php">Add Train</a>
				<hr>
			
				<form class="form-group" action="" method="POST">
					Search:
					<input class="form-control" type="text" name="search">
					<br><br>
					<input type="radio" name="criteria" value="0" checked="check"> Train Number
					<input type="radio" name="criteria" value="1">
					Destination
					<input type="radio" name="criteria" value="2">
					Start Location
					<br><br>
					<input class="btn btn-lg btn-danger" type="submit" name="submit" value="Search">
				</form>
			</div>
        </div>
        
        <?php
           
                
                if(isset($_POST['submit'])){
                    include "../../dbconfig.php";
                    $mysqli = new mysqli($HOST, $USER, $PASS, $DB); //connect to database
                    
                    if($mysqli->connect_errno){
                        $_SESSION['updateErrors'] = "Failed to connect to database";
                        exit();
                    } //error checking 

                    //sql statement generated based on search criteria
                    if($_POST['criteria'] == 0){
                        $sql = "SELECT * FROM `trains` WHERE `trainNumber` LIKE ?";
                        $stmt = $mysqli->stmt_init();
                        if(!$stmt->prepare($sql)){
                            $_SESSION['updateErrors'] = "prepare failed";
                            exit();
                        }
                        $trainNumber = htmlspecialchars($_POST['search']) . "%";
                        $stmt->bind_param("s", $trainNumber);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    }
                    else if($_POST['criteria'] == 1){
                        $sql = "SELECT * FROM `trains` WHERE `destination` LIKE ?";
                        $stmt = $mysqli->stmt_init();
                        if(!$stmt->prepare($sql)){
                            $_SESSION['updateErrors'] = "prepare failed";
                            exit();
                        }
                        
                        $destination = htmlspecialchars($_POST['search']) . "%";
                        $stmt->bind_param("s", $destination);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    }
                    else if ($_POST['criteria'] == 2){
                    $sql = "SELECT * FROM `trains` WHERE `startLocation` LIKE ?";
                    $stmt = $mysqli->stmt_init();
                    if(!$stmt->prepare($sql)){
                        $_SESSION['updateErrors'] = "prepare failed";
                        exit();
                    }
                    
                    $startLocation = htmlspecialchars($_POST['search']) . "%";
                    $stmt->bind_param("s", $startLocation);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    }
                    
					echo "<div class='container-fluid'><div class='well'><h1>Results</h1><table class='table table-responsive table-hover'>";
                    //echo "Number of results: " . $result->num_rows; //Display Number of results

                    //dynamically populate table with columns from trains table
                    while($fieldInfo = mysqli_fetch_field($result)){
                        echo "<th>" . $fieldInfo->name . "</th>";
                    }
                    
                    while($row = $result->fetch_array(MYSQLI_NUM)){
                        echo "<tr>";
                        foreach($row as $r){
                            echo "<td>" . $r . "</td>";
                        }
                        ?>
                        <td>
                            <form action="adminDeleteTrain.php" method="POST">
                                <input type="hidden" name="trainNumber" value="<?= $row[0]?>">
                                <input class="btn btn-md btn-danger" type="submit" name="delete" value="Delete Train">
                            </form>
                        </td>
                        <td>
                            <form action="adminUpdateTrain.php" method="POST">
                                <input type="hidden" name="trainNumber" value="<?= $row[0]?>">
                                <input class="btn btn-md btn-danger" type="submit" name="update" value="Update Train">
                            </form>
                        </td>
                    <?php
                        echo "</tr>";
                    }
                    echo "</table></div></div>";
                    $mysqli->close(); //close mysql connection
                }   
        ?>
    </body>
</html>
