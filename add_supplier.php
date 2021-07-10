<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
    session_start();

    require_once('./db_connect.php');
    $conn = getConnection ();
    $sql = "SELECT sup_email FROM supplier WHERE sup_email = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $supemail);
    $supemail = $_POST["supemail"];
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);
    
    if (($row["sup_email"]) === $supemail) {
        echo ("<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong id='demo'>Error!</strong> Email Exists!</div>");
    }
    else {
        $conn = getConnection ();
        $sql = "SELECT sup_tele FROM supplier WHERE sup_tele = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $suptp);
        $suptp = $_POST["suptp"];
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_assoc($result);

        if (($row["sup_tele"]) === $suptp) {
            echo ("<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong id='demo'>Error!</strong> T.P. Number Exists!</div>");
        }
        else {
            $sql = "INSERT INTO `supplier` (`sup_name`, `sup_address`, `sup_tele`, `sup_email`) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $supname, $supaddr, $suptp, $supemail);
            $supname = $_POST["supname"];
            $supaddr = $_POST["supaddr"];

            if ($stmt->execute() === TRUE) {
                echo ("<div class='alert alert-success alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong id='demo'>Success!</strong> Registration successful!</div>");
            } else {
                echo ("<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong id='demo'>Error!</strong> Registration failed!</div>");
            }
        }
    }
    
?>