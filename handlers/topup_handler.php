<?php
session_start();
$merchant = $_POST['merchant'];
$receiver = $_SESSION['uid'];
$amount = $_POST['nominal'];

echo "Merchant: $merchant <br>";
echo "Receiver: $receiver <br>";

$servername = "localhost:3306";
$sql_username = "stephen";
$sql_password = "o8ivx1(EzV(I-9M4M7";
$dbname = "stephen_db";

$conn = new mysqli($servername, $sql_username, $sql_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}



$note = "Top up";
$date = date("Y-m-d H:i:s");


$stmt = $conn->prepare('INSERT INTO `transaction` (`sender_merchant_id`, `receiver_id`,`t_date` ,`amount`, `t_info`) VALUES (?,?,?,?,?); ');
$stmt->bind_param('iisss', $merchant, $receiver, $date, $amount, $note);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
echo "Top Up Handler Test Success<br>";
header("refresh:3;url=../dashboard.php");
$conn->close();
?>