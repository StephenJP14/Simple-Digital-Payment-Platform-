<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="./styles/login.css">
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
        <div class="logo"><span class="green-text">C</span>-Pay Transfer</div>
    </nav>
    <form action="password.php" method="post">
        <input id="sender" type="text" name="sender" value="<?php echo $_SESSION['uid']; ?>" hidden>
        <input id="receiver" type="text" name="receiver" value="" hidden>
        <input id="receiverName" type="text" name="receiverName" placeholder="" value="" readonly>
        <label for="nominal">Nominal:</label>
        <input type="text" name="nominal" placeholder="Amount" id="nominal">
        <label for="rec-phone-num">Receiver phone number:</label>
        <input id="receiverPhone" type="text" name="receiverPhone" id="rec-phone-number" placeholder="Receiver Phone Number">
        <button type="button" onclick="checkUser()" class="secondary-btn">Verify Receiver</button>
        <input type="submit" value="Transfer" id="submit">
    </form>

    <script>
        function checkUser() {
            var receiver = $('#receiverPhone').val();
            $.ajax({
                url: './handlers/check_receiver.php',
                type: 'post',
                data: {
                    receiver: receiver
                },
                success: function(response) {
                    response = jQuery.parseJSON(response);
                    if (response != 'Receiver not found') {
                        let receiverName = response['name'];
                        let receiverID = response['uid'];
                        $('#receiverName').val(receiverName);
                        $('#receiver').val(receiverID);
                    } else {
                        alert('User does not exist');
                    }
                }
            });
        }
    </script>


</body>

</html>