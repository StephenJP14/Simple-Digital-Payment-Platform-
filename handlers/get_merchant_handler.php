<?php
session_start();

$servername = "localhost:3306";
$sql_username = "stephen";
$sql_password = "o8ivx1(EzV(I-9M4M7";
$dbname = "stephen_db";

$conn = new mysqli($servername, $sql_username, $sql_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed " . $conn->connect_error);
}

$stmt = $conn->prepare('SELECT `merchant_name` FROM `merchant` WHERE 1 ');
$stmt->execute();
$result = $stmt->get_result();
$merchants = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close(); 
$conn->close();
echo json_encode($merchants);
echo "Get Merchant Handler Test Success<br>";

?>-