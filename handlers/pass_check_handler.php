<?php
session_start();
// Get the password from the POST parameters
$password = $_POST["password"];
$uid = $_SESSION["uid"];
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

$stmt = $conn->prepare('SELECT `transaction_pin` FROM `transaction` WHERE `uid` = ? ');
$stmt->bind_param('s', $uid);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
    if ($hashed_pin === $result) {
        $conn->close();
        echo "Pin is correct <br>";
        echo "Pin check Handler sucess <br>";
        header("Location: ../dashboard.php");
        exit(); // Ensure script stops execution after redirect
    } else {
        $conn->close();
        echo "Pin is false <br>";
        header("Location: ../dashboard.php");
        exit(); // Ensure script stops execution after redirect
    }
} else {
    // Handle case where no result is found
    $conn->close();
    echo "No transaction pin found <br>";
    header("Location: ../dashboard.php");
    exit(); // Ensure script stops execution after redirect
}

// yang lebih elegan
/*
$password = $_POST["password"];
$uid = $_SESSION["uid"];

$servername = "localhost:3306";
$sql_username = "stephen";
$sql_password = "o8ivx1(EzV(I-9M4M7";
$dbname = "stephen_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$stmt = $conn->prepare('SELECT `transaction_pin` FROM `transaction` WHERE `uid` = ? ');
$stmt->bind_param('s', $uid);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
    if (password_verify($password, $result)) {
        $conn->close();
        echo "Pin is correct <br>";
        echo "Pin check Handler sucess <br>";
        header("Location: ../dashboard.php");
        exit(); 
    } else {
        $conn->close();
        echo "Pin is false <br>";
        header("Location: ../login.php?result=false");
        exit();

    }
} else {
    $conn->close();
    echo "No transaction pin found <br>";
    header("Location: ../login.php?result=false");
    exit(); 
}
*/