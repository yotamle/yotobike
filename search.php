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
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="style.css">
    <title>Yotobike</title>
</head>

<body>
    <?php
    nav();
    ?>
    <h2>Search Products</h2>
    <form class="search_page" method="post" action="search.php">
        <input type="text" class="search_bar" placeholder="Search.." name="str" required
            title="שדה זה יכול להכיל 9 ספרות בלבד">
        <button type="submit" name="submit" class="search_btn">Search</button>
    </form>

    <?php
if(isset($_POST['submit'])){ // search item
	$str=mysqli_real_escape_string($con,$_POST['str']);
	$sql="select * from products where name like '%$str%'";
	$result=mysqli_query($con,$sql);
	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_assoc($result)) {
			?>

    <div class="container_search">
        <form class="cart_search" action="manage_cart.php" method="POST">
            <img src="images/<?php echo $row["image"]; ?>" alt="...">
            <h3><?php echo $row["name"]; ?></h3>
            <p class="p-text-text" style="white-space:pre-wrap; word-wrap:break-word"><?php echo $row["text"]; ?></p>
            <br>
            <p class="p-text-price">$<?php echo $row["price"]; ?></p>
            <button type="submit" name="Add_To_Cart" class="add-to-cart_btn">Add To Cart</button>
            <input type="hidden" name="Item_Name" value="<?php echo $row["name"]; ?>">
            <input type="hidden" name="Price" value="<?php echo $row["price"]; ?>">
        </form>
    </div>
    <br>

    <?php
		}
	}else{
		echo '<script>alert("Product not found")</script>';
	}
	
}
	?>



</body>

</html>