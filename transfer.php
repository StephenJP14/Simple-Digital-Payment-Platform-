<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    
    <form action="transfer.php" method="post">
        <input type="text" name="amount" placeholder="Amount">
        <input type="text" name="to" placeholder="To">
        <input type="submit" value="Transfer">

    <?php
        session_start();

    ?>


</body>
</html>