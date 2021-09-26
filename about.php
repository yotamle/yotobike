<?php
include('function.php'); 
session_start(); 
logout();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/logo.png">
    <title>Yotobike</title>
</head>

<body>
    <?php
    nav();
    ?>

    <div class="row">
        <div class="about-text">
            <h2>About Us</h2>
            <p><strong>Yotobike</strong> - Is a motorcycle web company with alot of accesscoreis for riders.<br>
                we specialize to fit any gear for you!</p>
            <br>
            <p>Our company was founded in Tel Aviv, Israel in 2020.</p>
            <p>We are very proud of what we have achieved: Yotobike has grown into one of the largest <br> and most
                successful businesses in the motorcycle sector.</p>
            <br>
            <p>We want to create a good personal experience for our customers.</p>
        </div>
    </div>


</body>

</html>