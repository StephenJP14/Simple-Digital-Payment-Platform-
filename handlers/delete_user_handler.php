<?php

session_start();

$uid = $_SESSION['uid'];

$servername = "localhost:3306";
$sql_username = "stephen";
$sql_password = "o8ivx1(EzV(I-9M4M7";
$dbname = "stephen_db";

$conn = new mysqli($servername, $sql_username, $sql_password, $dbname);

if ($conn->connect_error) {
  die("Connection failed" . $conn->connect_error);
}

$stmt = $conn->prepare('DELETE FROM users WHERE uid = ?');
echo $uid;
// $stmt->bind_param('i', $uid);
// $stmt->execute();
// $stmt->close();

// $conn->close();

// header('Location: ../logout.php');
exit();


?>