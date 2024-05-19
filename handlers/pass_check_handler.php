<?php
session_start();
// Get the password from the POST parameters
$password = $_POST["password"];
$hashed_transaction_pin = hash('sha256', $password);

$servername = "localhost:3306";
$sql_username = "stephen";
$sql_password = "o8ivx1(EzV(I-9M4M7";
$dbname = "stephen_db";
// Here you can perform any necessary validation or processing with the password

// For demonstration purposes, let's just echo a confirmation message
// echo "Password received: " . $password;
echo true;
