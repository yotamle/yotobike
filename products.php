<?php 

include('function.php'); 
session_start(); 
logout();
// connect to database
$con = ConnectToDB();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/logo.png">
    <title>Yotobike</title>

</head>

<body>

    <?php
    nav();
    ?>
    <div class="container_cart">

        <?php
				$query = "SELECT * FROM products ORDER BY id ASC";
				$result = mysqli_query($con, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
        <form class="cart" action="manage_cart.php" method="POST">
            <img src="images/<?php echo $row["image"]; ?>" class="image-resize" alt="...">
            <h3><?php echo $row["name"]; ?></h3>
            <p class="p-text-text" style="white-space:pre-wrap; word-wrap:break-word"><?php echo $row["text"]; ?></p>
            <p class="p-text-price">$<?php echo $row["price"]; ?></p>
            <button type="submit" name="Add_To_Cart" class="add-to-cart_btn">Add To Cart</button>
            <<input type="hidden" name="product_id" value="<?php echo $row["id"]; ?>">
                <input type="hidden" name="Item_Name" value="<?php echo $row["name"]; ?>">
                <input type="hidden" name="Price" value="<?php echo $row["price"]; ?>">
        </form>

        <?php
					}
				}
			?>

        <br>
    </div>







</body>

</html>