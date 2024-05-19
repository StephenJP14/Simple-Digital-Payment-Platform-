<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="./styles/login.css" />
  <title>Login</title>
</head>

<body id="login">
  <?php
  session_start();
  if (session_status() === PHP_SESSION_NONE || !isset($_SESSION['email'])) {
    if (isset($_GET['result'])) {
      if ($_GET['result'] === 'false') {
        echo "<script type='text/jscript'>alert('Check Your Email and Password!!.')</script>";
      }
    }
    echo <<<END
        <nav>
          <a href="index.html">
            <ion-icon name="arrow-back-outline"></ion-icon>
          </a>
          <div class="logo"><span class="green-text">C</span>-Pay Login</div>
        </nav>
        <form action="./handlers/login_handler.php" method="POST">
          <label for="email">Email:</label>
          <input required type="email" name="email" id="email" placeholder="you@gmail.com" />
          <label for="password">Password:</label>
          <input required type="password" name="password" id="password" placeholder="..." />
          <input type="submit" value="Login" id="submit"/>
          <br />
          <a href="register.php">Dont have an account?</a>
        </form>
      END;
  } else {
    header("Location: dashboard.php");
    exit();
  }
  ?>
</body>

</html>