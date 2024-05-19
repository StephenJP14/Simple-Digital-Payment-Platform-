<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Numpad</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .numpad-button {
            width: 50px;
            height: 50px;
            margin: 5px;
            font-size: 20px;
        }
        #clearButton {
            width: 50px;
            height: 50px;
            margin: 5px;
            font-size: 20px;
        }
        #submitButton {
            width: 50px;
            height: 50px;
            margin: 5px;
            font-size: 20px;
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


    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $nominal = $_POST['nominal'];

    echo "Sender: $sender <br>";
    echo "Receiver: $receiver <br>";
    echo "Nominal: $nominal <br>";
    // echo "Test Successful!";
    ?>

    <div class="container mt-5">
        <div class="row">
            <form class="col-md-4 offset-md-4" action="./handlers/transaction_handler.php" method="post">
                <input type="text" name="sender" value="<?php echo $sender; ?>" hidden>
                <input type="text" name="receiver" value="<?php echo $receiver; ?>" hidden>
                <input type="text" name="nominal" value="<?php echo $nominal; ?>" hidden>
                <input type="password" id="passwordInput" name="password" class="form-control mb-3" readonly>
                <div class="text-center">
                    <button type="button" class="btn btn-primary numpad-button">1</button>
                    <button type="button" class="btn btn-primary numpad-button">2</button>
                    <button type="button" class="btn btn-primary numpad-button">3</button>
                    <br>
                    <button type="button" class="btn btn-primary numpad-button">4</button>
                    <button type="button" class="btn btn-primary numpad-button">5</button>
                    <button type="button" class="btn btn-primary numpad-button">6</button>
                    <br>
                    <button type="button" class="btn btn-primary numpad-button">7</button>
                    <button type="button" class="btn btn-primary numpad-button">8</button>
                    <button type="button" class="btn btn-primary numpad-button">9</button>
                    <br>
                    <button type="button" class="btn btn-primary" id="clearButton">Clear</button>
                    <button type="button" class="btn btn-primary numpad-button">0</button>
                    <button type="button" class="btn btn-primary" id="submitButton">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let input_left = 3;
        $(document).ready(function() {
            var password = "";

            $(".numpad-button").click(function() {
                var digit = $(this).text();
                if (password.length < 6) {
                    password += digit;
                    updatePasswordInput();
                }
                if (password.length === 6) {
                    $("#passwordInput").val(password)
                    // console.log($("#passwordInput").val());
                    sendPasswordToServer(password);
                }
                console.log("kepencet");
            });

            $("#clearButton").click(function() {
                password = "";
                updatePasswordInput();
            });

            $("#submitButton").click(function() {
                if (password.length === 6) {
                } else {
                    alert("Password must be 6 characters long.");
                }
            });

            function updatePasswordInput() {
                var hiddenPassword = "";
                for (var i = 0; i < password.length; i++) {
                    hiddenPassword += "*";
                }
                $("#passwordInput").val(hiddenPassword);
            }

            function sendPasswordToServer(password) { 
                $.ajax({
                    type: "POST",
                    url: "./handlers/pass_check_handler.php",
                    data: {
                        password: password
                    },
                    success: function(response) {
                        response = jQuery.parseJSON(response);
                        console.log("Server response: " + response);
                        console.log(typeof(response));
                        if (response === true) {
                            $("form").trigger("submit");
                        } else {
                            if (input_left === 0) {
                                alert("You have reached maximum attempt. Please try again later.");
                                window.location.href = "dashboard.php";
                            }else{
                                alert(`Password is incorrect. \nYou have ${input_left} attempt left.`);
                                input_left--;
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            }
        });
    </script>

</body>

</html>