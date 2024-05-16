<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php
        session_start();
        if (session_status() === PHP_SESSION_NONE || !isset($_SESSION['email'])) {
            header("Location: login.php");
            exit();
        }

        echo "Welcome to the home page <br>";
        echo $_SESSION['email'];
        echo "<br>";
        echo $_SESSION['uid'];
        echo "<br>";
        echo $_SESSION['name'];
        echo "<br>";

        echo <<<END
            <a href="qr_scan.php">Scan QR Codes</a>
        END;

        echo "<br>";

        echo <<<END
            <a href="login.php">Test Login</a>
        END;

        echo "<br>";

        echo <<<END
            <a href="logout.php">Logout</a>
        END;

        // $response  = file_get_contents('dashboard_handler.php');
        // $jsonData = json_decode($response, true);

        // echo $jsonData;

    ?>

    <h3 id="balance"></h3>

    <table>
        <tr>
            <th colspan="5">Transaction History</th>
        </tr>
        <tr>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Amount</th>
            <th>Time</th>
            <th>Info</th>
        </tr>

    </table>

    <script>
        $.ajax({
            type: "GET",
            url: "./handlers/dashboard_handler.php",
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
                
                $('#balance').text(`Your Balance : Rp ${balance},-`);

                transaction_history.forEach(element => {
                    $('table').append('<tr><td>' + element['sender_id'] + '</td><td>' + element['receiver_id'] + '</td><td>' + element['amount'] + '</td><td>' + element['t_date'] + '</td><td>' + element['t_info'] + '</td></tr>');
                });

                
            }
        });

    </script>

</body>
</html>
