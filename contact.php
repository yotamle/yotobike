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
        <form class="res_form" method="POST" action="contact-us.php">
            <h2>Contact Us</h2>
            <div class="input-group">
                <label>Name:</label>
                <input type="text" name="name" placeholder="Name" required>
            </div>
            <div class="input-group">
                <label>Phone:</label>
                <input type="phone" name="phone" placeholder="Phone Number" required>
            </div>
            <div class="input-group">
                <label>Email:</label>
                <input name="text" type="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                    title="Email must contain @ in email address (user@gmail.com)" required>
            </div>
            <div class="input-group"><label>Message:</label> </div>
            <div class="input-group">
                <textarea name="message" id="message" name="message" rows="8"
                    placeholder="Enter your message here.."></textarea>
            </div>
            <input class="btn" type="submit" value="Submit">
        </form>

    </div>





</body>

</html>