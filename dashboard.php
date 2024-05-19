<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <div class="logo"><span class="green-text">C</span>-Pay</div>
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
        <a href="" class="feature">
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
    <b>History:</b>
  </section>

  <form action="topup.php" method="post" style="background-color:red;">
    <input type="text" name="topup" placeholder="Topup" style="color:black;">
    
    <label for="merchant" style="color:black;">Choose your Bank:</label>
    <select name="merchant" id="merchant" style="background-color:cyan;color:black;">
      <!-- <option value="volvo">Volvo</option> -->
    </select>
    <input type="submit" value="Topup" style="color:black;">
  </form>


  <script>
    $.ajax({
      type: "GET",
      url: "./handlers/dashboard_balance.php",
      data: {
      },
      success: function(data) {
        data = jQuery.parseJSON(data);
        let balance = data[0];
        let transaction_history = data[1];
        // console.log(typeof(data));
        con        // console.log(transaction_history[0]);

        $('#balance').text(`Rp${balance}`);

        transaction_history.forEach(element => {
          $('table').append('<tr><td>' + element['sender_id'] + '</td><td>' + element['receiver_id'] + '</td><td>' + element['amount'] + '</td><td>' + element['t_date'] + '</td><td>' + element['t_info'] + '</td></tr>');
        });
      }
    });
    $.ajax({
      type: "GET",
      url: "./handlers/get_merchant.php",
      data: {
      },
      success: function(data) {
        data = jQuery.parseJSON(data);
        let merchants = data;
        console.log(data);
        merchants.forEach(element => {
          $('#merchant').append(`<option value="${element["merchant_id"]}">${element["merchant_name"]}</option>`);
        });
      }
    });
  </script>
</body>

</html>