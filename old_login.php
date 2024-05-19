<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <?php
    session_start();
    if (session_status() === PHP_SESSION_NONE || !isset($_SESSION['email'])) {
        // if (session_status() === PHP_SESSION_NONE){
        //     echo PHP_SESSION_NONE;
        // }
        echo <<<END
            <form action="./handlers/login_handler.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <input type="submit" value="Login">
            </form>
            <a href="register.php">Don't Have an Account ?</a>
            END;
    } else {
        header("Location: dashboard.php");
        exit();
    }
    ?>
</body>
</html>