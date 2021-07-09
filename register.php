<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
    session_start();

    require_once('./db_connect.php');
    $conn = getConnection ();
    $sql = "SELECT user_email FROM user WHERE user_email = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $email = $_POST["email"];
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);
    
    if (($row["user_email"]) === $email) {
        echo ("<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong id='demo'>Error!</strong> Email Exists!</div>");
    }
    else {
        $conn = getConnection ();
        $sql = "SELECT user_name FROM user WHERE user_name = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $uname);
        $uname = $_POST["uname"];
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_assoc($result);

        if (($row["user_name"]) === $uname) {
            echo ("<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong id='demo'>Error!</strong> Username Exists!</div>");
        }
        else {
            $sql = "INSERT INTO `user` (`user_fname`, `user_lname`, `user_name`, `user_pass`, `user_email`) VALUES (?, ?, ?, ?, ?) ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $fname, $lname, $uname, $pass, $email);
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $pass = $_POST["pass"];

            if ($stmt->execute() === TRUE) {
                echo ("<div class='alert alert-success alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong id='demo'>Success!</strong> Registration successful!</div>");
            } else {
                echo ("<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong id='demo'>Error!</strong> Registration failed!</div>");
            }
        }
    }
?>