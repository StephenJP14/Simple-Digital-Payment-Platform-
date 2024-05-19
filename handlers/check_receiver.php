<?php 

    session_start();

    $receiver = $_POST['receiver'];

    $servername = "localhost:3306";
    $sql_username = "stephen";
    $sql_password = "o8ivx1(EzV(I-9M4M7";
    $dbname = "stephen_db";

    $conn = new mysqli($servername, $sql_username, $sql_password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed" . $conn->connect_error);
    }

    $stmt = $conn->prepare('SELECT `uid` , `name` FROM  `user` WHERE `phone_number` = ?');
    $stmt->bind_param('s', $receiver);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $result = $result->fetch_assoc();
        echo json_encode($result);
    } else {
        echo "Receiver not found";
    }
    $conn->close();
    exit();
?>