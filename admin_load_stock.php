<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
    session_start();

    require_once('./db_connect.php');
    $conn = getConnection ();
    $sql = "SELECT * FROM `stock`";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo ("
            <li class='list-group-item'>
            <div class='row'>
                <div class='col-xl-1 col-lg-1'>
                    ".$row["stock_id"]."
                </div>
                <div class='col-xl-3 col-lg-3'>
                    ".$row["stock_item_name"]."
                </div>
                <div class='col-xl-2 col-lg-2'>
                    ".$row["stock_brand_name"]."
                </div>
                <div class='col-xl-2 col-lg-2'>
                    ".$row["stock_supplier_id"]."
                </div>
                <div class='col-xl-1 col-lg-1'>
                    ".$row["stock_man_year"]."
                </div>
                <div class='col-xl-2 col-lg-2'>
                    ".$row["stock_wsp"]."
                </div>
                <div class='col-xl-1 col-lg-1'>
                    ".$row["stock_quantity"]."
                </div>
            </div>
        </li>
            ");
        }
    } else {
        echo "0 results";
    } 
?>