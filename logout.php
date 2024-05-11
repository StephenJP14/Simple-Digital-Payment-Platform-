<?php 
    session_start();
    session_unset();
    session_destroy();
    if (isset($_SESSION['email'])){
        echo "Session is not destroyed";
    }
    else{
        echo "Session is destroyed";
        header("Location: login.php");
        exit();
    }


?>
