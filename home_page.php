


<?php
    session_start();
    if (session_status() === PHP_SESSION_NONE || !isset($_SESSION['email'])) {
        header("Location: login.php");
        exit();
    }


    echo "Welcome to the home page <br>";
    echo $_SESSION['email'];
    echo "<br>";
    echo $_SESSION['uid'];
    echo "<br>";
    echo $_SESSION['name'];
    echo "<br>";

    echo <<<END
        <a href="qr_scan.php">Scan QR Codes</a>
    END;

    echo "<br>";

    echo <<<END
        <a href="login.php">Test Login</a>
    END;

    echo "<br>";

    echo <<<END
        <a href="logout.php">Logout</a>
    END;

?>