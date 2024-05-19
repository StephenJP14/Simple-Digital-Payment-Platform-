<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./styles/login.css">
    <title>Document</title>
</head>

<body>

    <?php
    session_start();

    ?>

    <nav>
        <a href="dashboard.php">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </a>
        <div class="logo"><span class="green-text">C</span>-Pay Top up</div>
    </nav>

    <form action="./handlers/topup_handler.php" method="post">
        <label for="amount">Amount:</label>
        <input type="text" name="amount" id="amount" placeholder="Amount of Topup">

        <label for="merchant">Choose your Bank:</label>
        <select name="merchant" id="merchant">
        </select>
        <input type="submit" value="Proceed" id="submit">
    </form>

    <script>
        $.ajax({
            type: "GET",
            url: "./handlers/get_merchant.php",
            data: {},
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