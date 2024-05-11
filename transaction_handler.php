<?php

    // session_start();

    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $nominal = $_POST['nominal'];
    $password = $_POST['password'];

    echo "Sender: $sender <br>";
    echo "Receiver: $receiver <br>";
    echo "Nominal: $nominal <br>";
    echo "Password: $password <br>";

    echo "Transaction Handler Test Success<br>";

?>