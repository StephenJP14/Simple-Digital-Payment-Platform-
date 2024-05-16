<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Register</h1>
    <?php
        if (session_status() === PHP_SESSION_NONE || !isset($_SESSION['email'])) {
            echo <<<END
                <form action="./handlers/register_handler.php" method="post">
                    <input type="text" name="name" placeholder="Name">
                    <input type="text" name="address" placeholder="Address">
                    <input type="text" name="phone" placeholder="Phone">
                    <input type="email" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <input type="password" name="password2" placeholder="Confirm Password">
                    <input type="submit">
                </form>
                <a href="login.php">I Have an Account</a>
                END;
        } else {
            header("Location: login.php");
            exit();
        }
    ?>


</body>
</html>