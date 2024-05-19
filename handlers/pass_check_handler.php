<?php
session_start();
// Get the password from the POST parameters
$uid = $_SESSION["uid"];
$password = $_POST["password"];
$hashed_transaction_pin = hash('sha256', $password);

$servername = "localhost:3306";
$sql_username = "stephen";
$sql_password = "o8ivx1(EzV(I-9M4M7";
$dbname = "stephen_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$hashed_pin = hash('sha256', $password);

$stmt = $conn->prepare('SELECT `name` FROM `user` WHERE `uid` = ? AND `password` = ?');
$stmt->bind_param('s', $uid, $hashed_pin);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
        $conn->close();
        echo json_encode(true);
        exit(); // Ensure script stops execution after redirect
} else {
        $conn->close();
        echo json_encode(false);
        exit(); // Ensure script stops execution after redirect
}
?>