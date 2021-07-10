<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
    session_start();

    require_once('./db_connect.php');

    $conn = getConnection ();
    $sql = "SELECT stock_id,stock_item_name,stock_brand_name,supplier.sup_name,stock_man_year,stock_wsp,stock_quantity FROM `stock` LEFT JOIN supplier ON stock.stock_supplier_id = supplier.sup_id WHERE CONCAT_WS('', stock_item_name, stock_brand_name, supplier.sup_name) LIKE '%?%'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $searchKey);
    $searchKey = $_POST["searchKey"];
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
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
                    ".$row["sup_name"]."
                </div>
                <div class='col-xl-1 col-lg-1'>
                    ".$row["stock_man_year"]."
                </div>
                <div class='col-xl-2 col-lg-2'>
                    ".$row["stock_wsp"].".00
                </div>
                <div class='col-xl-1 col-lg-1'>
                    ".$row["stock_quantity"]."
                </div>
            </div>
        </li>
            ");
        }
    }
    else {
        echo("0 Results");
    }


?>