<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
    session_start();

    require_once('./db_connect.php');
    $conn = getConnection ();
    $sql = "INSERT INTO `user` (`user_fname`, `user_lname`, `user_name`, `user_pass`, `user_email`) VALUES (?, ?, ?, ?, ?) ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $fname, $lname, $uname, $pass, $email);
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $uname = $_POST["uname"];
    $pass = $_POST["pass"];

    if ($stmt->execute() === TRUE) {
        echo ("<div class='alert alert-success alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong id='demo'>Success!</strong> Registration successful!</div>");
    } else {
        echo ("<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong id='demo'>Error!</strong> Registration failed!</div>");
    }
?>