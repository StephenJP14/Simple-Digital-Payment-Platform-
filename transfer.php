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
    ?>
    
    <form action="password.php" method="post">
    <input id="sender" type="text" name="sender" value="<?php echo $_SESSION['uid']; ?>" hidden>
        <input id="receiver" type="text" name="receiver" value="" hidden>
        <input id="receiverName" type="text" name="receiverName" placeholder="" value="" readonly>
        <input type="text" name="nominal" placeholder="Amount">
        <input id="receiverPhone" type="text" name="receiverPhone" placeholder="Receiver Phone Number">
        <button type="button" onclick="checkUser()">Verify Receiver</button>
        <input type="submit" value="Transfer">
    </form>
    
    <script>
        function checkUser(){
            var receiver = $('#receiverPhone').val();
            $.ajax({
                url: './handlers/check_receiver.php',
                type: 'post',
                data: {receiver: receiver},
                success: function(response){
                    response = jQuery.parseJSON(response);
                    if(response != 'Receiver not found'){
                        let receiverName = response['name'];
                        let receiverID = response['uid'];
                        $('#receiverName').val(receiverName);
                        $('#receiver').val(receiverID);
                    }else{
                        alert('User does not exist');
                    }
                }
            });
        }

    </script>


</body>
</html>