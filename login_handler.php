<?php 
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];

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

    $sql = "SELECT `uid`, `name` FROM `user` WHERE `email` = '$email' AND `password` = '$password';";
    $result = $conn->query($sql);
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

        header("Location: home_page.php");
        exit(); // Ensure script stops execution after redirect
    }else{
        $conn->close();
        echo "Salahh";
        header("Location: login.php");
        exit(); // Ensure script stops execution after redirect
    }
    
    
?>
