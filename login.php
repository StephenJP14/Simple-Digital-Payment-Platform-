<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="./styles/login.css" />ini dah bener padahal
  <title>Login</title>
</head>

<body id="login">
  <?php
  session_start();
  if (session_status() !== PHP_SESSION_NONE || isset($_SESSION['email'])) {
    // if (session_status() === PHP_SESSION_NONE){
    //     echo PHP_SESSION_NONE;
    // }
    header("Location: dashboard.php");
    exit();
  }
  ?>
  <nav>
    <a href="index.html">
      <ion-icon name="arrow-back-outline"></ion-icon>
    </a>
    <div class="logo"><span class="green-text">C</span>-Pay Login</div>
  </nav>
  <form action="./handlers/login_handler.php" method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" placeholder="you@gmail.com" />
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" placeholder="..." />
    <input type="submit" value="Login" id="submit" />
    <br />
    <a href="register.html">Dont have an account?</a>
  </form>
  ?>
</body>

</html>