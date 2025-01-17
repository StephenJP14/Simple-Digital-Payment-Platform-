<?php
session_start();
$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$nominal = $_POST['nominal'];
$password = $_POST['password'];



$servername = "localhost:3306";
$sql_username = "stephen";
$sql_password = "o8ivx1(EzV(I-9M4M7";
$dbname = "stephen_db";

$conn = new mysqli($servername, $sql_username, $sql_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}

$stmt = $conn->prepare('SELECT `user_balance` FROM  `user` WHERE `uid` = ?');
$stmt->bind_param('i', $sender);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$balance = $result->fetch_assoc()['user_balance'];  

$note = "Transfer";
$date = date('Y-m-d H:i:s');

if ($balance < $nominal){
    echo "Transaction Failed, Your balance is not sufficient";
    header("refresh:3;url=../dashboard.php");
    exit();
}else{
    $stmt = $conn->prepare('INSERT INTO `transaction` (`sender_id`, `receiver_id`,`t_date` ,`amount`, `t_info`) VALUES (?,?,?,?,?); ');
    $stmt->bind_param('iisss', $sender, $receiver, $date, $nominal, $note);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
}

echo "Transaction Handler Test Success<br>";
echo "Successfully Sent to : $receiver for: $nominal <br>";
header("Location: ../success.html");
exit();
?>