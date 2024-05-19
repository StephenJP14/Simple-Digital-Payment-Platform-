<?php
session_start();
// Get the password from the POST parameters
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


$hashed_password = hash('sha256', $password);

$stmt = $conn->prepare('SELECT `t_p[` FROM `user` WHERE `email` = ? AND `password` = ?');
$stmt->bind_param('ss', $email, $hashed_password);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
