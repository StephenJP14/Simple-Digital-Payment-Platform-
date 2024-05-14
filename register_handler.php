<?php
    
    session_start();

    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $current_balance = 0;
    $date = date("Y-m-d H:i:s");
    $role_id = 1;
    echo "Email: $email <br>";
    echo "Password: $password <br>";

    $servername = "localhost:3307";
    $sql_username = "root";
    $sql_password = "";
    $dbname = "c_pay";

    // Create Connection
    $conn = new mysqli($servername, $sql_username, $sql_password, $dbname);

    // Check Connection
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // Check if email already exists
    $stmt = $conn->prepare('SELECT `uid`, `name` FROM `user` WHERE `email` = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        $conn->close();
        echo "Email already exists <br>";
        // sleep(3);
        // header("Location: register.php");
        exit(); // Ensure script stops execution after redirect
    }else{
        // Insert ke DB
        $stmt = $conn->prepare('INSERT INTO `user`(`name`, `phone_number`, `address`, `email`, `password`, `date_joined`, `role_id`, `user_balance`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');
        $stmt->bind_param('ssssssii', $name, $phone_number, $address, $email, $password, $date, $role_id, $current_balance);
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

        header("Location: home_page.php");
        exit(); // Ensure script stops execution after redirect
    }





?>