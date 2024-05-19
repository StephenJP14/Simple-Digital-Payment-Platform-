<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>QR Scanner</title>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  <link rel="stylesheet" href="./styles/qr_scan.css" />
</head>

<body>
  <?php
  session_start();
  if (session_status() === PHP_SESSION_NONE || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
  }
  ?>

  <nav>
    <a href="dashboard.php">
      <ion-icon name="arrow-back-outline"></ion-icon>
    </a>
    <div class="logo"><span class="green-text">C</span>-Pay QR</div>
  </nav>
  <section>
    <div class="scanner-line"></div>
    <ion-icon id="scan-bg" name="scan-outline"></ion-icon>
    <div id="my-qr-reader"></div>
  </section>
  <div class="buttons">
    <button class="primary-btn" onclick="showQR()">
      <ion-icon name="qr-code-outline"></ion-icon> Show my QR
    </button>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color: rgb(25, 25, 25)">
        <div class="modal-header" style="border-color: rgb(80, 80, 80);">
          <button type="button" class="close" data-dismiss="modal" style="color: white">
            &times;
          </button>
          <h4 class="modal-title">Masukkan Nomial</h4>
        </div>
        <div class="modal-body">
          <div id="qrcode"></div>
          <form action="password.php" method="post" id="form">
            <input type="text" id="sender" name="sender" hidden />
            <input type="text" id="receiver" name="receiver" hidden />
            <input type="text" name="nominal" id="nominal" placeholder="Masukkan Nominal" required />
            <input type="submit" value="Transfer" class="btn primary-btn" id="submit" />
          </form>
        </div>
        <div class="modal-footer" style="border: none;">
          <button type="button" class="secondary-btn" data-dismiss="modal">
            Cancel
          </button>
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
    let qrcode = new QRCode(
      "qrcode",
      "transfer.php?&receiver=" + currentUser
    );
    document.getElementById("qrcode").style.display = "none";
    document.getElementById("qrcode").style.justifyContent = "center";

    function showQR() {
      $(".modal-title").text("My QR Code");
      document.getElementById("qrcode").style.display = "flex";
      document.getElementById("form").style.display = "none";
      $("#myModal").modal();
      let uid = "<?php echo $_SESSION['uid']; ?>";
      // console.log(uid);
      console.log(currentUser);
      // $("#myModal").modal();
      // if (document.getElementById("qrcode").style.display == "none") {
      //     // let qrcode = new QRCode("qrcode", "transfer.php?&receiver=" + currentUser);
      // }else{
      //     document.getElementById("qrcode").style.display = "none";
      // }
    }
  </script>
</body>

</html>