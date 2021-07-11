<?php
#Headers for accept requests from remote origin
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
session_start();

require_once('./db_connect.php');
    $conn = getConnection ();

    #This script returns supplier names to front-end when there is an Ajax request
    $sql = "SELECT sup_id, sup_name FROM `supplier`";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo ("
            <option value=".$row["sup_id"].">".$row["sup_name"]."</option>
            ");
        }
    } else {
        echo "0 results";
    } 
?>
