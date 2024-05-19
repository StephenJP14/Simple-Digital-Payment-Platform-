<?php

session_start();


$name = $_POST['name'];
$address = $_POST['address'];
$phone_number = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$transaction_pin = $_POST['tpin'];
$current_balance = 0;
$date = date("Y-m-d H:i:s");
$role_id = 1;
echo "Email: $email <br>";
echo "Password: $password <br>";

$servername = "localhost:3306";
$sql_username = "stephen";
$sql_password = "o8ivx1(EzV(I-9M4M7";
$dbname = "stephen_db";

// Create Connection
$conn = new mysqli($servername, $sql_username, $sql_password, $dbname);

// Check Connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Check if email already exists
$stmt = $conn->prepare('SELECT `uid`, `name` FROM `user` WHERE `email` = ? OR `phone_number` = ?');
$stmt->bind_param('ss', $email, $phone_number);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
    $conn->close();
    echo "Email or Phone Number already exists <br>";
    header("refresh:3;url=../register.php");
    // sleep(3);
    // header("Location: register.php");
    exit(); // Ensure script stops execution after redirect
} else {
    // Hash Password
    $hashed_password = hash('sha256', $password);
    $hashed_transaction_pin = hash('sha256', $transaction_pin);
    // Insert ke DB
    $stmt = $conn->prepare('INSERT INTO `user`(`name`, `phone_number`, `address`, `email`, `password`, `date_joined`, `role_id`, `user_balance`, `transaction_pin`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);');
    $stmt->bind_param('ssssssiis', $name, $phone_number, $address, $email, $hashed_password, $date, $role_id, $current_balance, $hashed_transaction_pin);
    $_SESSION['email'] = $email;
    $stmt->execute();
    $stmt->close();

    // Get UID
    $stmt = $conn->prepare('SELECT `uid`, `name` FROM `user` WHERE `email` = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $row = $result->fetch_assoc();
    $_SESSION['uid'] = $row['uid'];
    $_SESSION['name'] = $row['name'];

    $conn->close();

    echo $_SESSION['uid'] . "<br>";
    echo $_SESSION['name'];

    header("Location: ../dashboard.php");
    exit(); // Ensure script stops execution after redirect
}
