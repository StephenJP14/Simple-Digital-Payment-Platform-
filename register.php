<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="./styles/login.css" />
  <title>Register</title>
</head>

<body>
  <?php
  if (session_status() === PHP_SESSION_NONE || !isset($_SESSION['email'])) {
    echo <<<END
        <nav>
          <a href="index.html">
            <ion-icon name="arrow-back-outline"></ion-icon>
          </a>
          <div class="logo"><span class="green-text">C</span>-Pay Register</div>
        </nav>
        <form action="./handlers/register_handler.php" method="POST">
          <label for="name">Name:</label>
          <input type="text" name="name" id="name" placeholder="Your name" />
    
          <label for="address">Address:</label>
          <input
            type="text"
            name="address"
            id="address"
            placeholder="Your address"
          />
    
          <label for="phone">Phone:</label>
          <input type="text" name="phone" id="phone" placeholder="you@gmail.com" />
    
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" placeholder="you@gmail.com" />
    
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" placeholder="..." />
          <label for="password">Confirm password:</label>
          <input type="password" name="password2" id="password" placeholder="..." />
    
          <label for="tpin">Transaction PIN:</label>
          <input type="password" name="tpin" id="password" placeholder="..." />

          <input type="submit" value="Register" id="submit" />
          <br />
          <a href="login.php">Already have an account?</a>
        </form>
      END;
  } else {
    header("Location: login.php");
    exit();
  }
  ?>
</body>

</html>