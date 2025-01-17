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

    $stmt = $conn->prepare('SELECT `user_balance` FROM  `user` WHERE `uid` = ?');
    $stmt->bind_param('i', $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $balance = $result->fetch_assoc()['user_balance'];

    $stmt = $conn->prepare('SELECT `sender_id`, `sender_merchant_id` ,`receiver_id` ,`t_date`, `amount`, `t_info` FROM `transaction` WHERE `sender_id` = ? or `receiver_id` = ? ORDER BY `t_date` DESC');
    $stmt->bind_param('ii', $uid, $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $transactions = $result->fetch_all(MYSQLI_ASSOC);
    $all_transactions = [];  
    foreach($transactions as $row){
        // echo json_encode($transaction);
        if ($row['sender_id'] === $uid) {
            $row['amount'] = -$row['amount'];
        }
        if ($row['sender_id'] === null) {
            $stmt = $conn->prepare('SELECT `merchant_name` FROM `merchant` WHERE `merchant_id` = ?');
            $stmt->bind_param('i', $row['sender_merchant_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $row['sender_id'] = $result->fetch_assoc()['merchant_name'];
        }
        $all_transactions[] = $row;
    }
    
    $conn->close();

    echo json_encode([$balance, $all_transactions]);
   
    exit();

?>