<?php 
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];

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

    $stmt = $conn->prepare('SELECT `uid`, `name` FROM `user` WHERE `email` = ? AND `password` = ?');
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['uid'] = $row['uid'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $email;
        $uid = $_SESSION['uid'];
        $name = $_SESSION['name'];
        $conn->close();

        echo "Welcome $name <br>";
        echo "Your UID is $uid <br>";

        header("Location: ../dashboard.php");
        exit(); // Ensure script stops execution after redirect
    }else{
        $conn->close();
        echo "Salahh";
        header("Location: ../login.php");
        exit(); // Ensure script stops execution after redirect
    }
    
    
?>
