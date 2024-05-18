<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>

<body>

    <?php
    session_start();

    ?>

    <form action="topup.php" method="post">
        <input type="text" name="topup" placeholder="Topup">
        <input type="submit" value="Topup">
        <label for="cars">Choose a car:</label>

        <select name="cars" id="cars">
            <option value="volvo">Volvo</option>
        </select>
    </form>




</body>

</html>