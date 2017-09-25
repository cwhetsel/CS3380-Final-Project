<?php
function executeQuery($sql){
    /* Include credentials file.
     * It is essential to place this file outside of 
     * the web directory so users cannot access it.
     */ 
    include "../../dbconfig.php";
    $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
    if ($mysqli->connect_errno) { //Terminate script if there is a connection error
        echo "Failed to connect to MySQLI on Line 5";
        exit();
    }
    $result = $mysqli->query($sql); //Execute query
    echo "<table class='table table-hover table-responsive'>"; 
//    echo "Number of Results: " . $result->num_rows; //Display number of results
    // Collect column names in a while loop and place mark them as headers in out table
    while($fieldInfo = mysqli_fetch_field($result)){
        echo "<th>". $fieldInfo->name. "</th>";
    } 
    echo "</thead>";
    while($row = $result->fetch_array(MYSQLI_NUM)){ //Fetch the results as a numeric array
        echo "<tr>"; //Each element of the array is a row
        /*
         * Each row's data is stored in an array
         * Iterate that array and place each value
         * into the table
         */
        foreach($row as $r){
            echo "<td>" . $r . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    $mysqli->close(); //Close mysql connection
}
?>
