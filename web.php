<?php
include('function.php'); 
logout();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="images/logo.png">
    <title>Yotobike</title>
</head>

<body>
    <?php
    nav();
    ?>
    <div class="row">
        <div class="col-2">
            <h1>All That You Need!</h1>
            <p>Motorcycle can be dangerous, But we here for you.<br>The best accessories for a rider.</p>
            <br>
            <a href="products.php" class="btn">Explore Now &#10137</a>
        </div>
        <div class="col-2">
            <img src="images/web-photo.png">
        </div>
    </div>
    <?php
    footer();
    ?>

</body>

</html>