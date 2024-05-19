<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./styles/qr_scan.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    var currentUser = "<?php echo $_SESSION['uid']; ?>";
  </script>
  <title>Scan QR</title>
  <style>
    .nominal-input {
      background-color: black;
      color: white;
    }
  </style>
</head>

<body>
  <?php
  session_start();
  if (session_status() === PHP_SESSION_NONE || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
  }
  ?>

  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="dashboard.php">
      <ion-icon name="arrow-back-outline"></ion-icon>
    </a>
    <span class="navbar-brand mb-0 h1">C-Pay QR</span>
  </nav>

  <section>
    <div class="scanner-line"></div>
    <ion-icon id="scan-bg" name="scan-outline"></ion-icon>
    <div id="my-qr-reader"></div>
  </section>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6 text-center">
        <button class="btn btn-primary mt-3" onclick="showQRModal()">
          <ion-icon name="qr-code-outline"></ion-icon> Show my QR
        </button>
      </div>
    </div>
  </div>

  <!-- Modal Pop-up -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="Modal">My QR Code</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="qrcode"></div>
          <form action="password.php" method="post" id="form">
            <input type="text" id="sender" name="sender" hidden>
            <input type="text" id="receiver" name="receiver" hidden>
            <input type="text" name="nominal" id="nominal" placeholder="Masukkan Nominal" required class="nominal-input form-control">
            <input type="submit" value="Transfer" class="btn btn-primary mt-3">
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    var currentUser = "<?php echo $_SESSION['uid']; ?>";
  </script>

  <script src="https://unpkg.com/html5-qrcode"></script>
  <script src="script.js"></script>
  <script>
    let qrcode = new QRCode("qrcode", "transfer.php?&receiver=" + currentUser);
    document.getElementById("qrcode").style.display = "none";
    document.getElementById("qrcode").style.justifyContent = "center";
    document.getElementById("my-qr-reader__scan_region").style.display = 'flex'
    document.getElementById("my-qr-reader__scan_region").style.justifyContent = 'center'
    document.querySelector("#my-qr-reader__scan_region video").style.width = '100%'

    function showQRModal() {
      $('#myModal').modal('show');
    }
  </script>
</body>

</html>