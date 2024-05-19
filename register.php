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
          <input required type="text" name="phone" id="phone" placeholder="Your Phone Number" />
    
          <label for="email">Email:</label>
          <input required type="email" name="email" id="email" placeholder="you@gmail.com" />
    
          <label for="password">Password:</label>
          <input required type="password" name="password" id="password" placeholder="Create new Password" />
          <label for="password">Confirm password:</label>
          <input required type="password" name="password2" id="password" placeholder="Confirm your Password" />
    
          <label for="tpin">Transaction PIN (6 numbers):</label>
          <input required type="password" name="tpin" id="password" placeholder="Create your Pin" />

          <input type="submit" value="Register Now" id="submit" />
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