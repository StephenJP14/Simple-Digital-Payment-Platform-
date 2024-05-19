<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./styles/dashboard.css">
  <title>Dashboard</title>
</head>

<body>
  <?php
  session_start();
  if (session_status() === PHP_SESSION_NONE || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
  }
  ?>
  <header class="linear-background">
    <div class="container">
      <nav>
        <a class="logo" href="dashboard.php"><span class="green-text">C</span>-Pay</a>
        <div class="profile">
          <p>Hi, <?php echo $_SESSION['name']; ?></p>
          <div class="profile-pict"></div>
          <a href="logout.php">
            <ion-icon name="log-out-outline"></ion-icon>
          </a>
        </div>
      </nav>
      <div class="balance">
        <p class="faded-text">Balance:</p>
        <h1 class="green-text" id="balance">-</h1>
      </div>
      <div class="features">
        <a href="qr_scan.php" class="feature">
          <ion-icon name="qr-code"></ion-icon>
          <p class="faded-text">Scan QR</p>
        </a>
        <a href="transfer.php" class="feature">
          <ion-icon name="cash"></ion-icon>
          <p class="faded-text">Transfer</p>
        </a>
        <a href="topup.php" class="feature">
          <ion-icon name="wallet"></ion-icon>
          <p class="faded-text">Top up</p>
        </a>
      </div>
    </div>
  </header>

  <section>
    <div class="container">
      <b>History:</b>
      <table>
        <tr>
          <th>Sender</th>
          <th>Receiver</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Info</th>
        </tr>
      </table>
    </div>
  </section>

  <!-- Carousel -->
  <div id="demo" class="carousel slide" data-bs-ride="carousel">

    <!-- Indicators/dots -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="la.jpg" alt="Los Angeles" class="d-block" style="width:100%">
      </div>
      <div class="carousel-item">
        <img src="chicago.jpg" alt="Chicago" class="d-block" style="width:100%">
      </div>
      <div class="carousel-item">
        <img src="ny.jpg" alt="New York" class="d-block" style="width:100%">
      </div>
    </div>

    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <script>
    $.ajax({
      type: "GET",
      url: "./handlers/dashboard_balance.php",
      data: {
        // sender: 1,
        // receiver: 2,
        // nominal: 1000,
        // password: "password"
      },
      success: function(data) {
        data = jQuery.parseJSON(data);
        let balance = data[0];
        let transaction_history = data[1];
        // console.log(typeof(data));
        console.log(data);
        // console.log(balance);
        // console.log(transaction_history[0]);

        $('#balance').text(`Rp${balance}`);

        transaction_history.forEach(element => {
          $('table').append('<tr><td>' + element['sender_id'] + '</td><td>' + element['receiver_id'] + '</td><td>' + element['amount'] + '</td><td>' + element['t_date'] + '</td><td>' + element['t_info'] + '</td></tr>');
        });
      }
    });
  </script>
</body>

</html>